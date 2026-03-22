@extends('layouts.app')

@section('content')

<style>
    /* Polices et variables */
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap');

    .profile-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        border: 1px solid #eee;
        padding: 40px;
        margin-bottom: 30px;
        transition: 0.3s;
    }

    .profile-card:hover {
        border-color: #b58d67;
    }

    .section-title {
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        font-weight: 600;
        color: #b58d67;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }

    /* Style pour les boutons à l'intérieur des partials */
    /* Note: On force un peu le style pour écraser les classes Breeze si besoin */
    .profile-card button {
        background: #1a1a1a !important;
        border-radius: 6px !important;
        font-family: 'Poppins', sans-serif !important;
        transition: 0.3s !important;
        border: none !important;
        color: white;
    }

    .profile-card button:hover {
        background: #b58d67 !important;
    }

    .danger-zone {
        border-left: 4px solid #e3342f;
    }
</style>

<div style="max-width: 900px; margin: 0 auto; padding: 40px 20px; font-family: 'Playfair Display', serif;">

    <div style="text-align: center; margin-bottom: 60px;">
        <h1 style="font-size: 36px; color: #2c3e50; margin-bottom: 10px; letter-spacing: 2px; text-transform: uppercase;">
            {{ __('Mon Compte') }}
        </h1>
        <p style="color: #888; font-style: italic;">Gérez vos informations personnelles et votre sécurité</p>
        <div style="width: 80px; height: 2px; background: #b58d67; margin: 20px auto;"></div>
    </div>

    <div class="profile-container">
        
        <div class="profile-card">
            <h3 class="section-title">Informations Personnelles</h3>
            <div style="max-width: 100%;">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="profile-card">
            <h3 class="section-title">Sécurité du compte</h3>
            <div style="max-width: 100%;">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="profile-card danger-zone">
            <h3 class="section-title" style="color: #e3342f;">Zone de danger</h3>
            <p style="font-family: 'Poppins', sans-serif; font-size: 13px; color: #666; margin-bottom: 20px;">
                Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées.
            </p>
            <div style="max-width: 100%;">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>
</div>

@endsection