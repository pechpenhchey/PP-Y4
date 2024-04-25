<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.categories.create', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories|max:255',
        ]);
    
        $category = new Category();
        $category->name = $request->input('name');
        $category->save();
    
        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category created successfully.');
    }    

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->all());

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')
                         ->with('success', 'Category deleted successfully');
    }
}
