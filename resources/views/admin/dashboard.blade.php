<div style="padding: 30px; font-family: sans-serif;">
    <div style="display: flex; gap: 20px;">
        <div style="flex: 1; background: #ebf5fb; padding: 25px; border-left: 5px solid #3498db;">
            <h4 style="margin: 0; color: #3498db;">Total Produits</h4>
            <h2 style="margin: 10px 0;">{{ $totalProduits }}</h2>
        </div>
        <div style="flex: 1; background: #eafaf1; padding: 25px; border-left: 5px solid #27ae60;">
            <h4 style="margin: 0; color: #27ae60;">Valeur Stock</h4>
            <h2 style="margin: 10px 0;">{{ number_format($valeurStock, 2) }} DH</h2>
        </div>
    </div>
    
    <div style="margin-top: 40px;">
        <h3>Alertes Stock Faible (<= 5)</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <tr style="background: #f8f9f9; text-align: left;">
                <th style="padding: 12px;">Produit</th>
                <th style="padding: 12px;">Stock</th>
            </tr>
            @foreach($stockFaible as $p)
            <tr style="border-bottom: 1px solid #eee;">
                <td style="padding: 12px;">{{ $p->nom }}</td>
                <td style="padding: 12px; color: #e74c3c; font-weight: bold;">{{ $p->stock }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>