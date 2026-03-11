<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\Admin\DashboardController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::resource('admin/products', ProductController::class);

Route::get('/shop/{id}', [ShopController::class, 'show'])->name('shop.show');
Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
require __DIR__.'/auth.php';
