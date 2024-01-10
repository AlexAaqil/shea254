<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function add_to_cart($productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('shop')->with('error', 'Product not found.');
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

        return redirect()->back()->with('success', 'Product added to cart successfully.');
    }

    public function view_cart()
    {
        $cart = $this->calculateCartTotals();

        return view('cart', compact('cart'));
    }

    public function get_checkout()
    {
        $cart = $this->calculateCartTotals();
        return view('checkout', compact('cart'));
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
}
