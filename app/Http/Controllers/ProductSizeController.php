<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductSizeController extends Controller
{
    public function index()
    {
        $product_sizes = ProductSize::latest()->get();
        return view('admin.products.product_sizes', compact('product_sizes'));
    }

    public function create()
    {
        return view('admin.products.add_product_size');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_size' => [
                'required',
                'string',
                'max:30',
                Rule::unique('product_sizes', 'product_size')->where(function ($query) use ($request) {
                    return $query->where('product_size', Str::lower($request->input('product_size')));
                }),
            ],
        ]);

        $normalizedProductSize = Str::lower($validated['product_size']);

        // Check if a record with the normalized product size already exists
        if (ProductSize::where('product_size', $normalizedProductSize)->exists()) {
            return redirect()->back()->withErrors(['product_size' => 'The product size has already been taken.'])->withInput();
        }

        // If not, insert the record with the normalized product size
        ProductSize::create(['product_size' => $normalizedProductSize]);

        return redirect()->route('productsizes.index')->with('success', [
            'message' => "Product Size has been added.",
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function edit(ProductSize $productsize)
    {
        return view("admin.products.update_product_size", compact('productsize'));
    }

    public function update(Request $request, ProductSize $productsize)
    {
        $validated = $request->validate([
            'product_size' => 'required|unique:product_sizes,product_size,'.$productsize->id,
        ]);

        $validated['product_size'] = Str::lower($validated['product_size']);

        $productsize->update($validated);

        return redirect()->route('productsizes.index')->with('success', [
            'message' => "Product size has been updated.",
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function destroy(ProductSize $productsize)
    {
        $productsize->delete();

        return redirect()->route('productsizes.index')->with('success', [
            'message' => "Product size has been deleted.",
            'duration' => $this->alert_message_duration,
        ]);
    }
}
