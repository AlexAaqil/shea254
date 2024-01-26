<?php

namespace App\Http\Controllers;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\Product;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function list() {
        $products = Product::with('category', 'product_size', 'getProductImages')->orderBy('order', 'asc')->get();
        return view("admin.products.products", compact("products"));
    }

    public function get_add_product() {
        $categories = Category::all();
        $product_sizes = ProductSize::all();
        return view("admin.products.add_product", compact('categories', 'product_sizes'));
    }

    public function post_add_product(Request $request) {
        request()->validate([
            'title'=> 'required|unique:products',
            'price' => 'required',
            'category_id' => 'required',
            'product_size_id' => 'required',
        ]);

        $product = new Product;

        $product->title = $request->title;
        $product->slug = Str::slug( $request->title);
        $product->in_stock = $request->in_stock;
        $product->featured = $request->featured;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category_id = $request->category_id;
        $product->product_size_id = $request->product_size_id;
        $product->order = $request->order;

        $product->save();

        $images = $request->file('images');
        if($images) {
            foreach($images as $image) {
                $random_string = date('Ymdhis').Str::random(5);
                $extension = $image->getClientOriginalExtension();
                $filename = $random_string. '.' .$extension;

                $image_path = $image->storeAs('products', $filename, 'public');

                $image_upload = new ProductImage;
                $image_upload->image_name = $image_path;
                $image_upload->product_id = $product->id;

                $image_upload->save();
            }
        }

        return redirect()->route('list_products')->with('success', [
            'message' => "Product was added successfully.",
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function get_update_product($id) {
        $product = Product::find($id);
        $categories = Category::all();
        $product_sizes = ProductSize::all();
        $product_images = $product->getProductImages;
        return view("admin.products.update_product", compact('product', 'categories', 'product_sizes', 'product_images'));
    }

    public function post_update_product($id, Request $request) {
        request()->validate([
            'title' => 'required|unique:products,title,'.$id,
            'product_size_id' => 'required',
            'category_id' => 'required',
        ]);

        $product = Product::find($id);

        $product->title = $request->title;
        $product->slug = Str::slug( $request->title);
        $product->in_stock = $request->in_stock;
        $product->featured = $request->featured;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->category_id = $request->category_id;
        $product->product_size_id = $request->product_size_id;
        $product->order = $request->order;

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
                return redirect()->route('get_update_product', $product->id)->withErrors(['images' => 'You can upload a maximum of five images.'])->withInput();
            }
        }

        return redirect()->route('list_products')->with('success', [
            'message' => 'Product was updated successfully',
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

        return redirect()->route('get_update_product', $image->product_id)->with('success',[
            'message' => 'Image deleted Successfully',
            'duration' => $this->alert_message_duration,
        ]);
    }

    public function delete_product($id) {
        $product = Product::find($id);

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
}
