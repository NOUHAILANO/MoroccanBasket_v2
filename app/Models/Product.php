<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Autoriser l'insertion de masse pour ces colonnes
    protected $fillable = ['nom', 'description', 'price', 'stock', 'image', 'category_id'];

    // Un produit appartient à une seule catégorie
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
