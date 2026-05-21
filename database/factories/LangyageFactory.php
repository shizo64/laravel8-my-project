<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LangyageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->languageCode(), // Генерируем уникальный код языка
            'name' => $this->faker->languageCode(), // Генерируем название языка
        ];
    }
}
