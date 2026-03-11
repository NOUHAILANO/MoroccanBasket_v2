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

/*
|--------------------------------------------------------------------------
|  PARTIE ADMIN (Ton rôle de Dev A) - Protégée par Auth
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
    
    // Le Dashboard (Statistiques)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Le CRUD complet des produits
    Route::resource('products', ProductController::class);
    
});

/*
|--------------------------------------------------------------------------
|  PARTIE PROFIL (Breeze par défaut)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';