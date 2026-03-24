@extends('layouts.admin')

@section('content')
<div style="padding: 40px 5%; font-family: 'Poppins', sans-serif;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <a href="{{ route('admin.orders.index') }}" style="color: #888; text-decoration: none; font-size: 14px; font-weight: 600;">
            &larr; Retour à la liste
        </a>
        <div style="display: flex; gap: 10px;">
            <button onclick="window.print()" style="background: #f5f5f5; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600;">
                🖨️ Imprimer Facture
            </button>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">
        
        <div>
            <div style="background: white; border-radius: 12px; padding: 30px; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                <h3 style="font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 25px; border-bottom: 2px solid #fdfaf7; padding-bottom: 10px;">
                    Détails de la Commande <span style="color: #b58d67;">#{{ $order->reference }}</span>
                </h3>

                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="text-align: left; color: #aaa; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">
                            <th style="padding-bottom: 15px;">Produit</th>
                            <th style="padding-bottom: 15px;">Prix</th>
                            <th style="padding-bottom: 15px; text-align: center;">Qté</th>
                            <th style="padding-bottom: 15px; text-align: right;">Sous-total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr style="border-top: 1px solid #f9f9f9;">
                            <td style="padding: 15px 0; display: flex; align-items: center; gap: 15px;">
                                <div style="width: 50px; height: 50px; background: #fdfaf7; border-radius: 8px; border: 1px solid #eee; display: flex; align-items: center; justify-content: center;">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('storage/' . $item->product->image) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 8px;">
                                    @else
                                        <span style="font-size: 8px; color: #ccc;">N/A</span>
                                    @endif
                                </div>
                                <span style="font-weight: 600; color: #333;">{{ $item->product->nom ?? 'Produit supprimé' }}</span>
                            </td>
                            <td style="padding: 15px 0; color: #777;">{{ number_format($item->price, 2) }} DH</td>
                            <td style="padding: 15px 0; text-align: center; font-weight: 600;">{{ $item->quantity }}</td>
                            <td style="padding: 15px 0; text-align: right; font-weight: bold; color: #1a1a1a;">
                                {{ number_format($item->price * $item->quantity, 2) }} DH
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div style="margin-top: 30px; padding-top: 20px; border-top: 2px solid #1a1a1a; display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-family: 'Playfair Display', serif; font-size: 22px; font-weight: bold;">TOTAL</span>
                    <span style="font-size: 24px; font-weight: bold; color: #b58d67;">{{ number_format($order->total_amount, 2) }} DH</span>
                </div>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 30px;">
            
            <div style="background: white; border-radius: 12px; padding: 25px; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                <h4 style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: #b58d67; margin-top: 0;">Mettre à jour le statut</h4>
                <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                    @csrf @method('PATCH')
                    <select name="status" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid #eee; margin: 15px 0; font-family: 'Poppins', sans-serif; outline: none;">
                        <option value="en_attente" {{ $order->status == 'en_attente' ? 'selected' : '' }}>En attente</option>
                        <option value="expediee" {{ $order->status == 'expediee' ? 'selected' : '' }}>Expédiée</option>
                        <option value="livree" {{ $order->status == 'livree' ? 'selected' : '' }}>Livrée</option>
                        <option value="annulee" {{ $order->status == 'annulee' ? 'selected' : '' }}>Annulée</option>
                    </select>
                    <button type="submit" style="width: 100%; background: #1a1a1a; color: white; border: none; padding: 12px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.3s;"
                            onmouseover="this.style.background='#b58d67'" onmouseout="this.style.background='#1a1a1a'">
                        Enregistrer
                    </button>
                </form>
            </div>

            <div style="background: white; border-radius: 12px; padding: 25px; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                <h4 style="font-size: 14px; text-transform: uppercase; letter-spacing: 1px; color: #b58d67; margin-top: 0;">Informations Client</h4>
                <div style="margin-top: 15px; font-size: 14px; line-height: 1.8;">
                    <p style="margin: 0;"><strong>Nom:</strong> {{ $order->name }}</p>
                    <p style="margin: 0;"><strong>Tél:</strong> {{ $order->phone }}</p>
                    <p style="margin: 0;"><strong>Ville:</strong> {{ $order->city }}</p>
                    <p style="margin: 10px 0 0 0; color: #777;"><strong>Adresse de livraison:</strong><br>{{ $order->shipping_address }}</p>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection