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
        return view('orders.checkout');
    }
}
