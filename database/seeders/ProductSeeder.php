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
                'prix' => 200,
                'image' => 'products/argan.jpg',
                'category_id' => $soins->id,
                'stock' => 10,
            ],
            [
                'nom' => 'Moroccan Amlou Spread',
                'description' => 'A delicious blend of toasted almonds, argan oil, and honey.',
                'prix' => 85,
                'image' => 'products/amlou.jpg',
                'category_id' => $soins->id,
                'stock' => 30,
            ],
            [
                'nom' => 'Traditional Sabon Beldi',
                'description' => 'Natural black soap made from olive oil for deep exfoliation.',
                'prix' => 65,
                'image' => 'products/sabon_beldi.jpg',
                'category_id' => $soins->id,
                'stock' => 50,
            ],
            [
                'nom' => 'Rose Water Mist',
                'description' => 'Refreshing and soothing floral water from the Valley of Roses.',
                'prix' => 110,
                'image' => 'products/eau_rose.jpg',
                'category_id' => $soins->id,
                'stock' => 25,
            ],
            [
                'nom' => 'Hammam Kessa Glove',
                'description' => 'Traditional exfoliating glove for a smooth, glowing skin.',
                'prix' => 40,
                'image' => 'products/kessa.jpg',
                'category_id' => $soins->id,
                'stock' => 100,
            ],
            [
                'nom' => 'Akar Fassi Powder',
                'description' => 'Natural pigment made from dried poppy petals and pomegranate bark.',
                'prix' => 90,
                'image' => 'products/akar_fassi.jpg',
                'category_id' => $soins->id,
                'stock' => 20,
            ],

            // --- ARTISANAT ---
            [
                'nom' => 'Traditional Tagine Pot',
                'description' => 'Authentic clay pot for slow-cooking traditional Moroccan dishes.',
                'prix' => 180,
                'image' => 'products/tajine.jpg',
                'category_id' => $artisanat->id,
                'stock' => 5,
            ],
            [
                'nom' => 'Atlas Spices Blend',
                'description' => 'A unique mix of aromatic spices sourced from the Atlas Mountains.',
                'prix' => 95,
                'image' => 'products/epices_atlas.jpg',
                'category_id' => $artisanat->id,
                'stock' => 15,
            ],
            [
                'nom' => 'Decorative Tagine',
                'description' => 'Hand-painted ceramic tagine for serving or decoration.',
                'prix' => 150,
                'image' => 'products/tajine_deco.jpg',
                'category_id' => $artisanat->id,
                'stock' => 8,
            ],
            [
                'nom' => 'Embroidered Tarbouche',
                'description' => 'Classic red Moroccan hat with traditional embroidery.',
                'prix' => 210,
                'image' => 'products/tarbouche.jpg',
                'category_id' => $artisanat->id,
                'stock' => 4,
            ],
            [
                'nom' => 'Zlafa Moroccan Bowl',
                'description' => 'Ceramic bowl with traditional patterns, perfect for Harira soup.',
                'prix' => 130,
                'image' => 'products/zlafa.jpg',
                'category_id' => $artisanat->id,
                'stock' => 12,
            ],
            [
                'nom' => 'Artisanal Teapot Set',
                'description' => 'Complete hand-carved silver teapot set for traditional tea service.',
                'prix' => 380,
                'image' => 'products/service_the.jpg',
                'category_id' => $artisanat->id,
                'stock' => 2,
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
