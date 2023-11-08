<?php

namespace Database\Factories;

use App\Enums\Status;
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
            'client_id' => fake()->numberBetween(1,100), //Using number between instead of factory to avoid always having an 1:1 relationships
            'seller_id' => fake()->numberBetween(1,100), //Using number between instead of factory to avoid always having an 1:1 relationships
            'sold_at' => fake()->dateTimeBetween('-8 years days', '-1 year'),
            'status' => fake()->randomElements(Status::cases()), //Cases is a native enum function, it return an array with all elements
            'total' => fake()->numberBetween(10000, 50000), //Between 100.00 and 500.00 (field is integer)
        ];
    }
}
