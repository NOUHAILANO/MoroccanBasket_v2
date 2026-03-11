<form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <label>Nom du produit</label>
    <input type="text" name="nom" required>

    <label>Catégorie</label>
    <select name="category_id">
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->nom }}</option>
        @endforeach
    </select>

    <label>Description</label>
    <textarea name="description"></textarea>

    <label>Prix</label>
    <input type="number" step="0.01" name="prix">

    <label>Stock</label>
    <input type="number" name="stock">

    <label>Image</label>
    <input type="file" name="image">

    <button type="submit">Ajouter le produit</button>
</form>