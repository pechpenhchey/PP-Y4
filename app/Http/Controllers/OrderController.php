<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);

        $order = Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'product_image' => $product->iamge,
            'product_name' => $product->name,
            'total_price' => $product->price * $request->quantity,
            'quantity' => $request->quantity,
            'create_at' => $request->create_at,
            'order_number' => uniqid('ORD-')
        ]);

        return redirect()->route('admin.orders.show', $order->id)->with('success', 'Order placed successfully!');
    }

    public function show($id)
    {
        $order = Order::with('product')->where('user_id', Auth::id())->findOrFail($id);

        return view('admin.orders.show', compact('order'));
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        if ($request->status == 'accepted') {
            // Send notification to user
            return redirect()->back()->with('success', 'Order accepted. Notify the user.');
        } elseif ($request->status == 'declined') {
            // Send notification to user
            return redirect()->back()->with('error', 'Order declined. Notify the user.');
        }

        return redirect()->back()->with('success', 'Order status updated.');
    }

    public function pendingOrders()
    {
        $orders = Order::where('status', 'pending')->get();

        return view('admin.orders.pending', compact('orders'));
    }
}
