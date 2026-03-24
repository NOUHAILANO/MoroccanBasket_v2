<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistiques globales
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', '!=', 'annulée')->sum('total_amount');
        $totalProduits = Product::count();
        $totalCategories = Category::count();

        // Alerte stocks : On récupère aussi la catégorie pour l'affichage
        $stockFaible = Product::with('category')->where('stock', '<=', 5)->get();

        // Calcul de la valeur monétaire du stock
        $valeurStock = Product::select(DB::raw('SUM(price * stock) as total'))->first()->total ?? 0;

        return view('admin.dashboard', [
            'totalProduits'   => $totalProduits,
            'totalCategories' => $totalCategories,
            'stockFaible'     => $stockFaible,
            'valeurStock'     => $valeurStock,
            'totalOrders'     => $totalOrders,
            'totalRevenue'    => $totalRevenue,
        ]);
    }


    /**
     * Affiche la liste complète de toutes les commandes.
     */

    public function ordersIndex()
    {
        // On récupère les commandes avec l'utilisateur associé pour éviter le problème N+1
        $orders = Order::with('user')->latest()->paginate(15);

        return view('admin.orders.index', compact('orders'));
    }


    /**
     * Affiche les détails d'une commande spécifique (Produits, infos client).
     */

    public function ordersShow(Order $order)
    {
        // On charge les relations nécessaires pour la page détaillée
        $order->load(['items.product', 'user']);

        return view('admin.orders.show', compact('order'));
    }


    /**
     * Met à jour le statut d'une commande depuis l'interface admin.
     */

    public function updateStatus(Request $request, Order $order)
    {
        // 1. Validation du nouveau statut envoyé par le formulaire
        $request->validate([
            'status' => 'required|in:en_attente,expediee,livree,annulee',
        ]);

        // 2. Mise à jour de la commande
        $order->status = $request->status;
        $order->save();

        // 3. Redirection avec message de succès
        return back()->with('success', 'Le statut de la commande #' . $order->reference . ' a été mis à jour avec succès.');
    }
}
