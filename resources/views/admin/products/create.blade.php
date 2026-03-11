@extends('layouts.admin')

@section('content')
<div style="max-width: 800px; margin: 50px auto; padding: 30px; background: white; border-radius: 12px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); font-family: 'Poppins', sans-serif;">
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="font-family: 'Playfair Display', serif; color: #1a1a1a; margin: 0;">Nouveau Produit</h2>
        <a href="{{ route('products.index') }}" style="text-decoration: none; color: #888; font-size: 14px;">← Retour</a>
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

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Nom du Produit :</label>
            <input type="text" name="nom" value="{{ old('nom') }}" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; outline: none;" placeholder="Ex: Panier en Osier Tissé">
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 20px;">
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Prix (DH) :</label>
                <input type="number" step="0.01" name="prix" value="{{ old('prix') }}" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
            </div>
            <div style="flex: 1;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Stock :</label>
                <input type="number" name="stock" value="{{ old('stock') }}" required style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px;">
            </div>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Catégorie :</label>
            <select name="category_id" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; background: white;">
                <option value="1" {{ old('category_id') == 1 ? 'selected' : '' }}>Artisanat</option>
                <option value="2" {{ old('category_id') == 2 ? 'selected' : '' }}>Cosmétique</option>
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 8px; font-weight: 600;">Description :</label>
            <textarea name="description" rows="4" style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; outline: none; font-family: inherit;">{{ old('description') }}</textarea>
        </div>

        <div style="margin-bottom: 30px; padding: 20px; border: 2px dashed #ddd; border-radius: 8px; text-align: center; position: relative;">
            <label id="upload-label" style="display: block; margin-bottom: 10px; font-weight: 600; cursor: pointer;">
                📷 Cliquez pour choisir l'image
            </label>
            <input type="file" name="image" id="image-input" accept="image/*" required style="font-size: 14px; color: #888;">
            
            <div id="preview-container" style="margin-top: 15px; display: none;">
                <img id="image-preview" src="#" alt="Aperçu" style="max-width: 200px; border-radius: 8px; border: 1px solid #eee; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            </div>
        </div>

        <div style="display: flex; gap: 15px;">
            <button type="submit" style="flex: 2; background: #1a1a1a; color: white; padding: 15px; border: none; border-radius: 6px; font-weight: bold; cursor: pointer; transition: 0.3s;" 
                    onmouseover="this.style.background='#b58d67'" onmouseout="this.style.background='#1a1a1a'">
                ENREGISTRER LE PRODUIT
            </button>
            <a href="{{ route('products.index') }}" style="flex: 1; text-align: center; text-decoration: none; padding: 15px; border: 1px solid #ddd; border-radius: 6px; color: #333; font-weight: bold; line-height: 1;">
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