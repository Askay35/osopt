<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id'=>fake()->numberBetween(Category::first()->id,Category::count()),
            'subcategory_id'=>fake()->numberBetween(Subcategory::first()->id,Subcategory::count()),
            'name' => Str::random(32),
            'price' => fake()->randomFloat(2,.25, 2.0) * 100.0,
            'in_stock' => fake()->numberBetween(0,1)
        ];
    }
}
