<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\CardTranslation;
use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardTranslationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'card_id' => Card::inRandomOrder()->value('id') ?? 1,
            'language_id' => Language::inRandomOrder()->value('id') ?? 1,
            'translation' => $this->faker->word(),
            'transcription' => $this->faker->word(),
            'audio' => null,
        ];
    }
}