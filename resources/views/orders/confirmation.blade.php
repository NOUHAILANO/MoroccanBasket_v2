@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 0 auto; padding: 80px 20px; font-family: 'Playfair Display', serif; text-align: center;">
    
    <div style="background: white; padding: 60px; border-radius: 12px; border: 1px solid #eee; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
        
        <div style="color: #b58d67; font-size: 50px; margin-bottom: 20px;">✓</div>
        
        <h1 style="font-size: 36px; color: #1a1a1a; margin-bottom: 20px; letter-spacing: 1px;">MERCI POUR VOTRE CONFIANCE</h1>
        
        <div style="width: 50px; height: 2px; background: #b58d67; margin: 20px auto;"></div>

        <p style="font-family: 'Poppins', sans-serif; color: #666; font-size: 16px; line-height: 1.6; margin-bottom: 40px;">
            Votre commande a été enregistrée avec succès. <br>
            Elle est en cours de préparation par nos artisans.
        </p>

        <div style="background: #f9f9f9; padding: 25px; border-radius: 8px; display: inline-block; margin-bottom: 40px; border-left: 4px solid #b58d67;">
            <p style="font-family: 'Poppins', sans-serif; margin: 0; font-size: 14px; color: #888; text-transform: uppercase;">Référence de commande</p>
            <p style="font-family: 'Poppins', sans-serif; margin: 5px 0 0 0; font-size: 22px; font-weight: bold; color: #1a1a1a; letter-spacing: 2px;">
                {{ session('ref') }}
            </p>
        </div>

        <div style="display: flex; gap: 15px; justify-content: center;">
            <a href="{{ route('shop.index') }}" 
               style="text-decoration: none; background: #1a1a1a; color: white; padding: 15px 30px; border-radius: 6px; font-family: 'Poppins', sans-serif; font-weight: 500; transition: 0.3s;"
               onmouseover="this.style.background='#b58d67'" onmouseout="this.style.background='#1a1a1a'">
                RETOURNER À LA BOUTIQUE
            </a>
        </div>
    </div>
</div>
@endsection