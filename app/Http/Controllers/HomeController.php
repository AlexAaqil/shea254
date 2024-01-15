<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
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
                $user_orders = Auth::user()->orders;
                return view('dashboard', compact('user_orders'));
            }
            else if($user_level==1)
            {
                $count_users = User::getUsers()->count();
                $count_admins = User::getAdmins()->count();
                $count_products = Product::all()->count();
                $count_categories = Category::all()->count();
                $count_orders = Order::all()->count();
                // $sales_count = Sales::count();
                return view('admin.dashboard', compact('count_users', 'count_admins', 'count_categories', 'count_products', 'count_orders'));
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
