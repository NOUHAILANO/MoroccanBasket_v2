<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoroccanBasket - Artisanat & Cosmétique</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; margin: 0; background: #fafafa; color: #333; }
        nav { display: flex; justify-content: space-between; align-items: center; padding: 20px 5%; background: white; border-bottom: 1px solid #eee; position: sticky; top: 0; z-index: 1000; }
        .logo { font-family: 'Playfair Display', serif; font-size: 24px; color: #1a1a1a; text-decoration: none; letter-spacing: 2px; }
        .nav-links a { text-decoration: none; color: #333; margin-left: 30px; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; font-weight: 600; }
        .cart-badge { background: #b58d67; color: white; padding: 2px 8px; border-radius: 50%; font-size: 11px; vertical-align: middle; margin-left: 5px; }
        footer { background: #1a1a1a; color: white; padding: 40px 5%; text-align: center; margin-top: 60px; }
        .success-msg { background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; text-align: center; max-width: 1100px; margin: 20px auto; }
    </style>
</head>
<body>

    <nav>
        <a href="{{ route('shop.index') }}" class="logo">MOROCCAN BASKET</a>
        <div class="nav-links">
            <a href="{{ route('shop.index') }}">Boutique</a>
            <a href="{{ url('/cart') }}">
                🛒 Panier <span class="cart-badge">0</span>
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
        <p style="font-size: 14px; opacity: 0.7;">&copy; 2026 - Créé par Nouhaila & Afaf (Dev Team)</p>
    </footer>

</body>
</html>
