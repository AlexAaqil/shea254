<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
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
                return view('dashboard');
            }
            else if($user_level==1)
            {
                $count_users = User::getUsers()->count();
                $count_admins = User::getAdmins()->count();
                $count_products = Product::all()->count();
                $count_categories = Category::all()->count();
                // $order_count = Order::count();
                // $sales_count = Sales::count();
                return view('admin.dashboard', compact('count_users', 'count_admins', 'count_categories', 'count_products'));
            }
            else
            {
                return redirect()->back();
            }
        }
    }

    public function homepage()
    {
        return view('index');
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
