@extends('layouts.app')

@section('content')
<style>
    /* General container */
    .register-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 40px 20px;
        font-family: 'Playfair Display', serif;
    }

    /* Brand header */
    .brand-header {
        text-align: center;
        margin-bottom: 40px;
    }
    .brand-header h1 {
        font-size: 42px;
        color: #2c3e50;
        margin-bottom: 10px;
        letter-spacing: 2px;
    }
    .brand-header p {
        color: #888;
        font-style: italic;
    }
    .brand-divider {
        width: 80px;
        height: 2px;
        background: #b58d67;
        margin: 20px auto;
    }

    /* Card styling */
    .register-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        border: 1px solid #eee;
        padding: 40px 35px;
        transition: 0.3s;
    }
    .register-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    /* Form group styling */
    .form-group {
        margin-bottom: 20px;
    }
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
        font-family: 'Poppins', sans-serif;
    }
    .form-input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 6px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background: #fefefe;
    }
    .form-input:focus {
        outline: none;
        border-color: #b58d67;
        box-shadow: 0 0 0 3px rgba(181, 141, 103, 0.1);
    }

    /* Button styling */
    .register-btn {
        background: #1a1a1a;
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 6px;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        letter-spacing: 1px;
        width: 100%;
        margin-top: 10px;
    }
    .register-btn:hover {
        background: #b58d67;
        transform: translateY(-2px);
    }

    /* Error messages */
    .error-message {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
        font-family: 'Poppins', sans-serif;
    }
</style>

<div class="register-container">
    <div class="brand-header">
        <h1>MOROCCAN BASKET</h1>
        <p>Rejoignez notre espace artisanal</p>
        <div class="brand-divider"></div>
    </div>

    <div class="register-card">
        <form method="POST" action="{{ route('register') }}">
            @csrf <div class="form-group">
                <label class="form-label">Nom complet</label>
                <input type="text" name="name" class="form-input" value="{{ old('name') }}" required autofocus placeholder="Votre nom">
                @error('name') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Adresse e-mail</label>
                <input type="email" name="email" class="form-input" value="{{ old('email') }}" required placeholder="votre@email.com">
                @error('email') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-input" required placeholder="••••••••">
                @error('password') <div class="error-message">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="form-input" required placeholder="••••••••">
            </div>

            <button type="submit" class="register-btn">S'INSCRIRE</button>
        </form>
    </div>

    <p style="text-align: center; margin-top: 25px; font-family: 'Poppins', sans-serif; font-size: 14px; color: #666;">
        Déjà inscrit ?
        <a href="{{ route('login') }}" style="color: #b58d67; text-decoration: none; font-weight: 600;">
            Se connecter
        </a>
    </p>
</div>
@endsection