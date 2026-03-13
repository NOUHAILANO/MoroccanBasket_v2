<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
public function index(Request $request)
{
    // 1. Bdaw b query
    $query = Product::query();

    // 2. Filtrage b l-Category
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // 3. Recherche b s-smiya
    if ($request->filled('search')) {
        $query->where('nom', 'LIKE', '%' . $request->search . '%');
    }

    // 4. Jbed s-sel3a w l-categories
    $products = $query->with('category')->latest()->get();
    $categories = Category::all();

    return view('admin.products.index', compact('products', 'categories'));
}

    public function create() {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'nom' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produit ajouté !');
    }

    // GADINA HADI: 7yedna l-mouchkil dyal "Double Déclaration"
    public function edit(Product $product) {
        $categories = Category::all();
        // Zdna categories bach tqdri t-bedliha f l-page Edit
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product) {
        $validated = $request->validate([
            'nom' => 'required|max:255',
            'description' => 'nullable', // Zdna hadi bach may-t-bloquach
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Kat-7eyyed t-swira l-qdima mn storage bach may-t-3mmarch 3la l-khawi
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Mis à jour avec succès !');
    }

    public function destroy(Product $product) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produit supprimé !');
    }
}