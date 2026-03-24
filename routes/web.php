<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| 1. PARTIE PUBLIQUE (Vitrine)
|--------------------------------------------------------------------------
*/

Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');

// Panier logic
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

/*
|--------------------------------------------------------------------------
| 2. PARTIE CLIENT (Nécessite d'être connecté)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::post('/store', [OrderController::class, 'store'])->name('order.store');

    Route::get('/merci', [OrderController::class, 'merci'])->name('order.confirmation');
    // Profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 3. PARTIE ADMIN (Is_Admin middleware)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'is_admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);

    // Order management for Admin
    Route::get('/orders', [DashboardController::class, 'ordersIndex'])->name('admin.orders.index');
    Route::get('/orders/{order}', [DashboardController::class, 'ordersShow'])->name('admin.orders.show');
    Route::patch('/orders/{order}/status', [DashboardController::class, 'updateStatus'])->name('admin.orders.updateStatus');

    Route::resource('categories', CategoryController::class);
});

require __DIR__ . '/auth.php';
