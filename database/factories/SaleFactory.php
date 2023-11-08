<?php

namespace Database\Factories;

use App\Enums\Status;
use App\Models\Client;
use App\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'seller_id' => Seller::factory(),
            'sold_at' => fake()->dateTimeBetween('-8 years days', '-1 year'),
            'status' => fake()->randomElement(Status::cases()), //Cases is a native enum function, it return an array with all elements
            'total' => fake()->numberBetween(10000, 50000), //Between 100.00 and 500.00 (field is integer)
        ];
    }
}
