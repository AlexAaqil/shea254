<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use App\Models\Comment;
use App\Models\Product;
use App\Models\DeliveryArea;
use App\Models\Sale;
use App\Models\OrderItems;

class DashboardController extends Controller
{
    public function index()
    {
        $user_level = Auth()->user()->user_level;
        
        if($user_level == 2)
        {
            return redirect()->route('dashboard');
        }
        else if($user_level == 1)
        {
            return redirect()->route('admin.dashboard');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function admin_dashboard()
    {
        $count_users = User::count();
        $count_blogs = Blog::count();
        $count_comments = Comment::count();
        $count_products = Product::count();
        $count_delivery_areas = DeliveryArea::count();
        $count_orders = Sale::where('order_type', 1)->count();

        $gross_sales = Sale::sum('total_amount');
        $net_sales = Sale::sum('total_amount') - Sale::sum('discount');
        $cost_of_sales = OrderItems::sum('buying_price');
        $gross_profit = $net_sales - $cost_of_sales;

        return view('admin.dashboard', compact(
            'count_users',
            'count_blogs',
            'count_comments',
            'count_products',
            'count_delivery_areas',
            'count_orders',

            'gross_sales',
            'net_sales',
            'cost_of_sales',
            'gross_profit',
        ));
    }
}
