<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\DeliveryArea;
use App\Models\DeliveryLocation;
use App\Models\Town;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function list_orders()
    {
        $orders = Order::orderBy('status')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('admin.orders.orders', compact('orders'));
    }

    public function list_user_orders()
    {
        $user = Auth::user();
        $user_orders = $user->orders;

        return view('list_user_orders', compact('user_orders'));
    }

    public function get_checkout()
    {
        $locations = DeliveryLocation::all();
        $areas = DeliveryArea::all();
        $user = Auth::user();
        $cart = app(CartController::class)->cartItemsWithCalculatedTotals();

        if(empty($cart['items'])) {
            return redirect()->route('shop')->with('error', [
                'message' => 'You don\'t have any items in your cart to checkout.',
                'duration' => $this->alert_message_duration,
            ]);
        }

        return view('checkout', compact('cart', 'locations', 'areas', 'user'));
    }

    public function post_checkout(Request $request)
    {
        $validated_data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
        ]);

        $cart = app(CartController::class)->cartItemsWithCalculatedTotals();
        $cart_subtotal = $cart['subtotal'];

        // Retrieve the selected pickup method
        $pickup_method = $request->input('pickup_method');

        // Initialize variables
        $address = '';
        $additional_information = '';

        // Set values based on the selected pickup method
        if ($pickup_method === 'delivery') {
            $validated_data += $request->validate([
                'address' => 'required|string',
                'additional_information' => 'nullable|string',
                'location' => 'required|exists:delivery_locations,id',
                'area' => 'required|exists:delivery_areas,id',
            ]);
            $address = $validated_data['address'];
            $additional_information = $validated_data['additional_information'];
            $location = $validated_data['location'];
            $area = $validated_data['area'];

            // Get the area and location names
            $area = DeliveryArea::findOrFail($validated_data['area']);
            $location = DeliveryLocation::findOrFail($validated_data['location']);

            $area_name = $area->area_name;
            $location_name = $location->location_name;

            // Calculate shipping cost and total amount based on the selected delivery area
            $area_price = $area->price;
            $shipping_cost = $area_price;

        } else {
            // Set manual values for address, location, and area
            $address = 'Shop';
            $additional_information = '';

            $area_name = 'Shop';
            $location_name = 'Shop';
            $shipping_cost = 0;
        }

        $total_amount = $shipping_cost + $cart_subtotal;

        // Generate order number and set user ID
        $order_number = 'order_' . Str::random(5);
        $user_id = Auth::user()->id;

        // Create the order
        $order = Order::create([
            'order_number' => $order_number,
            'user_id' => $user_id,
            'first_name' => $validated_data['first_name'],
            'last_name' => $validated_data['last_name'],
            'email' => $validated_data['email'],
            'phone_number' => $validated_data['phone_number'],
            'address' => $address,
            'additional_information' => $additional_information,
            'location' => $location_name,
            'area' => $area_name,
            'cart_items' => json_encode($cart),
            'shipping_cost' => $shipping_cost,
            'total_amount' => $total_amount,
        ]);

        // Store order number in session
        Session::put('order_number', $order->order_number);

        // Clear the cart and cart count
        Session::forget(['cart', 'cart_count']);

        return redirect()->route('order_success');
    }


    public function get_update_order($id)
    {
        $order = Order::findOrFail($id);
        $order->cart_items = json_decode($order->cart_items, true);
        return view('admin.orders.update_order', compact('order'));
    }

    public function post_update_order(Request $request, $id)
    {
        $validated_data = $request->validate([
            'additional_information' => 'nullable|string',
            'status' => 'required',
            'paid' => 'required',
        ]);

        $order = Order::findOrFail($id);
        // Update the order fields with the validated data
        $order->fill($validated_data);
        // Save the updated order
        $order->save();

        return redirect()->route('list_orders')->with('success', [
            'message' => 'Order has been updated.',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function delete_order($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect()->route('list_orders')->with('success', ['message' => 'Order has been deleted.', 'duration' => $this->alert_message_duration]);
    }

    public function order_success()
    {
        $order_number = session('order_number');
        return view('order_success', compact('order_number'));
    }

    public function get_areas($locationId)
    {
        $areas = DeliveryArea::where('location_id', $locationId)->get();
        return response()->json($areas);
    }

    public function get_shipping_price($areaId)
    {
        $area = DeliveryArea::findOrFail($areaId);
        $price = $area->price;

        return response()->json(['price' => $price]);
    }
}
