<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $user_level = Auth()->user()->user_level;

            if($user_level==2)
            {
                return redirect()->route('dashboard');
            }
            else if($user_level==1)
            {

                return redirect()->route('admin_dashboard');
            }
            else
            {
                return redirect()->back();
            }
        }
    }

    public function homepage()
    {
        $featured_products = Product::where([
                ['featured', 1],
                ['in_stock', 1]
            ])
            ->orderBy('order')
            ->take(4)
            ->get();
        foreach($featured_products as $product) {
            $product->calculateDiscount();
        }
        return view('index', compact('featured_products'));
    }

    public function shop()
    {
        $products = Product::where('in_stock', 1)->orderBy('order', 'asc')->orderBy('title', 'asc')->get();

        foreach ($products as $product) {
            $product->calculateDiscount();
        }

        return view('shop', compact('products'));
    }

    public function aboutpage()
    {
        return view('about');
    }

    public function contactpage()
    {
        return view('contact');
    }
}
