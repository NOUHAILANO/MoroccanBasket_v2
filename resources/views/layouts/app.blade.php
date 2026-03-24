<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoroccanBasket - Artisanat & Cosmétique</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: #fafafa;
            color: #333;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            background: white;
            border-bottom: 1px solid #eee;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: #1a1a1a;
            text-decoration: none;
            letter-spacing: 2px;
        }

        .nav-links a {
            text-decoration: none;
            color: #333;
            margin-left: 30px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .cart-badge {
            background: #b58d67;
            color: white;
            padding: 2px 8px;
            border-radius: 50%;
            font-size: 11px;
            vertical-align: middle;
            margin-left: 5px;
        }

        footer {
            background: #1a1a1a;
            color: white;
            padding: 40px 5%;
            text-align: center;
            margin-top: 60px;
        }

        .success-msg {
            background: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            max-width: 1100px;
            margin: 20px auto;
        }

        .pagination .page-link {
            color: #1a1a1a;
            border: none;
            font-family: 'Poppins', sans-serif;
        }

        .pagination .page-item.active .page-link {
            background-color: #b58d67 !important;
            border-color: #b58d67 !important;
            color: white;
        }
    </style>
</head>

<body>

    <nav style="display: flex; justify-content: space-between; align-items: center; padding: 20px 40px; background: #fff; border-bottom: 1px solid #eee; font-family: 'Playfair Display', serif;">

        <a href="{{ route('shop.index') }}" style="font-size: 24px; font-weight: bold; color: #1a1a1a; text-decoration: none; letter-spacing: 2px;">
            MOROCCAN BASKET
        </a>

        <div style="display: flex; align-items: center; gap: 30px; font-family: 'Poppins', sans-serif; text-transform: uppercase; font-size: 13px; font-weight: 600;">

            <div style="display: flex; gap: 20px; align-items: center;">
                @if (Route::has('login'))
                @auth

                @if(Auth::user()->role === 'admin')
                <a href="{{ url('/admin/dashboard') }}" style="text-decoration: none; color: #333; margin-right: 15px;">Dashboard</a>

                @else
                <a href="{{ route('profile.edit') }}" style="text-decoration: none; color: #333; margin-right: 15px;">Mon Profil</a>
                @endif

                <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0;">
                    @csrf
                    <button type="submit" style="color: #e3342f; background: none; border: none; cursor: pointer; text-transform: uppercase; font-weight: 600; font-size: 13px;">
                        {{ __('Se déconnecter') }}
                    </button>
                </form>

                @else
                <a href="{{ route('login') }}" style="text-decoration: none; color: #333;">SE CONNECTER</a>
                @if (Route::has('register'))
                <a href="{{ route('register') }}" style="text-decoration: none; color: #333; margin-left: 10px;">S'INSCRIRE</a>
                @endif
                @endauth
                @endif
            </div>

            <a href="{{ route('shop.index') }}" style="text-decoration: none; color: #333;">BOUTIQUE</a>

            <a href="{{ url('/cart') }}" style="text-decoration: none; color: #333; display: flex; align-items: center;">
                🛒 PANIER
                <span style="background: #b58d67; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 11px; margin-left: 8px;">
                    {{ count(session('cart', [])) }}
                </span>
            </a>
        </div>
    </nav>

    @if(session('success'))
    <div class="success-msg">{{ session('success') }}</div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer>
        <p style="font-family: 'Playfair Display', serif; font-size: 20px; margin-bottom: 10px;">MOROCCAN BASKET</p>
        <p style="font-size: 14px; opacity: 0.7;">&copy; 2026 - MOROCCAN BASKET</p>
    </footer>

</body>

</html>