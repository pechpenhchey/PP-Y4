<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CartController extends Controller
{
    use ValidatesRequests;

    public function addToCart(Request $request)
    {
        $product_id = $request->input('product_id');
        $user_id = Auth::id();

        $cart = Cart::where('user_id', $user_id)->where('product_id', $product_id)->first();

        $isNewItem = !$cart;

        if ($cart) {
            $cart->quantity += 1;
            $cart->save();
        } else {
            Cart::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => 1
            ]);
        }

        // Count unique items for the user
        $totalCount = Cart::where('user_id', $user_id)->count();

        return response()->json([
            'success' => true,
            'message' => 'Food added to cart successfully!',
            'isNewItem' => $isNewItem,
            'totalCount' => $totalCount
        ]);
    }

    public function showCart()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        foreach ($cartItems as $cartItem) {
            if (!$cartItem->product || $cartItem->product->trashed()) {
                $cartItem->delete();
            }
        }

        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        $totalCount = $cartItems->count();
        $orderTotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('cart', compact('cartItems', 'totalCount', 'orderTotal'));
    }    

    public function deleteCartItem($cartId)
    {
        $cartItem = Cart::find($cartId);

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Cart item not found!');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Food removed from cart successfully!');
    }
    
    public function updateCartItem(Request $request, Cart $cartItem)
    {
        $this->validate($request, [
            'quantity' => 'required|numeric|min:1',
        ]);

        $cartItem->update([
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->back();
    }
}