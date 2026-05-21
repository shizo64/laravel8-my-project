<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> $this->faker->title(20),
            'name' => $this->faker->name,
            'image' => $this->faker->imageUrl(),
            'description'=>$this->faker->text ,
            'quantity'=> random_int(1,10),
            'category_id' => Category::get()->random()->id,
        ];
    }
}
