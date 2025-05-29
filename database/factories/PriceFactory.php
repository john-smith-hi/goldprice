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
            'price_in' => $this->faker->numberBetween(5000000, 9000000),
            // Lấy giá trị price_out lớn hơn price_in từ 100-500
            'price_out' => function (array $attributes) {
                $priceIn = $attributes['price_in'];
                return $priceIn + $this->faker->numberBetween(100000, 500000);
            },
            'type' => $this->faker->numberBetween(1, 20),
            'url' => '',
            'published_at' => $this->faker->dateTimeBetween('first day of January this year', 'now')->format('Y-m-d H:i:s'),
        ];
    }
}
