<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\City;
use App\Models\Town;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function list_orders()
    {
        $orders = Order::latest()->get();
        return view('admin.list_orders', compact('orders'));
    }

    public function add_to_cart($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('shop')->with('error', [
                'message' => 'Product not found.',
                'duration' => $this->alert_message_duration,
            ]);
        }

        $cart = Session::get('cart', []);

        if (array_key_exists($product->id, $cart)) {
            // Increment quantity if product is already in the cart
            $cart[$product->id]['quantity']++;
        } else {
            // Add the product to the cart
            $cart[$product->id] = [
                'id' => $product->id,
                'title' => $product->title,
                'slug' => $product->slug,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        Session::put('cart', $cart);

        // Call the method to update cart count
        $this->updateCartCount();

        return redirect()->back()->with('success', [
            'message' => 'Product added to cart successfully.',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function view_cart()
    {
        $cart = $this->calculateCartTotals();

        return view('cart', compact('cart'));
    }

    public function get_checkout()
    {
        $cities = City::all();
        $towns = Town::all();
        $user = Auth::user();
        $cart = $this->calculateCartTotals();

        if(empty($cart['items'])) {
            return redirect()->route('shop')->with('error', [
                'message' => 'You don\'t have any items in your cart to checkout.',
                'duration' => $this->alert_message_duration,
            ]);
        }

        return view('checkout', compact('cart', 'cities', 'towns', 'user'));
    }

    // New method to get and update the cart count
    private function updateCartCount()
    {
        //  $cartCount = count(Session::get('cart', []));
        // Session::put('cart_count', $cartCount);


        $cart = Session::get('cart', []);
        $cart_count = 0;

        foreach($cart as $item)
        {
            $cart_count += $item['quantity'];
        }

        Session::put('cart_count', $cart_count);
    }

    private function calculateCartTotals()
    {
        $cart = ['items' => []];
        $subtotal = 0;

        foreach (Session::get('cart', []) as $productId => $item) {
            $item['total'] = $item['price'] * $item['quantity'];
            $subtotal += $item['total'];
            $cart['items'][$productId] = $item;
        }

        $cart['subtotal'] = $subtotal;

        return $cart;
    }

    public function create_order(Request $request)
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
        $cart = $this->calculateCartTotals();

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

    public function order_success()
    {
        $order_number = session('order_number');
        return view('order_success', compact('order_number'));
    }
}
