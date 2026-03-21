<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        // 1. Validate Shipping Info
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Your cart is empty.');
        }

        // 2. Database Transaction (All or Nothing)
        try {
            $reference = 'MB-' . strtoupper(Str::random(10));
            DB::transaction(function () use ($cart, $reference, $request) {

                // Create the Order
                $order = Order::create([
                    'user_id' => Auth::id(),
                    'reference' => $reference,
                    'total_amount' => $this->calculateTotal($cart),
                    'status' => 'pending',
                    'shipping_address' => $request->address,
                    'city' => $request->city,
                    'phone' => $request->phone,
                ]);

                // Create Order Items and Update Stock
                foreach ($cart as $id => $details) {

                    $product = Product::findOrFail($id);

                    // --- AJOUT : Vérification du stock (Exigence Cahier des charges) ---
                    if ($product->stock < $details['quantity']) {
                        // On lance une exception pour annuler toute la transaction
                        throw new \Exception("Stock insuffisant pour le produit: {$product->name}");
                    }
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
            return redirect()->route('order.confirmation')->with('ref', $reference);

        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


    /**
     * Calculate cart total helper
     */
    private function calculateTotal($cart)
    {
        return array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    }
    public function checkout()
    {
        return view('order.checkout');
    }
    public function merci()
    {
        return view('order.confirmation');
    }
}
