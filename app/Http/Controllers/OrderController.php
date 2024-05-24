<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout(Request $request)
    {
        $user = Auth::user();

        foreach ($request->items as $itemId => $item) {
            $order = new Order();
            $order->order_number = uniqid();
            $order->product_id = $item['product_id'];
            $order->total_price = $item['total_price'];
            $order->quantity = $item['quantity'];
            $order->status = 'pending';
            $order->special_request = $request->special_request;
            $order->payment_method = $request->payment_method;
            $order->user_id = $user->id;
            $order->save();
        }
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('dashboard')->with('success', 'Order placed successfully!');
    }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $ordersQuery = Order::query();

        if ($search) {
            $ordersQuery->where('order_number', 'like', '%' . $search . '%');
        }

        $orders = $ordersQuery->latest()->paginate(5);
        return view('admin.orders.index', compact('orders', 'search'));
    }

    public function update(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        $message = '';
        $alertType = 'success';

        switch ($request->status) {
            case 'pending':
                $message = 'Order status changed to pending.';
                $alertType = 'warning';
                break;
            case 'declined':
                $message = 'Order status changed to declined.';
                $alertType = 'danger';
                break;

            default:
                $message = 'Order status updated successfully!';
                break;
        }

        return redirect()->back()->with('status', $alertType)->with('message', $message);
    }

    public function userOrderHistory()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)->latest()->paginate(10);
        return view('history', compact('orders'));
    }
}
