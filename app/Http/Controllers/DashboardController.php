<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Order;
use Carbon\Carbon;

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

        $this_year = Carbon::now()->year;

        $recent_orders = Order::latest()->take(4)->get();
        $total_sales = Order::where('status', '=', 'processed')
        ->where('paid', '=', 1)
        ->sum('total_amount');
        $sales_today = Order::where('status', '=', 'processed')
                        ->where('paid', '=', true)
                        ->whereDate('created_at', Carbon::today())
                        ->sum('total_amount');

        // Calculate sales for this week
        $sales_this_week = Order::where('status', '=', 'processed')
                                ->where('paid', '=', true)
                                ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                                ->sum('total_amount');

        // Calculate sales for this month
        $sales_this_month = Order::where('status', '=', 'processed')
                                ->where('paid', '=', true)
                                ->whereMonth('created_at', Carbon::now()->month)
                                ->sum('total_amount');

        // Calculate sales for this year
        $sales_this_year = Order::where('status', '=', 'processed')
                                ->where('paid', '=', true)
                                ->whereYear('created_at', Carbon::now()->year)
                                ->sum('total_amount');

        // Sales for each month of the current year
        $monthly_sales = Order::selectRaw("MONTH(created_at) as month, SUM(total_amount) as total_sales")
            ->where('status', 'processed')
            ->where('paid', true)
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Map the sales data for each month
        $sales_data = $monthly_sales->pluck('total_sales')->toArray();

        $cities_data = Order::select('city', \DB::raw('COUNT(*) as total_orders'))
        ->groupBy('city')
        ->orderBy('total_orders', 'desc')
        ->take(5)
        ->get();

        // Map the data for cities and orders
        $cities_labels = $cities_data->pluck('city')->toArray();
        $cities_orders = $cities_data->pluck('total_orders')->toArray();



        return view('admin.dashboard', compact(
            'count_users',
            'count_admins',
            'count_categories',
            'count_products',
            'count_orders',

            'this_year',

            'recent_orders',
            'total_sales',
            'sales_today',
            'sales_this_week',
            'sales_this_month',
            'sales_this_year',

            'sales_data',
            'cities_labels',
            'cities_orders',
        ));
    }
}
