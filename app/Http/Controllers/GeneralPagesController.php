<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;

class GeneralPagesController extends Controller
{
    public function welcome()
    {
        return view('welcome');
    }

    public function home()
    {
        return view('index');
    }

    public function shop()
    {
        $products = Product::orderBy('title','asc')->get();
        $product_categories = ProductCategory::orderBy('title','asc')->take(18)->get();
        
        return view('shop', compact('products', 'product_categories'));
    }

    public function contact()
    {
        return view('contact');
    }
}
