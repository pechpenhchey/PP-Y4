<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

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

        $products = $query->paginate(8);
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $validation['price'] = floatval($validation['price']);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $validation['image'] = $path;
        }

        Product::create([
            'title' => $validation['title'],
            'category_id' => $validation['category_id'],
            'price' => $validation['price'],
            'description' => $validation['description'],
            'image' => $validation['image'] ?? null,
        ]);

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

        // Delete the image file from storage
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        session()->flash('success', 'Product Deleted Successfully');
        return redirect()->route('admin/products');
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
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $path = $request->file('image')->store('images', 'public');
            $validation['image'] = $path;
        }

        $product->update([
            'title' => $validation['title'],
            'category_id' => $validation['category_id'],
            'price' => $validation['price'],
            'description' => $validation['description'],
            'image' => $validation['image'] ?? $product->image,
        ]);

        session()->flash('success', 'Product Updated Successfully');
        return redirect(route('admin/products'));
    }

}
