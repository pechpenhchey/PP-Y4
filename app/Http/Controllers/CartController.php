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

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function showCart()
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        return view('cart', compact('cartItems'));
    }
    public function deleteCartItem($cartId)
    {
        $cartItem = Cart::find($cartId);

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Cart item not found!');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }
    public function updateCartItem(Request $request, Cart $cartItem)
    {
        $this->validate($request, [
            'quantity' => 'required|numeric|min:1',
        ]);

        $cartItem->update([
            'quantity' => $request->input('quantity'),
        ]);

        return redirect()->back()->with('success', 'Cart item quantity updated successfully!');
    }

}