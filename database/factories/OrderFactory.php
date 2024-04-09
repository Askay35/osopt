<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        "phone"=> fake()->phoneNumber(),
        "user_id"=>null,
        "payment_type"=>Str::random(10),
        "status_id"=>fake()->numberBetween(DB::table('order_statuses')->first()->id,DB::table('order_statuses')->count()),
        ];
    }
}
