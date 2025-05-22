<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AutoBotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'url' => $this->faker->url(),
            'request' => $this->faker->word(),
            'status_response' => $this->faker->randomElement(['404', '200', '403', '500', '302']),
            'response' => $this->faker->text(200),
        ];
    }
}
