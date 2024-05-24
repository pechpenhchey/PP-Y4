<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
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
            $order->special_request = $item['special_request'];
            $order->payment_method = $request->payment_method;
            $order->user_id = $user->id;
            $order->save();
        }
        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('dashboard')->with('success', 'Order placed successfully!');
    }

    public function index()
    {
        $orders = Order::all();
        return view('admin.orders.index', compact('orders'));
    }
}
