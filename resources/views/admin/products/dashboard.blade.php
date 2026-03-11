<div style="padding: 30px; font-family: sans-serif; background: #f4f7f6; min-height: 100vh;">
    <h1 style="color: #2c3e50;">Tableau de Bord - Moroccan Basket</h1>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-top: 20px;">
        
        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 5px solid #3498db;">
            <p style="color: #7f8c8d; margin: 0;">Total Produits</p>
            <h2 style="margin: 10px 0; color: #2c3e50;">{{ $totalProduits }}</h2>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 5px solid #9b59b6;">
            <p style="color: #7f8c8d; margin: 0;">Catégories</p>
            <h2 style="margin: 10px 0; color: #2c3e50;">{{ $totalCategories }}</h2>
        </div>

        <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); border-left: 5px solid #f1c40f;">
            <p style="color: #7f8c8d; margin: 0;">Valeur du Stock</p>
            <h2 style="margin: 10px 0; color: #2c3e50;">{{ number_format($valeurStock, 2) }} DH</h2>
        </div>

    </div>

    <div style="margin-top: 40px; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <h3 style="color: #e74c3c; margin-top: 0;">⚠️ Alertes Stocks Faibles</h3>
        <table style="width: 100%; border-collapse: collapse; margin-top: 15px;">
            <thead>
                <tr style="text-align: left; border-bottom: 2px solid #eee;">
                    <th style="padding: 10px;">Produit</th>
                    <th style="padding: 10px;">Stock restant</th>
                    <th style="padding: 10px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stockFaible as $item)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px;">{{ $item->nom }}</td>
                    <td style="padding: 10px; color: #e74c3c; font-weight: bold;">{{ $item->stock }}</td>
                    <td style="padding: 10px;">
                        <a href="{{ route('products.edit', $item->id) }}" style="color: #3498db;">Réapprovisionner</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" style="padding: 20px; text-align: center; color: #27ae60;">Tous les stocks sont au vert ! ✅</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>