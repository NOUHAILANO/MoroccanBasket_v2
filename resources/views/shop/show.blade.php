<div class="product-container" style="display: flex; gap: 50px; padding: 50px; font-family: 'Segoe UI', sans-serif;">
    
    <div class="product-image" style="flex: 1;">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom }}" style="width: 100%; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
    </div>

    <div class="product-details" style="flex: 1;">
        <p style="text-transform: uppercase; color: #888; letter-spacing: 2px; font-size: 12px;">{{ $product->category->nom }}</p>
        <h1 style="font-size: 32px; margin-top: 10px;">{{ $product->nom }}</h1>
        <p style="font-size: 24px; color: #2c3e50; font-weight: bold; margin: 20px 0;">{{ $product->prix }} DH</p>
        
        <div class="description" style="line-height: 1.6; color: #555; margin-bottom: 30px;">
            {{ $product->description }}
        </div>

        <p style="margin-bottom: 20px;">
            État du stock : 
            <span style="color: {{ $product->stock > 0 ? '#27ae60' : '#e74c3c' }}; font-weight: bold;">
                {{ $product->stock > 0 ? 'En stock (' . $product->stock . ')' : 'Rupture de stock' }}
            </span>
        </p>

        @if($product->stock > 0)
            <form action="#" method="POST"> @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" style="padding: 10px; width: 60px;">
                <button type="submit" style="background: #000; color: #fff; padding: 12px 30px; border: none; cursor: pointer; margin-left: 10px;">
                    AJOUTER AU PANIER
                </button>
            </form>
        @endif

        <div style="margin-top: 40px;">
            <a href="{{ route('shop.index') }}" style="color: #333; text-decoration: underline;">← Retour au catalogue</a>
        </div>
    </div>
</div>