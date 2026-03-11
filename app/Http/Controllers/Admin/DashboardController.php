<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB; // <--- Importation indispensable

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques globales
        $totalProduits = Product::count();
        $totalCategories = Category::count();
        
        // Alerte stocks : On récupère aussi la catégorie pour l'affichage
        $stockFaible = Product::with('category')->where('stock', '<=', 5)->get(); 
        
        // Calcul de la valeur monétaire du stock
        $valeurStock = Product::select(DB::raw('SUM(prix * stock) as total'))->first()->total ?? 0;

        return view('admin.dashboard', [
            'totalProduits'   => $totalProduits,
            'totalCategories' => $totalCategories,
            'stockFaible'     => $stockFaible,
            'valeurStock'     => $valeurStock,
        ]);
    }
}