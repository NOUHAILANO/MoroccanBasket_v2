@extends('layouts.admin') 

@section('content')
<div style="padding: 40px 5%; font-family: 'Poppins', sans-serif;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 32px; margin: 0;">Gestion des Commandes</h2>
            <p style="color: #888; margin: 5px 0 0 0;">Suivi des ventes de MoroccanBasket</p>
        </div>
        <div style="background: white; padding: 10px 20px; border-radius: 8px; border: 1px solid #eee; font-weight: 600; color: #b58d67;">
            Total: {{ $orders->total() }} commandes
        </div>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #eee;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #fdfaf7; border-bottom: 2px solid #eee; color: #b58d67; text-transform: uppercase; font-size: 13px; letter-spacing: 1px;">
                    <th style="padding: 20px;">Référence</th>
                    <th style="padding: 20px;">Client</th>
                    <th style="padding: 20px;">Date</th>
                    <th style="padding: 20px;">Montant Total</th>
                    <th style="padding: 20px;">Statut</th>
                    <th style="padding: 20px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr style="border-bottom: 1px solid #f9f9f9; transition: 0.2s;" onmouseover="this.style.background='#fcfcfc'" onmouseout="this.style.background='white'">
                    <td style="padding: 20px;">
                        <span style="font-weight: 700; color: #1a1a1a;">{{ $order->reference }}</span>
                    </td>
                    <td style="padding: 20px;">
                        <span style="font-weight: 600; color: #333; display: block;">{{ $order->name ?? $order->user->name }}</span>
                        <small style="color: #aaa;">{{ $order->city }}</small>
                    </td>
                    <td style="padding: 20px; color: #777; font-size: 14px;">
                        {{ $order->created_at->format('d/m/Y') }}
                        <br><small>{{ $order->created_at->format('H:i') }}</small>
                    </td>
                    <td style="padding: 20px; font-weight: bold; color: #b58d67; font-size: 16px;">
                        {{ number_format($order->total_amount, 2) }} DH
                    </td>
                    <td style="padding: 20px;">
                        @php
                            $statusColors = [
                                'en_attente' => ['bg' => '#fff9db', 'text' => '#f08c00', 'label' => 'En attente'],
                                'expediee'   => ['bg' => '#e7f5ff', 'text' => '#1971c2', 'label' => 'Expédiée'],
                                'livree'     => ['bg' => '#ebfbee', 'text' => '#2f9e41', 'label' => 'Livrée'],
                                'annulee'    => ['bg' => '#fff5f5', 'text' => '#e03131', 'label' => 'Annulée'],
                            ];
                            $style = $statusColors[$order->status] ?? ['bg' => '#f8f9fa', 'text' => '#495057', 'label' => $order->status];
                        @endphp
                        <span style="padding: 6px 14px; border-radius: 20px; font-size: 12px; font-weight: 700; text-transform: uppercase; background: {{ $style['bg'] }}; color: {{ $style['text'] }};">
                            {{ $style['label'] }}
                        </span>
                    </td>
                    <td style="padding: 20px; text-align: right;">
                        <a href="{{ route('admin.orders.show', $order) }}" 
                           style="background: #1a1a1a; color: white; padding: 8px 18px; text-decoration: none; border-radius: 6px; font-size: 13px; font-weight: 600; transition: 0.3s;"
                           onmouseover="this.style.background='#b58d67'" onmouseout="this.style.background='#1a1a1a'">
                            Détails
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 60px; color: #888; font-style: italic;">
                        Aucune commande n'a été trouvée dans le système.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px;">
        {{ $orders->links() }}
    </div>
</div>
@endsection 