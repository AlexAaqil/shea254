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

class OrderController extends Controller
{
    public function index()
    {
        $orders = Sale::with(['order_delivery', 'order_items'])->orderBy('id', 'desc')->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $user = Auth::check() ? Auth::user() : null;
        $locations = DeliveryLocation::all();
        $areas = DeliveryArea::all();
        $cart = app(CartController::class)->cartItemsWithTotals();

        if(empty($cart['items'])) {
            return redirect()->route('shop')->with('error', ['message' => "You don't have any items in your cart to checkout."]);
        }

        return view('checkout', compact('user', 'locations', 'areas', 'cart'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:80',
            'last_name' => 'required|string|max:120',
            'email' => 'required|string|lowercase|email:rfc,dns|max:255',
            'phone_number' => 'required|string|max:40',
        ]);

        $phone_number = $validated['phone_number'];

        $cart = app(CartController::class)->cartItemsWithTotals();
        $cart_items = $cart['items'];
        $cart_subtotal = $cart['subtotal'];

        $pickup_method = $request->input('pickup_method');

        // Initialize variables
        $address = '';
        $additional_information = '';

        // Set values based on the selected pickup method
        if($pickup_method === 'delivery') {
            $validated += $request->validate([
                'address' => 'required|string',
                'additional_information' => 'nullable|string',
                'location' => 'required|exists:delivery_locations,id',
                'area' => 'required|exists:delivery_areas,id',
            ]);

            $address = $validated['address'];
            $additional_information = $validated['additional_information'];
            $location = $validated['location'];
            $area = $validated['area'];

            // Get the area and location names
            $area = DeliveryArea::findOrFail($validated['area']);
            $location = DeliveryLocation::findOrFail($validated['location']);

            $area_name = $area->area_name;
            $location_name = $location->location_name;

            // Calculate the shipping cost and total amount based on selected delivery area
            $area_price = $area->price;
            $shipping_cost = $area_price;
        } else {
            $address = 'Shop';
            $additional_information = null;
            $area_name = 'Shop';
            $location_name = 'Shop';
            $shipping_cost = 0;
        }

        $total_amount = $shipping_cost + $cart_subtotal;

        // Generate order number and set user ID
        $order_number = date('YmdHis');
        $order_type = 1;
        $discount_code = null;
        $discount = 0;
        $payment_reference = null;
        $payment_method = null;
        $user_id = Auth::check() ? Auth::user()->id : null;

        $res = $this->mpesa($phone_number, $total_amount, $order_number);

        if($res == 0 ) {
            // Create the order
            $order = Sale::create([
                'order_number' => $order_number,
                'order_type' => $order_type,
                'discount_code' => $discount_code,
                'discount' => $discount,
                'total_amount' => $total_amount,
                'payment_reference' => $payment_reference,
                'payment_method' => $payment_method,
                'user_id' => $user_id,
            ]);

            $order_delivery = new OrderDelivery();
            $order_delivery->order_id = $order->id;
            $order_delivery->first_name = $validated['first_name'];
            $order_delivery->last_name = $validated['last_name'];
            $order_delivery->email = $validated['email'];
            $order_delivery->phone_number = $phone_number;
            $order_delivery->address = $address;
            $order_delivery->additional_information = $additional_information;
            $order_delivery->location = $location_name;
            $order_delivery->area = $area_name;
            $order_delivery->shipping_cost = $shipping_cost;
            $order_delivery->save();

            foreach($cart_items as $productId => $item) {
                $order_item = new OrderItems();
                $order_item->product_id = $item['id'];
                $order_item->title = $item['title'];
                $order_item->quantity = $item['quantity'];
                $order_item->selling_price = $item['selling_price'];
                $order_item->order_id = $order->id;
                $order_item->save();
            }

            // Store order number in session
            Session::put('order_number', $order->order_number);

            Session::forget(['cart', 'cart_count']);

            return redirect()->route('order_success');
        } else {

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
        return view('order_success', compact('order_number'));
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

    public function mpesa($phone, $amount, $ordernum){
        #Callback url
        define('CALLBACK_URL', 'https://shea254.com/public/Payments/callback_url.php?orderid=');
  
        # access token
        $consumerKey = 'GLLuJh7msoyl7ESShcWt0k6CR1M48OLGCxusxknzOJsjLPOJ'; //Fill with your app Consumer Key
        $consumerSecret = 'Jq0i0VSmKJIgr0TgVC08jxdQqft5PyyKGOqZvMMx0D1SjmSfMgil5wpGBlWcv6uR'; // Fill with your app Secret
  
        # provide the following details, this part is found on your test credentials on the developer account
        $BusinessShortCode = '6812022'; //business short code
        $Passkey = '965b1d719e52988dd3345a6ed1b23ccd45cfa3e16df7df74cf34f9ba9351fe96'; //live passkey
        $phone = preg_replace('/^0/', '254', str_replace("+", "", $phone));
        $PartyA = $phone; // This is your phone number,
        $PartyB = '4311370'; // For the buy goods, the till number. For paybill, just the paybill
        $TransactionDesc = 'Pay Order'; //Insert your own description
        # Get the timestamp, format YYYYmmddhms -> 20181004151020
        $Timestamp = date('YmdHis');    
        # Get the base64 encoded string -> $password. The passkey is the M-PESA Public Key
        $Password = base64_encode($BusinessShortCode.$Passkey.$Timestamp);
        # header for access token
        $headers = ['Content-Type:application/json; charset=utf8'];
  
        # M-PESA endpoint urls
        $access_token_url = 'https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $initiate_url = 'https://api.safaricom.co.ke/mpesa/stkpush/v1/processrequest';  
  
        $curl = curl_init($access_token_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HEADER, FALSE);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey.':'.$consumerSecret);
        $result = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $result = json_decode($result);
        $access_token = $result->access_token;  
  
        curl_close($curl);
  
        # header for stk push
        $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
        # initiating the transaction
  
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $initiate_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header
        
        $curl_post_data = array(
  
          //Fill in the request parameters with valid values
          'BusinessShortCode' => $BusinessShortCode,
          'Password' => $Password,
          'Timestamp' => $Timestamp,
          'TransactionType' => 'CustomerBuyGoodsOnline', // CustomerBuyGoodsOnline or CustomerPayBillOnline
          'Amount' => $amount,
          'PartyA' => $PartyA,
          'PartyB' => $PartyB,
          'PhoneNumber' => $PartyA,
          'CallBackURL' => CALLBACK_URL . $ordernum,
          'AccountReference' => $ordernum,
          'TransactionDesc' => $TransactionDesc
        );
  
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
  
        $res = (array)(json_decode($curl_response));
        $ResponseCode = $res['ResponseCode'];
        return $ResponseCode;
    }
}
