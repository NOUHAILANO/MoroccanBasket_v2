<div class="container" style="max-width: 600px; margin: 20px auto; font-family: sans-serif;">
    <h2>Ajouter un Produit - Moroccan Basket</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="margin-bottom: 15px;">
            <label style="display: block;">Nom du produit</label>
            <input type="text" name="nom" value="{{ old('nom') }}" required style="width: 100%; padding: 8px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block;">Catégorie</label>
            <select name="category_id" style="width: 100%; padding: 8px;">
                <option value="">-- Sélectionner --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block;">Description</label>
            <textarea name="description" style="width: 100%; padding: 8px; height: 100px;">{{ old('description') }}</textarea>
        </div>

        <div style="display: flex; gap: 10px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label style="display: block;">Prix (DH)</label>
                <input type="number" step="0.01" name="prix" value="{{ old('prix') }}" style="width: 100%; padding: 8px;">
            </div>
            <div style="flex: 1;">
                <label style="display: block;">Stock</label>
                <input type="number" name="stock" value="{{ old('stock') }}" style="width: 100%; padding: 8px;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block;">Image du produit</label>
            <input type="file" name="image" style="width: 100%;">
        </div>

        <button type="submit" style="background: #2c3e50; color: white; padding: 10px 20px; border: none; cursor: pointer; width: 100%;">
            Enregistrer le produit
        </button>
    </form>
</div>