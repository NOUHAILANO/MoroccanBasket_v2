<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // Valider et enregistrer la commande
    public function store(Request $request)
    {
        // 1. Récupérer le panier (stocké en session par exemple)
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Votre panier est vide.');
        }

        // 2. Utiliser une transaction pour s'assurer que tout s'enregistre bien
        DB::transaction(function () use ($cart, $request) {
            
            // Créer la commande principale
            $order = Order::create([
                'user_id' => Auth::id(),
                'reference' => 'CMD-' . strtoupper(Str::random(8)),
                'total_amount' => $this->calculateTotal($cart),
                'status' => 'en_attente',
            ]);

            foreach ($cart as $id => $details) {
                // Créer l'article de commande
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);

                
                $product = Product::find($id);
                $product->decrement('stock', $details['quantity']);
            }
        });

        // Vider le panier après succès
        session()->forget('cart');

        return redirect()->route('confirmation')->with('success', 'Commande validée !');
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}