<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->text('description');
        $table->decimal('prix', 8, 2); // 8 chiffres au total, 2 après la virgule
        $table->integer('stock')->default(0);
        $table->string('image')->nullable(); // On autorise le vide au début
        
        // LA CLÉ ÉTRANGÈRE : Lie le produit à une catégorie
        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
