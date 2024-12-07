<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CartCountController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $cartItems = Cart::where('user_id', $userId)->with('product')->get();
        $totalCount = $cartItems->count();
        
        $query = Product::query();
    
        // Filtering products based on request parameters
        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }
    
        if ($request->has('price')) {
            $query->where('price', '=', $request->input('price'));
        }
    
        if ($request->has('category_id')) {
            $query->where('category_id', '=', $request->input('category_id'));
        }
    
        $products = $query->paginate(12); // Paginate the results
    
        $categories = Category::all();
    
        // Pass data to the view
        return view('dashboard', [
            'products' => $products,
            'categories' => $categories,
            'totalCount' => $totalCount,
        ]);
    }
}

