<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| 1. PARTIE PUBLIQUE (Vitrine)
|--------------------------------------------------------------------------
*/
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/product/{id}', [ShopController::class, 'show'])->name('shop.show');

// Routes dyal l-Panier (Cart)
Route::get('/cart', [ShopController::class, 'cart'])->name('cart.index');
Route::post('/cart/add/{id}', [ShopController::class, 'addToCart'])->name('cart.add');

/*
|--------------------------------------------------------------------------
| 2. REDIRECTION APRÈS LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('shop.index');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| 3. PARTIE ADMIN (Nouhaila) - M7LOULA DABA BLA LOGIN
|--------------------------------------------------------------------------
*/
// 7iyidna middleware(['auth']) bach t-dkholi nichan t-testi s-sel3a
Route::prefix('admin')->group(function () {
    
    // URL: http://127.0.0.1:8000/admin/dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // CRUD dyal s-sel3a (URL: http://127.0.0.1:8000/admin/products)
    Route::resource('products', ProductController::class);
});

/*
|--------------------------------------------------------------------------
| 4. PROFIL & AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';