<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Utilisé pour générer le slug automatiquement

class CategoryController extends Controller
{
    /**
     * Affiche la liste des catégories (Image 6).
     */
    public function index()
    {
        // withCount('products') permet d'afficher le nombre de produits par catégorie dans le tableau
        $categories = Category::withCount('products')->orderBy('nom', 'asc')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Affiche le formulaire de création d'une nouvelle catégorie.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Enregistre la nouvelle catégorie en base de données.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom', // Vérifie que le nom est unique
        ]);

        Category::create([
            'nom' => $request->nom,
            'slug' => Str::slug($request->nom), // Crée un slug (ex: "Art de la table" devient "art-de-la-table")
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie créée avec succès.');
    }

    /**
     * Affiche le formulaire de modification (Point 2.2 de l'Image 6).
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Met à jour la catégorie en base de données (Point 2.2).
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nom' => 'required|string|max:255|unique:categories,nom,' . $category->id,
        ]);

        $category->update([
            'nom' => $request->nom,
            'slug' => Str::slug($request->nom),
        ]);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Catégorie modifiée avec succès.');
    }

    /**
     * Supprime la catégorie (Point 2.3 de l'Image 6 : La sécurité).
     */
    public function destroy(Category $category)
    {
        // LA RÈGLE DE SÉCURITÉ : Empêcher suppression si produits liés
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient ' . $category->products()->count() . ' produit(s). Vous devez d\'abord supprimer ou déplacer ces produits.');
        }

        // Si tout est ok (0 produits liés), on supprime
        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'La catégorie a été supprimée définitivement.');
    }
}