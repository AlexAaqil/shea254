<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Models\Product;

class CartController extends Controller
{
    public function view_cart()
    {
        $cart = $this->cartItemsWithCalculatedTotals();
        return view('cart', compact('cart'));
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

    public function cartItemsWithCalculatedTotals()
    {
        /*
        *
        * this function returns an array structure like:

        [
            'items' => [
                $product_id_1 => [
                    'id' => 1,
                    'title' => product_title,
                    'slug' => product-title,
                    'quantity' => 3,
                    'price' => 150
                    'total' => 450,
                ],
                $product_id_2 => [
                    'id' => 2,
                    'title' => product_title,
                    'slug' => product-title,
                    'quantity' => 3,
                    'price' => 100
                    'total' => 300,
                ],
            ],
            'subtotal' => 750
        ]

        *
        */

        // Initialize an empty cart and the subtotal to zero
        $cart = ['items' => []];
        $subtotal = 0;

        /*
        * Loop through each item in cart that's stored in the session.
        * Calculate the total price of the item
        * Update the subtotal with the total price of the current item
        * Add the item to the cart
        * Add the calculated subtotal to the cart
        * Return the updated cart with calculated totals
        */
        foreach(Session::get('cart', []) as $product_id => $item)
        {
            $item['total'] = $item['price'] * $item['quantity'];
            $subtotal += $item['total'];
            $cart['items'][$product_id] = $item;
        }

        $cart['subtotal'] = $subtotal;

        return $cart;
    }

    public function updateCartCount()
    {
        $cart = Session::get('cart', []);
        $cart_count = 0;

        foreach($cart as $item)
        {
            $cart_count += $item['quantity'];
        }

        Session::put('cart_count', $cart_count);
    }
}
