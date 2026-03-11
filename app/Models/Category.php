<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str; // Darouri t-zidi had l-import!

class Category extends Model
{
    protected $fillable = ['nom', 'slug'];

    // Hadi hiya li ghadi t-hnnik men mouchkil l-slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->nom);
            }
        });
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}