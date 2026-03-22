@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px; font-family: 'Playfair Display', serif;">
    
    <div style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: 42px; color: #2c3e50; margin-bottom: 10px; letter-spacing: 2px; text-transform: uppercase;">Finaliser la commande</h1>
        <div style="width: 80px; height: 2px; background: #b58d67; margin: 20px auto;"></div>
    </div>

    <div style="display: grid; grid-template-columns: 1fr 400px; gap: 40px; align-items: start;">
        
        <form action="{{ route('order.store') }}" method="POST" 
              style="background: white; padding: 40px; border-radius: 12px; border: 1px solid #eee; box-shadow: 0 10px 20px rgba(0,0,0,0.05); font-family: 'Poppins', sans-serif;">
            @csrf
            
            <h3 style="font-family: 'Playfair Display', serif; font-size: 24px; margin-bottom: 30px; color: #1a1a1a;">Informations de Livraison</h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 13px; color: #888; margin-bottom: 8px; text-transform: uppercase;">Nom Complet</label>
                    <input type="text" name="name" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>

                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 13px; color: #888; margin-bottom: 8px; text-transform: uppercase;">Adresse Email</label>
                    <input type="email" name="email" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>

                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 13px; color: #888; margin-bottom: 8px; text-transform: uppercase;">Adresse de Livraison</label>
                    <input type="text" name="address" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>

                <div>
                    <label style="display: block; font-size: 13px; color: #888; margin-bottom: 8px; text-transform: uppercase;">Ville</label>
                    <input type="text" name="city" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>

                <div>
                    <label style="display: block; font-size: 13px; color: #888; margin-bottom: 8px; text-transform: uppercase;">Téléphone</label>
                    <input type="tel" name="phone" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
                </div>
            </div>

            <button type="submit" 
                style="width: 100%; margin-top: 40px; background: #1a1a1a; color: white; border: none; padding: 18px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.3s; letter-spacing: 1px;"
                onmouseover="this.style.background='#b58d67'" onmouseout="this.style.background='#1a1a1a'">
                CONFIRMER LE PAIEMENT
            </button>
        </form>

        <div style="background: #fdfbf9; padding: 30px; border-radius: 12px; border: 1px solid #eaddcf; font-family: 'Poppins', sans-serif;">
            <h3 style="font-family: 'Playfair Display', serif; font-size: 20px; margin-bottom: 20px;">Votre Panier</h3>
            @php $total = 0; @endphp
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    @php $total += $details['price'] * $details['quantity'] @endphp
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px; font-size: 14px;">
                        <span>{{ $details['name'] }} (x{{ $details['quantity'] }})</span>
                        <span style="font-weight: 600;">{{ number_format($details['price'] * $details['quantity'], 2) }} DH</span>
                    </div>
                @endforeach
                <div style="border-t: 1px solid #eaddcf; margin-top: 20px; pt: 20px; display: flex; justify-content: space-between; font-weight: bold; font-size: 18px; color: #b58d67;">
                    <span>Total</span>
                    <span>{{ number_format($total, 2) }} DH</span>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection