<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $totalUsers = User::where('userType', '!=', 'admin')->count();
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $totalApprovedOrdersPrice = Order::withTrashed()->where('status', 'approved')->sum('total_price');

        // Order trends by product
        $orderTrendsByProduct = Order::withTrashed()
            ->select('product_id', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('product_id')
            ->orderByDesc('total_orders')
            ->take(10)
            ->get();

        $orderTrendsByCategory = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->whereNull('products.deleted_at')
            ->select('categories.name as category_name', DB::raw('COUNT(orders.id) as total_orders'))
            ->groupBy('categories.name')
            ->get();


        // Calculate total orders by week, month, and year
        $totalOrdersByWeek = Order::select(DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('COUNT(*) as total_orders'))
            ->groupBy('year', 'week')
            ->orderBy('year', 'desc')
            ->orderBy('week', 'desc')
            ->withTrashed() // Include soft-deleted orders
            ->get();

        $totalOrdersByMonth = Order::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total_orders'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->withTrashed() // Include soft-deleted orders
            ->get();

        $totalOrdersByYear = Order::select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total_orders'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->withTrashed() // Include soft-deleted orders
            ->get();

        return view('admin.dashboard', compact('totalUsers', 'pendingOrdersCount', 'orderTrendsByProduct', 'orderTrendsByCategory', 'totalOrdersByWeek', 'totalOrdersByMonth', 'totalOrdersByYear', 'totalApprovedOrdersPrice'));
    }
}
