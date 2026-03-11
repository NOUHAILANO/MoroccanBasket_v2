@extends('layouts.admin')

@section('content')
<div style="padding: 40px 5%; font-family: 'Poppins', sans-serif;">
    
    <div style="margin-bottom: 40px;">
        <h2 style="font-family: 'Playfair Display', serif; font-size: 32px; margin: 0;">Tableau de Bord</h2>
        <p style="color: #888;">Bienvenue dans la gestion de MoroccanBasket.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 40px;">
        
        <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid #b58d67;">
            <h4 style="color: #888; font-size: 13px; margin: 0;">TOTAL PRODUITS</h4>
            <p style="font-size: 28px; font-weight: 700; margin: 10px 0;">{{ $totalProduits }}</p>
        </div>

        <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid #3498db;">
            <h4 style="color: #888; font-size: 13px; margin: 0;">CATÉGORIES</h4>
            <p style="font-size: 28px; font-weight: 700; margin: 10px 0;">{{ $totalCategories }}</p>
        </div>

        <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid #27ae60;">
            <h4 style="color: #888; font-size: 13px; margin: 0;">VALEUR DU STOCK</h4>
            <p style="font-size: 28px; font-weight: 700; margin: 10px 0; color: #27ae60;">{{ number_format($valeurStock, 2) }} DH</p>
        </div>

        <div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 4px solid #e74c3c;">
            <h4 style="color: #888; font-size: 13px; margin: 0;">PRODUITS EN ALERTE</h4>
            <p style="font-size: 28px; font-weight: 700; margin: 10px 0; color: #e74c3c;">{{ $stockFaible->count() }}</p>
        </div>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); overflow: hidden;">
        <div style="padding: 20px; border-bottom: 1px solid #eee; background: #fdfaf7;">
            <h3 style="margin: 0; font-size: 18px; color: #b58d67;">⚠️ Liste des stocks à surveiller</h3>
        </div>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="text-align: left; background: #f9f9f9; font-size: 14px; color: #666;">
                    <th style="padding: 15px;">Produit</th>
                    <th style="padding: 15px;">Catégorie</th>
                    <th style="padding: 15px;">Stock Restant</th>
                    <th style="padding: 15px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stockFaible as $item)
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 15px; font-weight: 600;">{{ $item->nom }}</td>
                    <td style="padding: 15px;">{{ $item->category->nom ?? 'N/A' }}</td>
                    <td style="padding: 15px;"><span style="color: #e74c3c; font-weight: bold;">{{ $item->stock }}</span></td>
                    <td style="padding: 15px;"><a href="{{ route('products.edit', $item->id) }}" style="color: #3498db; text-decoration: none; font-size: 14px;">Réapprovisionner</a></td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="padding: 30px; text-align: center; color: #aaa;">✅ Tout le stock est suffisant !</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection