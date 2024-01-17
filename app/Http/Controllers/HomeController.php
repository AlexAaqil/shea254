<?php

namespace App\Http\Controllers;

use App\Models\Product;
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
            ->latest()
            ->take(4)
            ->get();
        return view('index', compact('featured_products'));
    }

    public function shop()
    {
        $products = Product::where('in_stock', 1)->get();
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
