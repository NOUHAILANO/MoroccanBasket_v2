@extends('layouts.app')

@section('content')
<style>
    /* General container – matches shop index */
    .login-container {
        max-width: 500px;
        margin: 0 auto;
        padding: 40px 20px;
        font-family: 'Playfair Display', serif;
    }

    /* Brand header – identical to shop */
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

    /* Login card – mimics product card */
    .login-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        transition: 0.3s;
        border: 1px solid #eee;
        padding: 40px 35px;
    }
    .login-card:hover {
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
        letter-spacing: 0.5px;
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

    /* Checkbox styling */
    .checkbox-group {
        display: flex;
        align-items: center;
        margin: 20px 0;
    }
    .checkbox-group input {
        width: 16px;
        height: 16px;
        margin-right: 10px;
        accent-color: #b58d67;
    }
    .checkbox-group label {
        font-size: 14px;
        color: #666;
        font-family: 'Poppins', sans-serif;
    }

    /* Action row */
    .action-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 30px;
    }
    .forgot-link {
        color: #b58d67;
        text-decoration: none;
        font-size: 13px;
        font-family: 'Poppins', sans-serif;
        transition: color 0.3s;
    }
    .forgot-link:hover {
        color: #8b5a3a;
        text-decoration: underline;
    }

    /* Button – matches "DÉCOUVRIR" button */
    .login-btn {
        background: #1a1a1a;
        color: white;
        border: none;
        padding: 12px 28px;
        border-radius: 6px;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s ease;
        letter-spacing: 1px;
        display: inline-block;
        text-decoration: none;
    }
    .login-btn:hover {
        background: #b58d67;
        transform: translateY(-2px);
    }

    /* Session status message */
    .session-status {
        background: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        text-align: center;
        border: 1px solid #c3e6cb;
    }

    /* Error messages */
    .error-message {
        color: #e74c3c;
        font-size: 12px;
        margin-top: 5px;
        font-family: 'Poppins', sans-serif;
    }

    @media (max-width: 560px) {
        .login-card {
            padding: 30px 20px;
        }
        .action-row {
            flex-direction: column;
            gap: 15px;
        }
        .login-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="login-container">
    <div class="brand-header">
        <h1>MOROCCAN BASKET</h1>
        <p>Connexion à votre espace artisanal</p>
        <div class="brand-divider"></div>
    </div>

    <div class="login-card">
        <!-- Session Status -->
        @if (session('status'))
            <div class="session-status">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <label for="email" class="form-label">Adresse e-mail</label>
                <input id="email" 
                       type="email" 
                       name="email" 
                       class="form-input" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       autocomplete="username"
                       placeholder="votre@email.com">
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <input id="password" 
                       type="password" 
                       name="password" 
                       class="form-input" 
                       required 
                       autocomplete="current-password"
                       placeholder="••••••••">
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="checkbox-group">
                <input id="remember_me" type="checkbox" name="remember">
                <label for="remember_me">Se souvenir de moi</label>
            </div>

            <!-- Buttons and Links -->
            <div class="action-row">
                @if (Route::has('password.request'))
                    <a class="forgot-link" href="{{ route('password.request') }}">
                        Mot de passe oublié ?
                    </a>
                @endif

                <button type="submit" class="login-btn">
                    SE CONNECTER
                </button>
            </div>
        </form>
    </div>

    <!-- Registration link (optional) -->
    <p style="text-align: center; margin-top: 20px; font-family: 'Poppins', sans-serif; font-size: 14px; color: #666;">
        Pas encore de compte ?
        <a href="{{ route('register') }}" style="color: #b58d67; text-decoration: none; font-weight: 500;">
            Créer un compte
        </a>
    </p>
</div>
@endsection