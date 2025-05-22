<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class AccessLogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'device' => $this->faker->randomElement(['Desktop', 'Mobile', 'Tablet', null]),
            'resolution' => $this->faker->randomElement(['1920x1080', '1366x768', '1440x900', null]),
            'language' => $this->faker->randomElement(['en', 'vi', 'fr', null]),
            'url' => $this->faker->url(),
            'accessed_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}