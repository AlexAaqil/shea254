<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category', 'getProductImages')->orderBy('order', 'asc')->get();
        return view("admin.products.products", compact("products"));
    }

    public function create()
    {
        $categories = Category::all();
        return view("admin.products.add_product", compact('categories'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'title' => 'required|unique:products',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'order' => 'nullable|integer',
            'images' => 'max:2048'
        ]);

        $product = new Product;

        $product->title = $validated_data['title'];
        $product->slug = Str::slug($validated_data['title']);
        $product->in_stock = $request->input('in_stock', 1);
        $product->featured = $request->input('featured', 1);
        $product->description = $request->input('description', null);
        $product->price = $validated_data['price'];
        $product->discount_price = $request->input('discount_price', null);
        $product->product_size = $request->input('product_size', null);
        $product->category_id = $validated_data['category_id'];
        $product->order = $request->input('order', 100) ?? 100;

        $product->save();

        $this->storeProductImages($request, $product);

        return redirect()->route('products.index')->with('success', [
            'message' => "Product was added successfully.",
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $product_images = $product->getProductImages;
        return view("admin.products.update_product", compact('product', 'categories', 'product_images'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required|unique:products,title,'.$product->id,
            'category_id' => 'required',
            'order' => 'nullable|integer',
        ]);

        $product->title = $request->title;
        $product->slug = Str::slug( $request->title);
        $product->in_stock = $request->in_stock;
        $product->featured = $request->featured;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->product_size = $request->product_size;
        $product->category_id = $request->category_id;
        $product->order = $request->input('order', 100) ?? 100;

        $product->save();

        // Retrieve existing images
        $existing_images = $product->getProductImages->pluck('image_name')->toArray();

        // Check if new images are being uploaded
        $images = $request->file('images');
        if ($images) {
            $total_images = count($existing_images) + count($images);

            // Check if the total number of images doesn't exceed five
            if ($total_images <= 5) {
                foreach ($images as $image) {
                    $random_string = date('Ymdhis').Str::random(5);
                    $extension = $image->getClientOriginalExtension();
                    $filename = $random_string. '.' .$extension;

                    $image_path = $image->storeAs('products', $filename, 'public');

                    $image_upload = new ProductImage;
                    $image_upload->image_name = $image_path;
                    $image_upload->product_id = $product->id;

                    $image_upload->save();
                }
            } else {
                return redirect()->route('products.edit', $product->id)->withErrors(['images' => 'You can upload a maximum of five images.'])->withInput();
            }
        }

        return redirect()->route('products.index')->with('success', [
            'message' => 'Product was updated successfully',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function destroy(Product $product)
    {
        // Retrieve image paths before deleting from database
        $image_paths = $product->getProductImages->pluck('image_name')->toArray();

        // Delete the product images (database records)
        $product->getProductImages()->delete();

        // Delete the product
        $product->delete();

        // Delete the files from storage
        foreach ($image_paths as $image_path) {
            Storage::disk('public')->delete($image_path);
        }

        return redirect()->route('list_products')->with('success', [
            'message' => 'Product deleted successfully!',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function product_images_sort(Request $request) {
        if(!empty($request->photo_id)) {
            $i = 1;
            foreach($request->photo_id as $photo_id) {
                $image = ProductImage::find($photo_id);
                $image->order_by = $i;
                $image->save();

                $i++;
            }
        }

        $json['success'] = true;
        echo json_encode($json);
    }

    public function delete_product_image($id) {
        // Delete the selected image matching the condition
        $image = ProductImage::find($id);

        // Delete from the database
        $image->delete();

        // Delete the file from storage
        Storage::disk('public')->delete($image->image_name);

        return redirect()->route('products.edit', $image->product_id)->with('success',[
            'message' => 'Image deleted Successfully',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function product_details($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        $product_images = $product->getProductImages;
        $related_products = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->take(5)
        ->get();
        return view('product_details', compact('product', 'product_images', 'related_products'));
    }

    public function search_products(Request $request)
    {
        $query = $request->input('query');

        $products = Product::with('category')
        ->where('title', 'like', "%$query%")
        ->orWhere('description', 'like', "%$query%")
        ->get();

        foreach ($products as $product) {
            $product->calculateDiscount();
        }

        return view('search_results', compact('products', 'query'));
    }

    public function list_products_by_category($category_slug)
    {
        $categories = Category::all();
        $category = Category::where('slug', $category_slug)->firstOrFail();
        $products = $category->products;

        foreach ($products as $product) {
            $product->calculateDiscount();
        }

        return view('list_products_by_category', compact('products', 'category', 'categories'));
    }

    private function storeProductImages(Request $request, Product $product)
    {
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $image) {
                $filename = $this->generateImageFilename($image, $product->title, $product->id);
                $image_path = $image->storeAs('products', $filename, 'public');

                $image_upload = new ProductImage;
                $image_upload->image_name = $image_path;
                $image_upload->product_id = $product->id;

                $image_upload->save();
            }
        }
    }

    private function generateImageFilename($image, $title, $productId)
    {
        $extension = $image->getClientOriginalExtension();
        $slug = Str::slug($title);
        return "{$slug}-{$productId}-" . uniqid() . ".$extension";
    }
}
