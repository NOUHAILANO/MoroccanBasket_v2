@extends('layouts.admin')

@section('content')
<div style="max-width: 800px; margin: 50px auto; padding: 30px; background: white; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); font-family: 'Poppins', sans-serif;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="font-family: 'Playfair Display', serif; color: #1a1a1a; margin: 0;">Modifier le Produit</h2>
        <a href="{{ route('products.index') }}" style="text-decoration: none; color: #888; font-size: 14px;">← Retour à la liste</a>
    </div>

    @if ($errors->any())
        <div style="background: #fdedec; color: #e74c3c; padding: 15px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
            <ul style="margin: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Nom du Produit :</label>
            <input type="text" name="nom" value="{{ old('nom', $product->nom) }}" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; outline: none;">
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Prix (DH) :</label>
                <input type="number" step="0.01" name="prix" value="{{ old('prix', $product->prix) }}" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
            </div>
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Stock :</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Catégorie :</label>
            <select name="category_id" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; background: white;">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Description :</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; outline: none; font-family: inherit;">{{ old('description', $product->description) }}</textarea>
        </div>

        <div style="margin-bottom: 30px; padding: 20px; border: 1px solid #eee; border-radius: 8px; background: #fafafa; text-align: center;">
            <div style="margin-bottom: 15px;">
                <label style="display: block; margin-bottom: 10px; font-weight: 600;">Image actuelle :</label>
                <img src="{{ asset('storage/' . $product->image) }}" style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px; border: 1px solid #ddd;">
            </div>
            
            <label style="display: block; margin-bottom: 10px; font-weight: 600; cursor: pointer; color: #b58d67;">
                📷 Changer l'image (Optionnel)
            </label>
            <input type="file" name="image" id="image-input" accept="image/*" style="font-size: 14px; color: #888;">
            
            <div id="preview-container" style="margin-top: 15px; display: none;">
                <p style="font-size: 12px; color: #888;">Nouvel aperçu :</p>
                <img id="image-preview" src="#" style="max-width: 150px; border-radius: 8px; border: 1px solid #b58d67;">
            </div>
        </div>

        <div style="display: flex; gap: 15px;">
            <button type="submit" style="flex: 2; background: #1a1a1a; color: white; padding: 15px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.3s;" 
                    onmouseover="this.style.background='#b58d67'" onmouseout="this.style.background='#1a1a1a'">
                ENREGISTRER LES MODIFICATIONS
            </button>
            <a href="{{ route('products.index') }}" style="flex: 1; text-align: center; text-decoration: none; padding: 15px; border: 1px solid #ddd; border-radius: 6px; color: #333; font-weight: bold; display: flex; align-items: center; justify-content: center;">
                ANNULER
            </a>
        </div>
    </form>
</div>

<script>
    const imageInput = document.getElementById('image-input');
    const previewContainer = document.getElementById('preview-container');
    const imagePreview = document.getElementById('image-preview');

    imageInput.onchange = evt => {
        const [file] = imageInput.files;
        if (file) {
            imagePreview.src = URL.createObjectURL(file);
            previewContainer.style.display = 'block';
        }
    }
</script>
@endsection