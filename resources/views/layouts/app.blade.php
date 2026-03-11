<nav style="background: #1a1a1a; padding: 15px 40px; display: flex; align-items: center; justify-content: space-between; font-family: 'Segoe UI', sans-serif;">
    <div class="logo">
        <a href="{{ route('shop.index') }}" style="color: #b58d67; font-weight: bold; font-size: 22px; text-decoration: none; letter-spacing: 1px;">MOROCCAN BASKET</a>
    </div>
    
    <div style="display: flex; gap: 30px;">
        <a href="{{ route('shop.index') }}" style="color: white; text-decoration: none; font-size: 14px; text-transform: uppercase;">Boutique</a>
        
        @auth
            <a href="{{ route('admin.dashboard') }}" style="color: #f1c40f; text-decoration: none; font-size: 14px; text-transform: uppercase; font-weight: bold;">📊 Dashboard</a>
            <a href="{{ route('products.index') }}" style="color: white; text-decoration: none; font-size: 14px; text-transform: uppercase;">📦 Stock</a>
        @endauth
    </div>
</nav>