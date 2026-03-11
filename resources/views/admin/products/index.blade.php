@extends('layouts.admin') 

@section('content')
<div style="padding: 40px 5%; font-family: 'Poppins', sans-serif;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div>
            <h2 style="font-family: 'Playfair Display', serif; font-size: 32px; margin: 0;">Gestion du Stock</h2>
            <p style="color: #888; margin: 5px 0 0 0;">Tableau de bord de MoroccanBasket</p>
        </div>
        <a href="{{ route('products.create') }}" style="background: #27ae60; color: white; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: 600; box-shadow: 0 4px 10px rgba(39, 174, 96, 0.2); transition: 0.3s;">
            + Ajouter un Produit
        </a>
    </div>

    <div style="background: white; padding: 20px; border-radius: 12px; margin-bottom: 25px; border: 1px solid #eee; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
        <form action="{{ route('products.index') }}" method="GET" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
            
            <div style="flex: 2; min-width: 250px;">
                <input type="text" name="search" placeholder="Rechercher par nom..." value="{{ request('search') }}" 
                       style="width: 100%; padding: 12px 15px; border: 1px solid #eee; border-radius: 8px; font-family: 'Poppins', sans-serif; background: #fdfdfd; outline: none;">
            </div>

            <div style="flex: 1; min-width: 200px;">
                <select name="category_id" style="width: 100%; padding: 12px 15px; border: 1px solid #eee; border-radius: 8px; font-family: 'Poppins', sans-serif; background: white; color: #555; outline: none;">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" style="background: #b58d67; color: white; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; font-weight: 600; transition: 0.3s;">
                    Filtrer
                </button>
                <a href="{{ route('products.index') }}" style="background: #f5f5f5; color: #666; padding: 12px 20px; text-decoration: none; border-radius: 8px; font-size: 14px; display: flex; align-items: center; justify-content: center;">
                    Réinitialiser
                </a>
            </div>
        </form>
    </div>

    <div style="background: white; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #eee;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: #fdfaf7; border-bottom: 2px solid #eee; color: #b58d67; text-transform: uppercase; font-size: 13px; letter-spacing: 1px;">
                    <th style="padding: 20px;">Image</th>
                    <th style="padding: 20px;">Désignation</th>
                    <th style="padding: 20px;">Catégorie</th>
                    <th style="padding: 20px;">Prix</th>
                    <th style="padding: 20px;">État du Stock</th>
                    <th style="padding: 20px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr style="border-bottom: 1px solid #f9f9f9; transition: 0.2s;" onmouseover="this.style.background='#fcfcfc'" onmouseout="this.style.background='white'">
                    <td style="padding: 15px 20px;">
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" style="width: 65px; height: 65px; object-fit: cover; border-radius: 10px; border: 1px solid #eee;">
                        @else
                            <div style="width: 65px; height: 65px; background: #eee; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: #aaa; font-size: 10px;">No Image</div>
                        @endif
                    </td>
                    <td style="padding: 20px;">
                        <span style="font-weight: 600; color: #333; display: block;">{{ $product->nom }}</span>
                        <small style="color: #aaa;">ID: #MB-{{ $product->id }}</small>
                    </td>
                    <td style="padding: 20px; color: #777;">
                        {{ $product->category->nom ?? 'Non classé' }}
                    </td>
                    <td style="padding: 20px; font-weight: bold; color: #1a1a1a;">
                        {{ number_format($product->prix, 2) }} DH
                    </td>
                    <td style="padding: 20px;">
                        @php
                            $isLow = $product->stock <= 5;
                            $bg = $isLow ? '#fdedec' : '#eafaf1';
                            $color = $isLow ? '#e74c3c' : '#27ae60';
                        @endphp
                        <span style="padding: 6px 14px; border-radius: 20px; font-size: 13px; font-weight: 600; background: {{ $bg }}; color: {{ $color }};">
                            {{ $isLow ? '⚠️ Low Stock: ' : '✅ En Stock: ' }} {{ $product->stock }}
                        </span>
                    </td>
                    <td style="padding: 20px;">
                        <div style="display: flex; gap: 15px;">
                            <a href="{{ route('products.edit', $product->id) }}" style="color: #3498db; text-decoration: none; font-size: 14px; font-weight: 600;">Modifier</a>
                            
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                @csrf @method('DELETE')
                                <button type="submit" style="color: #e74c3c; background: none; border: none; cursor: pointer; font-family: 'Poppins', sans-serif; font-size: 14px; font-weight: 600;" onclick="return confirm('Supprimer ce produit ?')">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 50px; color: #888;">
                        Aucun produit trouvé pour "{{ request('search') }}".
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection