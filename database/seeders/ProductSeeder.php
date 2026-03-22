<?php

namespace Database\Seeders;



use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Get Category IDs to link products
        $artisanat = \App\Models\Category::where('nom', 'Artisanat')->first();
        $soins = \App\Models\Category::where('nom', 'Soins Naturels')->first();
        $table= \App\Models\Category::where('nom', 'Art de la Table')->first();


        // Check if categories exist to avoid errors
        if (!$artisanat || !$soins) {
            $this->command->error('Please seed Categories first! (Artisanat and Soins Naturels needed)');
            return;
        }

        // --- PRODUCT DATA ARRAY ---
        $products = [
            // --- SOINS NATURELS ---
            [
                'nom' => 'Organic Argan Oil',
                'description' => 'Pure, cold-pressed oil for hair and skin hydration.',
                'price' => 200,
                'image' => 'products/argan.jpg',
                'category_id' => $soins->id,
                'stock' => 10,
            ],
            [
                'nom' => 'Moroccan Amlou Spread',
                'description' => 'A delicious blend of toasted almonds, argan oil, and honey.',
                'price' => 85,
                'image' => 'products/amlou.jpg',
                'category_id' => $soins->id,
                'stock' => 30,
            ],
            [
                'nom' => 'Traditional Sabon Beldi',
                'description' => 'Natural black soap made from olive oil for deep exfoliation.',
                'price' => 65,
                'image' => 'products/sabon_beldi.jpg',
                'category_id' => $soins->id,
                'stock' => 50,
            ],
            [
                'nom' => 'Rose Water Mist',
                'description' => 'Refreshing and soothing floral water from the Valley of Roses.',
                'price' => 110,
                'image' => 'products/eau_rose.jpg',
                'category_id' => $soins->id,
                'stock' => 25,
            ],
            [
                'nom' => 'Hammam Kessa Glove',
                'description' => 'Traditional exfoliating glove for a smooth, glowing skin.',
                'price' => 40,
                'image' => 'products/kessa.jpg',
                'category_id' => $soins->id,
                'stock' => 100,
            ],
            [
                'nom' => 'Akar Fassi Powder',
                'description' => 'Natural pigment made from dried poppy petals and pomegranate bark.',
                'price' => 90,
                'image' => 'products/akar_fassi.jpg',
                'category_id' => $soins->id,
                'stock' => 20,
            ],

            // --- ARTISANAT ---
            [
                'nom' => 'Traditional Tagine Pot',
                'description' => 'Authentic clay pot for slow-cooking traditional Moroccan dishes.',
                'price' => 180,
                'image' => 'products/tajine.jpg',
                'category_id' => $artisanat->id,
                'stock' => 5,
            ],
            [
                'nom' => 'Atlas Spices Blend',
                'description' => 'A unique mix of aromatic spices sourced from the Atlas Mountains.',
                'price' => 95,
                'image' => 'products/epices_atlas.jpg',
                'category_id' => $artisanat->id,
                'stock' => 15,
            ],
            [
                'nom' => 'Decorative Tagine',
                'description' => 'Hand-painted ceramic tagine for serving or decoration.',
                'price' => 150,
                'image' => 'products/tajine_deco.jpg',
                'category_id' => $artisanat->id,
                'stock' => 8,
            ],
            [
                'nom' => 'Embroidered Tarbouche',
                'description' => 'Classic red Moroccan hat with traditional embroidery.',
                'price' => 210,
                'image' => 'products/tarbouche.jpg',
                'category_id' => $artisanat->id,
                'stock' => 4,
            ],
            [
                'nom' => 'Zlafa Moroccan Bowl',
                'description' => 'Ceramic bowl with traditional patterns, perfect for Harira soup.',
                'price' => 130,
                'image' => 'products/zlafa.jpg',
                'category_id' => $artisanat->id,
                'stock' => 12,
            ],
            [
                'nom' => 'Artisanal Teapot Set',
                'description' => 'Complete hand-carved silver teapot set for traditional tea service.',
                'price' => 380,
                'image' => 'products/service_the.jpg',
                'category_id' => $artisanat->id,
                'stock' => 2,
            ],
            // --- Nouveaux produits (Soins & Artisanat additionnels) ---
            [
                'nom' => 'Ghassoul Clay Mask',
                'description' => 'Traditional Atlas mountain clay for hair and body purification.',
                'price' => 75,
                'image' => 'https://images.unsplash.com/photo-1596755389378-c31d21fd1273?q=80&w=800',
                'category_id' => $soins->id,
                'stock' => 40,
            ],
            [
                'nom' => 'Leather Pouf Tan',
                'description' => 'Hand-stitched genuine leather pouf from the tanneries of Fez.',
                'price' => 450,
                'image' => 'https://images.unsplash.com/photo-1505693314120-0d443867891c?q=80&w=800',
                'category_id' => $artisanat->id,
                'stock' => 3,
            ],

            // --- ART DE LA TABLE (Nouvelle Catégorie) ---
            [
                'nom' => 'Beldi Glass Set',
                'description' => 'Set of 6 hand-blown recycled glasses with a signature blue tint.',
                'price' => 120,
                'image' => 'https://images.unsplash.com/photo-1512411513543-16f500057404?q=80&w=800',
                'category_id' => $table->id,
                'stock' => 15,
            ],
            [
                'nom' => 'Woven Bread Basket',
                'description' => 'Hand-woven palm leaf basket for serving traditional bread.',
                'price' => 55,
                'image' => 'https://images.unsplash.com/photo-1590650153855-d9e808231d41?q=80&w=800',
                'category_id' => $table->id,
                'stock' => 20,
            ],
            [
                'nom' => 'Hand-Carved Wooden Spoon',
                'description' => 'Lemon wood spoon, perfect for stirring honey or tagines.',
                'price' => 30,
                'image' => 'https://images.unsplash.com/photo-1584346133934-a3afd2a33c4c?q=80&w=800',
                'category_id' => $table->id,
                'stock' => 50,
            ],
            [
                'nom' => 'Engraved Brass Tray',
                'description' => 'Luxurious polished brass tray for a royal tea ceremony.',
                'price' => 290,
                'image' => 'https://images.unsplash.com/photo-1578318817290-27694f8396c0?q=80&w=800',
                'category_id' => $table->id,
                'stock' => 6,
            ],
        ];

        // --- SEEDING LOOP ---
        foreach ($products as $productData) {
            // Check if product already exists to avoid duplicates when re-running
            Product::firstOrCreate(
                ['nom' => $productData['nom']],
                $productData
            );
        }

        $this->command->info('Products from image successfully seeded!');
    }
}
