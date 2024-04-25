<?php
 
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
 
Route::get('/', function () {
    return view('welcome');
});
 
Route::get('/home', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
 
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/category', [HomeController::class, 'userCategory'])->name('user.category');
});
 
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin/products');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin/products/create');
    Route::post('/admin/products/save', [ProductController::class, 'save'])->name('admin/products/save');
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin/products/edit');
    Route::put('/admin/products/edit/{id}', [ProductController::class, 'update'])->name('admin/products/update');
    Route::get('/admin/products/delete/{id}', [ProductController::class, 'delete'])->name('admin/products/delete');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index'); // Define the index route
});


require __DIR__.'/auth.php';