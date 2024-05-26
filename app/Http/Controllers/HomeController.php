<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $totalUsers = User::count();
        $pendingOrdersCount = Order::where('status', 'pending')->count();
    
        // Order trends by product
        $orderTrendsByProduct = Order::select('product_id', DB::raw('COUNT(*) as total_orders'))
            ->groupBy('product_id')
            ->orderByDesc('total_orders')
            ->take(10)
            ->get();
    
        // Calculate total orders by week, month, and year
        $totalOrdersByWeek = Order::select(DB::raw('YEAR(created_at) as year'), DB::raw('WEEK(created_at) as week'), DB::raw('COUNT(*) as total_orders'))
            ->groupBy('year', 'week')
            ->orderBy('year', 'desc')
            ->orderBy('week', 'desc')
            ->get();
    
        $totalOrdersByMonth = Order::select(DB::raw('YEAR(created_at) as year'), DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as total_orders'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();
    
        $totalOrdersByYear = Order::select(DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as total_orders'))
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    
        return view('admin.dashboard', compact('totalUsers', 'pendingOrdersCount', 'orderTrendsByProduct', 'totalOrdersByWeek', 'totalOrdersByMonth', 'totalOrdersByYear'));
    }
}
