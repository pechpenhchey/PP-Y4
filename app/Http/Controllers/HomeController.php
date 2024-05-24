<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
{
    $totalUsers = User::count(); // Initialize $totalUsers with the total count of users
    $pendingOrdersCount = Order::where('status', 'pending')->count(); // Initialize $pendingOrdersCount with the count of pending orders
    
    if ($request->has('filter')) {
        // Show orders
        $filter = $request->input('filter');
        $ordersQuery = Order::query();

        if ($filter == 'week') {
            $ordersQuery->where('created_at', '>=', Carbon::now()->subWeek());
        } elseif ($filter == 'month') {
            $ordersQuery->where('created_at', '>=', Carbon::now()->subMonth());
        }

        $orders = $ordersQuery->latest()->paginate(5);
        // No need to redefine $pendingOrdersCount here

        return view('admin.dashboard', compact('orders', 'filter', 'pendingOrdersCount', 'totalUsers'));
    } elseif ($request->has('users')) {
        // Show user-related data
        return view('admin.dashboard', compact('totalUsers', 'pendingOrdersCount'));
    } else {
        // Default behavior
        return view('admin.dashboard', compact('totalUsers', 'pendingOrdersCount'));
    }
}

}
