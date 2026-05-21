<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['title' => 'Животные', 'description' => 'Карточки с изображениями животных.'],
            ['title' => 'Растения', 'description' => 'Карточки с изображениями растений.'],
            ['title' => 'Города', 'description' => 'Карточки с изображениями городов.'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}
