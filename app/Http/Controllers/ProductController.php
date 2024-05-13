<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderByDesc('id')->get();
        $total = Product::count();
        return view('admin.product.home', compact('products', 'total'));
    }

    public function showFoodProducts()
    {
        $products = Product::all();
        return view('food', compact('products'));
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
            'price' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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
        $products = Product::findOrFail($id)->delete();
        if ($products) {
            session()->flash('success', 'Product Deleted Successfully');
            return redirect()->route('admin/products');
        } else {
            session()->flash('error', 'Product Not Delete successfully');
            return redirect()->route('admin/products');
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validation = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

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
