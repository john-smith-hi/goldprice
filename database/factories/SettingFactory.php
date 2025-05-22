<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'type_value' => $this->faker->randomElement(['string', 'int', 'bool']),
            'value' => $this->faker->word(),
            'note' => $this->faker->sentence(),
        ];
    }
}
