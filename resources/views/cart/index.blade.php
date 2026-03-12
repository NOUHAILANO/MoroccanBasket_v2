@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 0 auto; padding: 40px 20px; font-family: 'Poppins', sans-serif;">
    
    <div style="text-align: center; margin-bottom: 40px;">
        <h1 style="font-size: 32px; color: #2c3e50;">VOTRE PANIER</h1>
        <div style="width: 50px; height: 2px; background: #b58d67; margin: 10px auto;"></div>
    </div>

    @if(count($cart) > 0)
        <div style="background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); padding: 20px;">
            @foreach($cart as $id => $item)
                <div style="display: flex; align-items: center; border-bottom: 1px solid #eee; padding: 15px 0;">
                    <img src="{{ asset('storage/' . $item['image']) }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px;">
                    
                    <div style="flex-grow: 1; margin-left: 20px;">
                        <h4 style="margin: 0; color: #333;">{{ $item['name'] }}</h4>
                        <p style="margin: 5px 0; color: #b58d67; font-weight: bold;">{{ number_format($item['price'], 2) }} DH</p>
                    </div>

                    <div style="text-align: center; margin-right: 30px;">
                        <span style="display: block; font-size: 12px; color: #888;">Quantité</span>
                        <span style="font-weight: bold;">{{ $item['quantity'] }}</span>
                    </div>

                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; font-size: 18px;">&times;</button>
                    </form>
                </div>
            @endforeach

            <div style="margin-top: 30px; text-align: right;">
                <h3 style="color: #2c3e50;">Total : {{ number_format($total, 2) }} DH</h3>
                
                <form action="{{ route('order.store') }}" method="POST" style="margin-top: 20px;">
                    @csrf
                    <button type="submit" style="background: #1a1a1a; color: white; padding: 15px 40px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.3s;"
                            onmouseover="this.style.background='#b58d67'" onmouseout="this.style.background='#1a1a1a'">
                        VALIDER MA COMMANDE
                    </button>
                </form>
            </div>
        </div>
    @else
        <div style="text-align: center; padding: 50px;">
            <p style="color: #888; font-style: italic;">Votre panier est vide.</p>
            <a href="{{ route('shop.index') }}" style="color: #b58d67; text-decoration: underline;">Continuer mes achats</a>
        </div>
    @endif
</div>
@endsection