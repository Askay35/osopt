<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

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
        "payment_type_id"=>fake()->numberBetween(DB::table('payment_types')->first()->id,DB::table('payment_types')->count()),
        "status_id"=>fake()->numberBetween(DB::table('order_statuses')->first()->id,DB::table('order_statuses')->count()),
        ];
    }
}
