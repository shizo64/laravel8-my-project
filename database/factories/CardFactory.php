<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id'=> Category::inRandomOrder()->first()->id, // Получаем случайную категорию и ее ID
            'image' => $this->faker->imageUrl(640, 480, 'animals', true), // Генерируем случайное изображение
        ];
    }
}
