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

        // 2. Filtrage b l-Category
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 3. Recherche b s-smiya
        if ($request->filled('search')) {
            $query->where('nom', 'LIKE', '%' . $request->search . '%');
        }

        // 4. Jbed sel3a w lcategories
        $products = $query->with('category')->latest()->get();
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

        $validated['image'] = $this->handleImageUpload($request);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produit ajouté !');
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

        $validated['image'] = $this->handleImageUpload($request);

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Mis à jour avec succès !');
    }


    private function handleImageUpload($request, $currentImage = null)
    {
        if ($request->hasFile('image')) {
            if ($currentImage) {
                Storage::disk('public')->delete($currentImage);
            }
            return $request->file('image')->store('products', 'public');
        }
        return $currentImage;
    }


    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Produit supprimé !');
    }
}
