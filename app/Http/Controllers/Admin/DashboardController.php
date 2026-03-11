<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduits = Product::count();
        $totalCategories = Category::count();
        $stockFaible = Product::where('stock', '<=', 5)->get(); // Alerte si stock <= 5
        $valeurStock = Product::sum(\DB::raw('prix * stock'));

        return view('admin.dashboard', compact(
            'totalProduits', 
            'totalCategories', 
            'stockFaible', 
            'valeurStock'
        ));
    }
}
