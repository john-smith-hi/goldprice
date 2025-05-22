<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */

class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => $this->faker->numberBetween(500000, 10000000),
            'type' => $this->faker->numberBetween(1, 10),
            'url' => $this->faker->url(),
            'published_at' => $this->faker->optional()->dateTimeThisYear(),
        ];
    }
}
