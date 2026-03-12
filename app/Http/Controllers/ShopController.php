<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Page d'accueil de la boutique
    public function index()
    {
        $products = Product::all();
        return view('shop.index', compact('products'));
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
