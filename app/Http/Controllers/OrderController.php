<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Notifications\OrderPlacedNotification;
use App\Notifications\OrderStatusNotification;
use Illuminate\Support\Facades\Notification;

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $products = Product::all();
        $users = User::all();
        $totalPrice = 0;

        if ($request->has('product_id') && $request->has('quantity')) {
            $product = Product::find($request->product_id);
            if ($product) {
                $totalPrice = $product->price * $request->quantity;
            }
        }

        return view('admin.orders.create', compact('products', 'users', 'totalPrice'));
    }

    public function show($id)
    {
        $order = Order::with(['product', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'special_request' => 'nullable|string',
            'payment_method' => 'required|string',
        ]);

        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        $order = new Order();
        $order->order_number = uniqid();
        $order->product_id = $request->product_id;
        $order->total_price = $totalPrice;
        $order->quantity = $request->quantity;
        $order->status = 'pending';
        $order->payment_method = $request->payment_method;
        $order->user_id = $request->user_id;
        $order->special_request = $request->special_request;
        $order->save();

        // Notify admin of the new order
        $admins = User::where('is_admin', true)->get();
        Notification::send($admins, new OrderPlacedNotification($order));

        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }

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
            $ordersQuery->where('order_number', 'like', '%' . $search . '%')
                ->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%');
                });
        }

        if ($request->has('show_orders')) {
            session()->put('show_orders', true);
        } else {
            session()->forget('show_orders');
        }

        $orders = $ordersQuery->orderBy('created_at', 'desc')->paginate(5);

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
        $orders = Order::where('user_id', $user->id)->latest()->paginate(5);
        return view('history', compact('orders'));
    }

    public function countNewOrders()
    {
        $newOrdersCount = Order::where('status', 'pending')->count();
        return $newOrdersCount;
    }

    public function showRevenueForm()
    {
        $totalAmount = null;
        $income = null;
        $outcome = null;
        $startDate = null;
        $endDate = null;

        return view('admin.revenue_form', compact('totalAmount', 'income', 'outcome', 'startDate', 'endDate'));
    }

    public function calculateRevenue(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        // Total amount for approved orders only
        $totalAmount = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'approved')
            ->sum('total_price');

        // Income (positive total price) for approved orders only
        $income = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'approved')
            ->where('total_price', '>', 0)
            ->sum('total_price');

        // Outcome (negative total price) for approved orders only
        $outcome = Order::whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'approved')
            ->where('total_price', '<', 0)
            ->sum('total_price');

        $outcome = abs($outcome);

        return view('admin.revenue_form', compact('totalAmount', 'income', 'outcome', 'startDate', 'endDate'));
    }
}
