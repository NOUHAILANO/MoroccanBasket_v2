<div style="max-width: 1200px; margin: auto; padding: 40px;">
    <h1 style="text-align: center; font-family: serif; margin-bottom: 50px;">Nos Paniers Marocains</h1>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">
        @foreach($products as $product)
        <div style="border: 1px solid #f0f0f0; border-radius: 5px; overflow: hidden; transition: 0.3s;">
            <img src="{{ asset('storage/' . $product->image) }}" style="width: 100%; height: 300px; object-fit: cover;">
            <div style="padding: 20px; text-align: center;">
                <h3 style="margin: 0; font-size: 18px;">{{ $product->nom }}</h3>
                <p style="color: #b58d67; font-weight: bold; margin: 10px 0;">{{ number_format($product->prix, 2) }} DH</p>
                <a href="{{ route('shop.show', $product->id) }}" style="background: #1a1a1a; color: #fff; padding: 10px 25px; text-decoration: none;">
    Découvrir
</a>
            </div>
        </div>
        @endforeach
    </div>
</div>