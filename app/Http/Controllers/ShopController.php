<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Page d'accueil de la boutique
    public function index(Request $request)
{
    $query = Product::query();

    // 1. Filtering by Category
    if ($request->has('category') && $request->category != '') {
        $query->where('category_id', $request->category);
    }

    // 2. Pagination (6 products per page)
    $products = $query->with('category')->paginate(6);
    $categories = Category::all();

        return view('shop.index', compact('products', 'categories'));
}

    // Détails d'un produit
    public function show($id)
    {
        // Zdna with('category') bach t-7iyd l-error dyal category->nom
        $product = Product::with('category')->findOrFail($id);
        return view('shop.show', compact('product'));
    }


    // Page du panier
    public function cart()
    {
        return view('shop.cart');
    }
}
