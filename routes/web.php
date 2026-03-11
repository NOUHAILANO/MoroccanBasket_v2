<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
|  PARTIE CLIENT (Vitrine) - Public
|--------------------------------------------------------------------------
*/
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/cart', function () { return view('cart.index'); })->name('cart.index');

Route::post('/cart/add/{id}', function() {
    return back()->with('success', 'Produit ajouté (Test)');
})->name('cart.add');

/*
|--------------------------------------------------------------------------
|  PARTIE ADMIN (Dev A) - Khllinah m7loul bach t-testi s-sel3a
|--------------------------------------------------------------------------
| Ghadi n-7iydu 'admin' middleware 7ta t-sali Afaf l-table User
*/
Route::middleware(['auth'])->prefix('admin')->group(function () {
    
    // Le Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Le CRUD complet des produits
    Route::resource('products', ProductController::class);
    
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

require __DIR__.'/auth.php';