<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\ProductSize;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class ProductSizeController extends Controller
{
    public function list()
    {
        $product_sizes = ProductSize::latest()->get();
        return view('admin.products.product_sizes', compact('product_sizes'));
    }

    public function get_add_product_size()
    {
        return view('admin.add_product_size');
    }

    public function post_add_product_size(Request $request): RedirectResponse
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

        return redirect()->route('list_product_sizes')->with('success', [
            'message' => "Product Size has been added.",
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function get_update_product_size($id)
    {
        $product_size = ProductSize::find($id);
        return view("admin/update_product_size", compact('product_size'));
    }

    public function post_update_product_size($id, Request $request)
    {
        $validated = $request->validate([
            'product_size' => 'required|unique:product_sizes,product_size,'.$id,
        ]);

        $validated['product_size'] = Str::lower($validated['product_size']);

        $product_size = ProductSize::findOrFail($id);
        $product_size->update($validated);

        return redirect()->route('list_product_sizes')->with('success', [
            'message' => "Product size was updated successfully",
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function delete_product_size($id)
    {
        $product_size = ProductSize::findOrFail($id);
        $product_size->delete();

        return redirect()->route('list_product_sizes')->with('success', [
            'message' => "Product size deleted successfully!",
            'duration' => $this->alert_message_duration,
        ]);
    }
}
