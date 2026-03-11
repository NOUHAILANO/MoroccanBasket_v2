@extends('layouts.app')

@section('content')
<div style="max-width: 1200px; margin: 0 auto; padding: 40px 20px; font-family: 'Playfair Display', serif;">
    
    <div style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: 42px; color: #2c3e50; margin-bottom: 10px; letter-spacing: 2px;">MOROCCAN BASKET</h1>
        <p style="color: #888; font-style: italic;">L'essence de l'artisanat et du soin au naturel</p>
        <div style="width: 80px; height: 2px; background: #b58d67; margin: 20px auto;"></div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">
        @foreach($products as $product)
        <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.05); transition: 0.3s; border: 1px solid #eee;" 
             onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
            
            <div style="height: 300px; overflow: hidden; position: relative;">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom }}" 
                     style="width: 100%; height: 100%; object-fit: cover;">
                
                <span style="position: absolute; top: 15px; left: 15px; background: rgba(255,255,255,0.9); padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; color: #b58d67; text-transform: uppercase;">
                    {{ $product->category->nom }}
                </span>
            </div>

            <div style="padding: 20px; text-align: center;">
                <h3 style="font-size: 20px; margin: 0 0 10px 0; color: #333; font-family: 'Poppins', sans-serif;">{{ $product->nom }}</h3>
                <p style="color: #b58d67; font-size: 18px; font-weight: bold; margin-bottom: 20px; font-family: 'Poppins', sans-serif;">
                    {{ number_format($product->prix, 2) }} DH
                </p>
                
                <a href="{{ route('shop.show', $product->id) }}" 
                   style="display: block; background: #1a1a1a; color: white; text-decoration: none; padding: 12px; border-radius: 6px; font-weight: 500; transition: 0.3s; font-family: 'Poppins', sans-serif;"
                   onmouseover="this.style.background='#b58d67'" onmouseout="this.style.background='#1a1a1a'">
                    DÉCOUVRIR
                </a>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection