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
        $query = Product::query();

        // 1. Filtrage b l-Category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 2. Recherche b s-smiya (nom)
        if ($request->filled('search')) {
            $query->where('nom', 'LIKE', '%' . $request->search . '%');
        }

        // 3. Jbed sel3a m3a l-categories dyalha
        $products = $query->with('category')->latest()->paginate(10);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        // K-n-3tiw l-fonction ghir l-$request 7it mafihch image qdima
        $validated['image'] = $this->handleImageUpload($request);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès !');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nom' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        // HNA: Khassna n-siftou s-soura l-qdima bach t-msa7 ila derti jdida
        $validated['image'] = $this->handleImageUpload($request, $product->image);

        // HNA: Khass t-welli update() machi create()
        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès !');
    }

    // Fonction wa7da k-t-t-kala b l-upload o l-hadf dial s-tsawer
    private function handleImageUpload($request, $currentImage = null)
    {
        if ($request->hasFile('image')) {
            // Ila kanti derti update o zti soura jdida, msa7 l-qdima mn storage
            if ($currentImage) {
                Storage::disk('public')->delete($currentImage);
            }
            // Stocki s-soura f 'public/products'
            return $request->file('image')->store('products', 'public');
        }
        // Ila ma-beddeltich s-soura f l-update, khali l-qdima kif hiya
        return $currentImage;
    }

    public function destroy(Product $product)
    {
        // Msa7 s-soura mn l-disk qbel ma t-msa7 l-produit
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produit supprimé !');
    }
}