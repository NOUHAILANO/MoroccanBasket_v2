@extends('layouts.app')

@section('content')
<div style="max-width: 1000px; margin: 50px auto; padding: 20px; font-family: 'Poppins', sans-serif;">
    <h1 style="font-family: 'Playfair Display', serif; text-align: center; margin-bottom: 40px; color: #2c3e50;">Votre Panier</h1>

    <div style="background: white; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #fdfaf7; text-align: left; color: #888; text-transform: uppercase; font-size: 12px; letter-spacing: 1px;">
                    <th style="padding: 20px;">Produit</th>
                    <th style="padding: 20px;">Prix</th>
                    <th style="padding: 20px;">Quantité</th>
                    <th style="padding: 20px;">Total</th>
                    <th style="padding: 20px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 20px; display: flex; align-items: center; gap: 15px;">
                        <div style="width: 70px; height: 70px; background: #eee; border-radius: 8px; overflow: hidden;">
                            <img src="https://via.placeholder.com/70" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div>
                            <p style="margin: 0; font-weight: bold; color: #333;">Produit de Test</p>
                            <small style="color: #b58d67;">Cosmétique</small>
                        </div>
                    </td>
                    <td style="padding: 20px;">120.00 DH</td>
                    <td style="padding: 20px;">
                        <input type="number" value="1" style="width: 50px; padding: 5px; border: 1px solid #ddd; border-radius: 4px;">
                    </td>
                    <td style="padding: 20px; font-weight: bold;">120.00 DH</td>
                    <td style="padding: 20px;">
                        <button style="background: none; border: none; color: #e74c3c; cursor: pointer; font-size: 18px;">&times;</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px; display: flex; justify-content: flex-end;">
        <div style="width: 300px; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <span>Sous-total:</span>
                <span style="font-weight: bold;">120.00 DH</span>
            </div>
            <div style="display: flex; justify-content: space-between; margin-bottom: 25px; border-top: 1px solid #eee; padding-top: 15px;">
                <span style="font-size: 18px; font-weight: bold;">Total:</span>
                <span style="font-size: 18px; font-weight: bold; color: #b58d67;">120.00 DH</span>
            </div>
            
            <a href="#" style="display: block; text-align: center; background: #1a1a1a; color: white; text-decoration: none; padding: 15px; border-radius: 8px; font-weight: bold; transition: 0.3s;"
               onmouseover="this.style.background='#b58d67'" onmouseout="this.style.background='#1a1a1a'">
                PASSER À LA CAISSE
            </a>
            
            <a href="{{ route('shop.index') }}" style="display: block; text-align: center; margin-top: 15px; color: #888; text-decoration: none; font-size: 14px;">
                Continuer mes achats
            </a>
        </div>
    </div>
</div>
@endsection