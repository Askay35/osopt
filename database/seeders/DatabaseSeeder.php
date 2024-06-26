<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\ProductAttributes;
use Database\Factories\ProductAttributesFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\Category::factory(10)->create();
         \App\Models\Subcategory::factory(50)->create();
        \App\Models\Product::factory(200)->create();
        \App\Models\Order::factory(100)->create();
        ProductAttributes::factory(200)->create();

         //         \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
