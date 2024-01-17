<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Town;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function list_orders()
    {
        return view('admin.list_orders');
    }

    public function list_orders_table()
    {
        $orders = Order::orderBy('status')
        ->orderBy('created_at', 'desc')
        ->get();
        return view('partials.orders_table_body', compact('orders'));
    }

    public function list_user_orders()
    {
        $user = Auth::user();
        $user_orders = $user->orders;

        return view('list_user_orders', compact('user_orders'));
    }

    public function get_checkout()
    {
        $cities = City::all();
        $towns = Town::all();
        $user = Auth::user();
        $cart = app(CartController::class)->cartItemsWithCalculatedTotals();

        if(empty($cart['items'])) {
            return redirect()->route('shop')->with('error', [
                'message' => 'You don\'t have any items in your cart to checkout.',
                'duration' => $this->alert_message_duration,
            ]);
        }

        return view('checkout', compact('cart', 'cities', 'towns', 'user'));
    }

    public function post_checkout(Request $request)
    {
        $validated_data = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'additional_information' => 'nullable|string',
            'city' => 'required|exists:cities,id',
            'town' => 'required|exists:towns,id',
        ]);

        // Retrieve cart items from the session
        $validated_data['cart_items'] = json_encode(Session::get('cart', []));

        // Retrieve city and town names
        $city = City::find($validated_data['city']);
        $town = Town::find($validated_data['town']);

        if (!$city || !$town) {
            // Handle if city or town is not found
            return redirect()->route('checkout')->with('error', [
                'message' => 'Invalid city or town selected.',
                'duration' => $this->alert_message_duration,
            ]);
        }

        // Add city and town names to the validated data
        $validated_data['city'] = $city->city_name;
        $validated_data['town'] = $town->town_name;

        // Calculate shipping cost and total amount based on the selected town
        $shipping_cost = $town->price;
        $cart = app(CartController::class)->cartItemsWithCalculatedTotals();

        $validated_data['shipping_cost'] = $shipping_cost;
        $validated_data['total_amount'] = $shipping_cost + $cart['subtotal'];

        // Generate order number and set user ID
        $validated_data['order_number'] = 'order_' . Str::random(5);
        $validated_data['user_id'] = Auth::user()->id;

        // Create the order
        $order = Order::create($validated_data);

        // Store order number in session
        Session::put('order_number', $order->order_number);

        // Clear the cart and cart count
        Session::forget(['cart', 'cart_count']);

        return redirect()->route('order_success');
    }

    public function get_update_order($id)
    {
        $order = Order::findOrFail($id);
        return view('admin.update_order', compact('order'));
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

    public function order_success()
    {
        $order_number = session('order_number');
        return view('order_success', compact('order_number'));
    }
}
