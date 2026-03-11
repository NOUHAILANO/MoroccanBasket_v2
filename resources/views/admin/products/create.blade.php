<div style="padding: 40px; max-width: 800px; margin: auto; font-family: sans-serif;">
    <h2 style="border-bottom: 2px solid #b58d67; padding-bottom: 10px;">Ajouter un Nouveau Panier</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" style="margin-top: 20px;">
        @csrf
        <div style="margin-bottom: 15px;">
            <label>Nom du Panier :</label><br>
            <input type="text" name="nom" required style="width: 100%; padding: 8px; border: 1px solid #ccc;">
        </div>

        <div style="margin-bottom: 15px;">
            <label>Description :</label><br>
            <textarea name="description" required style="width: 100%; padding: 8px; border: 1px solid #ccc; height: 100px;"></textarea>
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 15px;">
            <div style="flex: 1;">
                <label>Prix (DH) :</label>
                <input type="number" name="prix" step="0.01" required style="width: 100%; padding: 8px; border: 1px solid #ccc;">
            </div>
            <div style="flex: 1;">
                <label>Stock :</label>
                <input type="number" name="stock" required style="width: 100%; padding: 8px; border: 1px solid #ccc;">
            </div>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Catégorie :</label>
            <select name="category_id" required style="width: 100%; padding: 8px; border: 1px solid #ccc;">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label>Image du Panier :</label><br>
            <input type="file" name="image" required style="margin-top: 5px;">
        </div>

        <button type="submit" style="background: #b58d67; color: white; padding: 12px 30px; border: none; cursor: pointer; border-radius: 5px;">
            Enregistrer le Produit
        </button>
    </form>
</div>