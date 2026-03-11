@extends('layouts.admin')

@section('content')
<div style="padding: 10px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="font-family: 'Playfair Display', serif; margin: 0; color: #333;">Tableau de Bord</h2>
        <span style="color: #888; font-size: 14px;">{{ now()->format('d/m/2026') }}</span>
    </div>

    <div style="display: flex; gap: 20px; margin-bottom: 40px;">
        <div style="flex: 1; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 5px solid #3498db;">
            <h4 style="margin: 0; color: #3498db; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Total Produits</h4>
            <h2 style="margin: 15px 0 0 0; font-size: 32px;">{{ $totalProduits }}</h2>
        </div>
        
        <div style="flex: 1; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 5px solid #27ae60;">
            <h4 style="margin: 0; color: #27ae60; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Valeur Stock</h4>
            <h2 style="margin: 15px 0 0 0; font-size: 32px;">{{ number_format($valeurStock, 2) }} DH</h2>
        </div>

        <div style="flex: 1; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-left: 5px solid #e67e22;">
            <h4 style="margin: 0; color: #e67e22; font-size: 14px; text-transform: uppercase; letter-spacing: 1px;">Catégories</h4>
            <h2 style="margin: 15px 0 0 0; font-size: 32px;">{{ $totalCategories }}</h2>
        </div>
    </div>

    <div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
            <h3 style="margin: 0; font-family: 'Playfair Display', serif; color: #e74c3c;">⚠️ Alertes Stock Faible (≤ 5)</h3>
            <a href="{{ route('products.index') }}" style="color: #3498db; text-decoration: none; font-size: 14px; font-weight: 600;">Tout gérer</a>
        </div>

        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #fdfdfd; text-align: left; border-bottom: 2px solid #eee;">
                    <th style="padding: 15px; color: #888; font-weight: 600;">Nom du Produit</th>
                    <th style="padding: 15px; color: #888; font-weight: 600;">Catégorie</th>
                    <th style="padding: 15px; color: #888; font-weight: 600;">Stock</th>
                    <th style="padding: 15px; color: #888; font-weight: 600;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stockFaible as $p)
                <tr style="border-bottom: 1px solid #f9f9f9;">
                    <td style="padding: 15px; font-weight: 500;">{{ $p->nom }}</td>
                    <td style="padding: 15px;"><span style="background: #eee; padding: 4px 10px; border-radius: 20px; font-size: 12px;">{{ $p->category->nom }}</span></td>
                    <td style="padding: 15px; color: #e74c3c; font-weight: bold;">{{ $p->stock }}</td>
                    <td style="padding: 15px;">
                        <a href="{{ route('products.edit', $p->id) }}" style="background: #3498db; color: white; padding: 6px 12px; text-decoration: none; border-radius: 4px; font-size: 12px;">Modifier</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 40px; text-align: center; color: #27ae60; font-weight: 600;">
                        ✨ Félicitations ! Tous les produits sont bien approvisionnés.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection