<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// 1. PUBLIC PART
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');

// Panier logic
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// 2. CLIENT PART (Auth required)
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/merci', [OrderController::class, 'merci'])->name('order.confirmation');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Fallback dashboard name to prevent RouteNotFoundException
    Route::get('/my-account', [ShopController::class, 'index'])->name('dashboard'); 
});

// 3. ADMIN PART (Prefix: admin)
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    
    Route::get('/orders', [DashboardController::class, 'ordersIndex'])->name('admin.orders.index');
    Route::get('/orders/{order}', [DashboardController::class, 'ordersShow'])->name('admin.orders.show');
    Route::patch('/orders/{order}/status', [DashboardController::class, 'updateStatus'])->name('admin.orders.updateStatus');
});

require __DIR__ . '/auth.php';