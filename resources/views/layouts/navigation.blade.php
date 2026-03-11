<nav style="background: #1a1a1a; padding: 15px; display: flex; gap: 20px;">
    <a href="{{ route('shop.index') }}" style="color: white; text-decoration: none;">🏠 Boutique</a>

    @auth
        <div style="margin-left: auto; display: flex; gap: 20px;">
            <a href="{{ route('admin.dashboard') }}" style="color: #f1c40f; text-decoration: none;">📊 Dashboard</a>
            <a href="{{ route('products.index') }}" style="color: white; text-decoration: none;">📦 Gérer Produits</a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" style="color: #e74c3c; background: none; border: none; cursor: pointer;">Déconnexion</button>
            </form>
        </div>
    @endauth
</nav>