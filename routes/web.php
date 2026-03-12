<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController; // <--- N'oubliez pas l'import !
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
|  PARTIE CLIENT (Vitrine) - Public
|--------------------------------------------------------------------------
*/

Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');

// --- VOS ROUTES PANIER (Développeur B) ---
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
/*
|--------------------------------------------------------------------------
|  PARTIE COMMANDES (Nécessite d'être connecté)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Route pour enregistrer la commande en BDD
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    //Route::middleware('auth')->group(function () {


    // Page de confirmation après achat
    Route::get('/order/confirmation', function () {
        return view('orders.confirmation');
    })->name('confirmation');
});

/*
|--------------------------------------------------------------------------
|  PARTIE ADMIN (Dev A)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('products', ProductController::class);

    // --- VOS ROUTES ADMIN (Gestion des ventes par Dev B) ---
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.status');
});
/*
|--------------------------------------------------------------------------
|  PARTIE PROFIL
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
