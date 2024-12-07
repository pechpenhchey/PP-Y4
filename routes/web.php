<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\CartCountController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');

    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin/products');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin/products/create');
    Route::post('/admin/products/save', [ProductController::class, 'save'])->name('admin/products/save');
    Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit'])->name('admin/products/edit');
    Route::put('/admin/products/edit/{id}', [ProductController::class, 'update'])->name('admin/products/update');
    Route::get('/admin/products/delete/{id}', [ProductController::class, 'delete'])->name('admin/products/delete');
    Route::delete('/admin/products/delete/{id}', [ProductController::class, 'delete'])->name('admin.products.delete');

    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::get('admin/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::get('admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('admin/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::delete('admin/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('admin/categories', [CategoryController::class, 'index'])->name('admin.categories.index');

    Route::resource('admin/users', UserController::class)->except(['show']);
    Route::get('admin/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('admin/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
    Route::get('/admin/orders/create', [OrderController::class, 'create'])->name('admin.orders.create');
    Route::post('/admin/orders', [OrderController::class, 'store'])->name('admin.orders.store');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');

    // Admin Notifications
    Route::get('/admin/notifications', [NotificationController::class, 'adminNotifications'])->name('admin.notifications');

    Route::get('admin/revenue', [OrderController::class, 'showRevenueForm'])->name('admin.revenue.form');
    Route::post('admin/revenue', [OrderController::class, 'calculateRevenue'])->name('admin.revenue.calculate');
});

Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/order-history', [OrderController::class, 'userOrderHistory'])->name('order.history');

// User Notifications
Route::get('/user/notifications', [NotificationController::class, 'userNotifications'])->name('user.notifications');

Route::middleware('auth')->group(function () {
    Route::post('/home/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/home/cart', [CartController::class, 'showCart'])->name('cart.show');
    Route::delete('/home/cart/{cartId}', [CartController::class, 'deleteCartItem'])->name('cart.delete');
    Route::put('/home/cart/{cartItem}', [CartController::class, 'updateCartItem'])->name('cart.update');

    Route::get('/home', [CartCountController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');



});

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);

require __DIR__ . '/auth.php';
