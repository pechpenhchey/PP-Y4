<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category']);
        $search = $request->input('search');

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $search . '%')
                ->orWhere('id', 'like', '%' . $search . '%');
        }

        $products = $query->orderByDesc('id')->paginate(5);
        $total = Product::count();

        return view('admin.product.home', compact('products', 'total', 'search'));
    }

    public function showFoodProducts(Request $request)
    {
        $query = Product::query();

        if ($request->has('title')) {
            $query->where('title', 'like', '%' . $request->input('title') . '%');
        }

        if ($request->has('price')) {
            $query->where('price', '=', $request->input('price'));
        }

        if ($request->has('category_id')) {
            $query->where('category_id', '=', $request->input('category_id'));
        }

        $products = $query->paginate(12);
        $categories = Category::all();

        return view('dashboard', ['products' => $products, 'categories' => $categories]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.product.create', ['categories' => $categories]);
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validation['price'] = floatval($validation['price']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validation['image'] = $imageName;
        }

        $product = new Product();
        $product->title = $validation['title'];
        $product->category_id = $validation['category_id'];
        $product->price = $validation['price'];
        $product->description = $validation['description'];
        $product->image = $validation['image'];
        $product->save();

        session()->flash('success', 'Product Added Successfully');
        return redirect()->route('admin/products');
    }

    public function edit($id)
    {
        $products = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.product.update', compact('products', 'categories'));
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        if ($product) {
            session()->flash('success', 'Product Deleted Successfully');
            return redirect()->route('admin/products');
        } else {
            session()->flash('error', 'Error !!');
            return redirect()->route('admin/products');
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validation = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'price' => 'required|numeric',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validation['price'] = floatval($validation['price']);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validation['image'] = $imageName;
        }

        $product->title = $validation['title'];
        $product->category_id = $validation['category_id'];
        $product->price = $validation['price'];
        $product->description = $validation['description'];

        if (isset($validation['image'])) {
            $product->image = $validation['image'];
        }

        $product->save();

        if ($product) {
            session()->flash('success', 'Product Updated Successfully');
        } else {
            session()->flash('error', 'Some problem occurred');
        }

        return redirect(route('admin/products'));
    }
}
