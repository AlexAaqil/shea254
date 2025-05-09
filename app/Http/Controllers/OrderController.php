<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\DeliveryLocation;
use App\Models\DeliveryArea;
use App\Models\Sale;
use App\Models\OrderDelivery;
use App\Models\OrderItems;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Payments\KCBMpesaExpressController;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Sale::with(['order_delivery', 'order_items'])->whereHas('order_delivery')->orderBy('id', 'desc')->get();
	$orders_without_delivery = Sale::with(['order_delivery', 'order_items'])->whereDoesntHave('order_delivery')->orderBy('id', 'desc')->get();
        return view('admin.orders.index', compact('orders', 'orders_without_delivery'));
    }

    public function create()
    {
        $user = Auth::check() ? Auth::user() : null;
        $locations = DeliveryLocation::all();
        $areas = DeliveryArea::all();
        $cart = app(CartController::class)->cartItemsWithTotals();

        if (empty($cart['items'])) {
            return redirect()->route('shop')->with('error', ['message' => "You don't have any items in your cart to checkout."]);
        }

        return view('checkout', compact('user', 'locations', 'areas', 'cart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:200',
            'email' => 'required|string|lowercase|email:rfc,dns|max:255',
            'phone_number' => [
                'required',
                'string',
                'regex:/^(2547|2541)[0-9]{8}$/',
            ],
        ], [
            'phone_number.regex' => 'The phone number must start with 2547 or 2541 and have exactly 12 digits. (254746055xxx or 254116055xxx)',
        ]);

        $phone_number = $validated['phone_number'];
        $email = $validated['email'];

        $cart = app(CartController::class)->cartItemsWithTotals();
        $cart_items = $cart['items'];
        $cart_subtotal = $cart['subtotal'];

        $payment_gateway = $request->input('payment_method');
        $pickup_method = $request->input('pickup_method');

        $address = '';
        $additional_information = '';
        $location_name = '';
        $area_name = '';
        $shipping_cost = 0;

        if ($pickup_method === 'delivery') {
            $validated += $request->validate([
                'address' => 'required|string',
                'additional_information' => 'nullable|string',
                'location' => 'required|exists:delivery_locations,id',
                'area' => 'required|exists:delivery_areas,id',
            ]);

            $address = $validated['address'];
            $additional_information = $validated['additional_information'];
            $location = DeliveryLocation::findOrFail($validated['location']);
            $area = DeliveryArea::findOrFail($validated['area']);

            $location_name = $location->location_name;
            $area_name = $area->area_name;
            $shipping_cost = $area->price;
        } else {
            $address = 'Shop';
            $location_name = 'Shop';
            $area_name = 'Shop';
        }

        // TODO: Temporarily set amount to 1 for testing
        // $total_amount = $shipping_cost + $cart_subtotal;
        $total_amount = 1;
        $order_number = 'ord_' . Str::random(6) . '_' . date('dmy');
        $user_id = Auth::check() ? Auth::user()->id : null;

        $kcb_mpesa_express = new KCBMpesaExpressController();
        $response = $kcb_mpesa_express->initiatePayment($phone_number, $total_amount, $order_number);

        if ($response->header->statusCode === '0') {
            $order = Sale::create([
                'order_number' => $order_number,
                'order_type' => 1,
                'discount_code' => null,
                'discount' => 0,
                'total_amount' => $total_amount,
                'payment_method' => 'kcb_mpesa',
                'user_id' => $user_id,
            ]);

            OrderDelivery::create([
                'order_id' => $order->id,
                'full_name' => $validated['full_name'],
                'email' => $email,
                'phone_number' => $phone_number,
                'address' => $address,
                'additional_information' => $additional_information,
                'location' => $location_name,
                'area' => $area_name,
                'shipping_cost' => $shipping_cost,
            ]);

            foreach ($cart_items as $productId => $item) {
                OrderItems::create([
                    'product_id' => $item['id'],
                    'title' => $item['title'],
                    'quantity' => $item['quantity'],
                    'buying_price' => $item['buying_price'],
                    'selling_price' => $item['selling_price'],
                    'order_id' => $order->id,
                ]);
            }

            $order->payment()->create([
                'payment_gateway' => 'kcb_mpesa',
                'merchant_request_id' => $response->response->MerchantRequestID,
                'checkout_request_id' => $response->response->CheckoutRequestID,
                'transaction_reference' => $order_number,
                'response_code' => $response->response->ResponseCode,
                'response_description' => $response->response->ResponseDescription,
                'customer_message' => $response->response->CustomerMessage,
                'status' => $response->response->ResponseCode === '0' ? 'pending' : 'failed',
            ]);

            Session::put([
                'order_number' => $order->order_number,
                'order_id' => $order->id
            ]);
            Session::forget(['cart', 'cart_count']);

            return redirect()->route('order_success')->with('success', [
                'message' => 'Please complete the payment on your phone.',
                'order_number' => $order_number
            ]);
        } else {
            return redirect()->route('checkout.create')->with('error', [
                'message' => $response->response->CustomerMessage ?? 'Payment initiation failed. Please try again.'
            ]);
        }
    }

    public function edit(Sale $order)
    {
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Sale $order)
    {
        $validated = $request->validate([
            'additional_information' => 'nullable|string',
            'delivery_status' => 'required',
        ]);

        $order->order_delivery->additional_information = $validated['additional_information'];
        $order->order_delivery->delivery_status = $validated['delivery_status'];
        $order->order_delivery->save();

        return redirect()->route('orders.index')->with('success', ['message' => 'Order has been updated']);
    }

    public function destroy(Sale $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', ['message' => 'Order has been deleted']);
    }

    public function order_success()
    {
        $order_number = session('order_number');
        $order = Sale::with(['payment', 'order_delivery', 'order_items'])
            ->where('order_number', $order_number)
            ->first();

        if (!$order) {
            return redirect()->route('shop')->with('error', ['message' => 'Order not found']);
        }

        return view('order_success', compact('order_number', 'order'));
    }

    public function get_areas($locationId)
    {
        $areas = DeliveryArea::where('delivery_location_id', $locationId)->get();
        return response()->json($areas);
    }

    public function get_shipping_price($areaId)
    {
        $area = DeliveryArea::findOrFail($areaId);
        $price = $area->price;

        return response()->json(['price' => $price]);
    }

    public function request_stkPush($order_number)
    {
        $order = Sale::where('order_number', $order_number)->firstOrFail();
        $payment = optional($order->payment);

        if ($payment->status === 'failed' || $payment->status === 'pending') {
            // TODO: Remove the fixed amount after testing
            // $amount = $order->total_amount;
            $amount = 1;
            $phone_number = $order->order_delivery->phone_number;
            $order_number = $order->order_number;

            $kcb_mpesa_express = new KCBMpesaExpressController();
            $response = $kcb_mpesa_express->initiatePayment($phone_number, $amount, $order_number);

            if ($response->header->statusCode === '0') {
                $payment->update([
                    'merchant_request_id' => $response->response->MerchantRequestID,
                    'checkout_request_id' => $response->response->CheckoutRequestID,
                    'response_code' => $response->response->ResponseCode,
                    'response_description' => $response->response->ResponseDescription,
                    'customer_message' => $response->response->CustomerMessage,
                    'status' => $response->response->ResponseCode === '0' ? 'pending' : 'failed',
                ]);

                return redirect()->back()->with('success', [
                    'message' => $response->response->CustomerMessage
                ]);
            }

            return redirect()->back()->with('error', [
                'message' => $response->response->CustomerMessage ?? 'Payment request failed. Please try again.'
            ]);
        }

        return redirect()->back()->with('error', [
            'message' => 'Cannot initiate payment at this time.'
        ]);
    }
}
