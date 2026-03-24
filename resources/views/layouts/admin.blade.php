<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moroccan Basket - Administration</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body style="margin: 0; padding: 0; background: #f4f7f6; font-family: 'Poppins', sans-serif;">

    <div style="display: flex; min-height: 100vh;">
        
        <aside style="width: 260px; background: #1a1a1a; color: white; position: fixed; height: 100vh; padding: 30px 20px; box-sizing: border-box; z-index: 1000;">
            <h2 style="font-family: 'Playfair Display', serif; color: #b58d67; text-align: center; font-size: 20px; letter-spacing: 1px;">MOROCCAN BASKET</h2>
            
            <nav style="margin-top: 50px;">
                <a href="{{ route('admin.dashboard') }}" 
                   style="display: block; text-decoration: none; padding: 15px; border-radius: 8px; margin-bottom: 10px; font-weight: 600; 
                          transition: 0.3s;
                          color: {{ request()->routeIs('admin.dashboard') ? '#b58d67' : 'white' }}; 
                          background: {{ request()->routeIs('admin.dashboard') ? 'rgba(181, 141, 103, 0.1)' : 'transparent' }};">
                    📊 Dashboard
                </a>
                
                <a href="{{ route('products.index') }}" 
                   style="display: block; text-decoration: none; padding: 15px; border-radius: 8px; margin-bottom: 10px;
                          transition: 0.3s;
                          color: {{ request()->is('admin/products*') ? '#b58d67' : 'white' }}; 
                          background: {{ request()->is('admin/products*') ? 'rgba(181, 141, 103, 0.1)' : 'transparent' }};">
                    🧺 Gestion Produits
                </a>

                <a href="{{ route('admin.orders.index') }}" 
                   style="display: block; text-decoration: none; padding: 15px; border-radius: 8px; margin-bottom: 10px;
                          transition: 0.3s;
                          color: {{ request()->is('admin/orders*') ? '#b58d67' : 'white' }}; 
                          background: {{ request()->is('admin/orders*') ? 'rgba(181, 141, 103, 0.1)' : 'transparent' }};">
                    🛍️ Commandes 
                </a>
            </nav>

            <div style="position: absolute; bottom: 30px; left: 20px; right: 20px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px;">
                <a href="{{ route('shop.index') }}" target="_blank" style="display: block; color: #888; text-decoration: none; font-size: 13px; margin-bottom: 10px; transition: 0.3s;" onmouseover="this.style.color='#b58d67'" onmouseout="this.style.color='#888'">
                    🌐 Voir la boutique
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" style="background: none; border: none; color: #ff5f5f; font-size: 13px; cursor: pointer; padding: 0; font-family: 'Poppins', sans-serif;">
                        🚪 Déconnexion
                    </button>
                </form>
            </div>
        </aside>

        <main style="flex: 1; margin-left: 260px; padding: 40px; box-sizing: border-box;">
            @if(session('success'))
                <div style="background: #dcfce7; color: #166534; padding: 15px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #bbf7d0;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div style="background: #fee2e2; color: #991b1b; padding: 15px; border-radius: 8px; margin-bottom: 30px; border: 1px solid #fecaca;">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </main>

    </div>

</body>
</html>