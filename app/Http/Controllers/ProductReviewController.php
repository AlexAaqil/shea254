<?php

namespace App\Http\Controllers;

use App\Models\ProductReview;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class ProductReviewController extends Controller
{
    public function index()
    {
        return view('shop');
    }

    public function create($product)
    {
        $product = Product::where('slug', $product)->firstOrFail();

        return view('product_reviews.create', compact('product'));
    }

    public function store(Request $request, $product)
    {
        $product = Product::findOrFail($product);

        $validated = $request->validate([
            'rating' => 'required|numeric',
            'review' => 'required|string|max:1500',
            'image' => 'nullable|max:2048',
        ]);

        $validated['user_id'] = Auth::user()->id;
        $validated['product_id'] = $product->id;

        ProductReview::create($validated);

        return redirect()->route('shop')->with('success', ['message' => 'Your review has been sent']);
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductReview $productReview)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductReview $productReview)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductReview $productReview)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductReview $productReview)
    {
        //
    }
}
