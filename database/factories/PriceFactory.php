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
            'type' => $this->faker->numberBetween(1, 24),
            'price_in' => function (array $attributes) {
                if (isset($attributes['type']) && $attributes['type'] == 24) {
                    return 0;
                }
                return $this->faker->numberBetween(5000000, 9000000);
            },
            'price_out' => function (array $attributes) {
                if (isset($attributes['type']) && $attributes['type'] == 24) {
                    return $this->faker->numberBetween(3000, 4000);
                }
                $priceIn = $attributes['price_in'];
                return $priceIn + $this->faker->numberBetween(100000, 500000);
            },
            'url' => '',
            'published_at' => $this->faker->dateTimeBetween('first day of January this year', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
