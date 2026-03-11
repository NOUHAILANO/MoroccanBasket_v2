<div style="padding: 30px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Gestion du Stock</h2>
        <a href="{{ route('products.create') }}" style="background: #27ae60; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">+ Ajouter un Panier</a>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <thead>
            <tr style="background: #f8f9fa; border-bottom: 2px solid #eee;">
                <th style="padding: 15px;">Image</th>
                <th style="padding: 15px;">Nom</th>
                <th style="padding: 15px;">Prix</th>
                <th style="padding: 15px;">Stock</th>
                <th style="padding: 15px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr style="border-bottom: 1px solid #eee; text-align: center;">
                <td style="padding: 10px;">
                    <img src="{{ asset('storage/' . $product->image) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                </td>
                <td style="padding: 15px;">{{ $product->nom }}</td>
                <td style="padding: 15px;">{{ number_format($product->prix, 2) }} DH</td>
                <td style="padding: 15px;">
                    <span style="padding: 5px 10px; border-radius: 15px; background: {{ $product->stock <= 5 ? '#fdedec' : '#eafaf1' }}; color: {{ $product->stock <= 5 ? '#e74c3c' : '#27ae60' }};">
                        {{ $product->stock }}
                    </span>
                </td>
                <td style="padding: 15px;">
                    <a href="{{ route('products.edit', $product->id) }}" style="color: #3498db; text-decoration: none; margin-right: 10px;">Modifier</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                        @csrf @method('DELETE')
                        <button type="submit" style="color: #e74c3c; background: none; border: none; cursor: pointer;" onclick="return confirm('Supprimer ce panier ?')">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>