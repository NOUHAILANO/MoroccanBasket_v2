<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moroccan Basket - Administration</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0; background: #f4f7f6; font-family: 'Poppins', sans-serif;">

    <div style="display: flex; min-height: 100vh;">
        
        <aside style="width: 260px; background: #1a1a1a; color: white; position: fixed; height: 100vh; padding: 30px 20px; box-sizing: border-box;">
            <h2 style="font-family: 'Playfair Display', serif; color: #b58d67; text-align: center; font-size: 20px; letter-spacing: 1px;">MOROCCAN BASKET</h2>
            
            <nav style="margin-top: 50px;">
                <a href="{{ route('admin.dashboard') }}" style="display: block; color: {{ Request::is('admin/dashboard') ? '#b58d67' : 'white' }}; text-decoration: none; padding: 15px; border-radius: 8px; margin-bottom: 10px; background: {{ Request::is('admin/dashboard') ? 'rgba(181, 141, 103, 0.1)' : 'transparent' }}; font-weight: 600;">📊 Dashboard</a>
                
                <a href="{{ route('products.index') }}" style="display: block; color: {{ Request::is('admin/products*') ? '#b58d67' : 'white' }}; text-decoration: none; padding: 15px; border-radius: 8px; margin-bottom: 10px; background: {{ Request::is('admin/products*') ? 'rgba(181, 141, 103, 0.1)' : 'transparent' }};">🧺 Gestion Produits</a>
                
                <a href="#" style="display: block; color: white; text-decoration: none; padding: 15px; border-radius: 8px; opacity: 0.6;">🛍️ Commandes (Afaf)</a>
            </nav>

            <div style="position: absolute; bottom: 30px; left: 20px; right: 20px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
                <a href="{{ route('shop.index') }}" target="_blank" style="color: #888; text-decoration: none; font-size: 13px;">🌐 Voir la boutique</a>
            </div>
        </aside>

        <main style="flex: 1; margin-left: 260px; padding: 40px; box-sizing: border-box;">
            @yield('content')
        </main>

    </div>

</body>
</html>