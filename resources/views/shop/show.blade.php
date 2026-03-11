<div style="max-width: 1100px; margin: 50px auto; padding: 20px; font-family: 'Segoe UI', sans-serif;">
    <div style="display: flex; gap: 50px; flex-wrap: wrap;">
        
        <div style="flex: 1; min-width: 350px;">
            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom }}" 
                 style="width: 100%; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        </div>

        <div style="flex: 1; min-width: 350px;">
            <p style="color: #b58d67; text-transform: uppercase; letter-spacing: 2px; font-weight: bold; margin-bottom: 10px;">
                {{ $product->category->nom }}
            </p>
            <h1 style="font-size: 36px; margin: 0 0 20px 0; color: #333;">{{ $product->nom }}</h1>
            
            <p style="font-size: 24px; color: #b58d67; font-weight: bold; margin-bottom: 30px;">
                {{ number_format($product->prix, 2) }} DH
            </p>

            <div style="line-height: 1.8; color: #666; margin-bottom: 40px;">
                <h4 style="color: #333;">Description</h4>
                <p>{{ $product->description }}</p>
            </div>

            <form action="#" method="POST">
                @csrf
                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 8px; font-weight: bold;">Quantité :</label>
                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" 
                           style="width: 80px; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <span style="margin-left: 10px; color: #888; font-size: 14px;">({{ $product->stock }} en stock)</span>
                </div>

                <button type="submit" style="width: 100%; background: #1a1a1a; color: white; padding: 15px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; transition: 0.3s;"
                        onmouseover="this.style.background='#b58d67'" onmouseout="this.style.background='#1a1a1a'">
                    AJOUTER AU PANIER
                </button>
            </form>

            <a href="{{ route('shop.index') }}" style="display: inline-block; margin-top: 25px; color: #888; text-decoration: none; font-size: 14px;">
                ← Retour à la boutique
            </a>
        </div>

    </div>
</div>