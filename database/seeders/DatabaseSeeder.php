<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Categories

        $artisanat = Category::firstOrCreate(
            ['nom' => 'Artisanat'],
            ['slug' => Str::slug('Artisanat')]
        );

        $soins = Category::firstOrCreate(
            ['nom' => 'Soins Naturels'],
            ['slug' => Str::slug('Soins Naturels')]
        );
        $this->command->info('Categories created successfully!');

        // 2. Call the Product Seeder
        // This ensures products are created AFTER categories
        $this->call([
            ProductSeeder::class,
        ]);


        // 3. Create a Test Admin (Optional but helpful for Dev B)
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@moroccanbasket.com',
            'role' => 'admin',
            'password' => bcrypt('password'),
        ]);
    }
}
