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

        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
        ]);
        // 1. Récupérer le panier (stocké en session par exemple)
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Panier vide');
        }

        // 2. Utiliser une transaction pour s'assurer que tout s'enregistre bien
        try {
            DB::transaction(function () use ($cart, $request) {

                // Create the Order
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'reference' => 'MB-' . strtoupper(Str::random(10)), // Moroccan Basket prefix
                    'total_amount' => $this->calculateTotal($cart),
                    'status' => 'pending',
                    'shipping_address' => $request->address,
                    'city' => $request->city,
                    'phone' => $request->phone,
                ]);

                // Create Order Items and Update Stock
                foreach ($cart as $id => $details) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $id,
                        'quantity' => $details['quantity'],
                        'price' => $details['price'],
                    ]);

                    // Update product stock
                    $product = Product::findOrFail($id);
                    $product->decrement('stock', $details['quantity']);
                }
            });

            // 3. Clear Cart and Redirect
            session()->forget('cart');
            return redirect()->route('confirmation')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
