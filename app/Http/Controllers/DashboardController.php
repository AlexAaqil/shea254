<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $user_orders = Auth::user()->orders;
        return view('dashboard', compact('user_orders'));
    }

    public function admin_dashboard()
    {
        $count_users = User::getUsers()->count();
        $count_admins = User::getAdmins()->count();
        $count_products = Product::all()->count();
        $count_categories = Category::all()->count();
        $count_orders = Order::all()->count();
        // $sales_count = Sales::count();
        return view('admin.dashboard', compact('count_users', 'count_admins', 'count_categories', 'count_products', 'count_orders'));
    }
}
