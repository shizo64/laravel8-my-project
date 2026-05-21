<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CardTranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = \App\Models\Language::all();

        \App\Models\Card::all()->each(function ($card) use ($languages) {
            $language = $languages->random();
            $translation = \App\Models\CardTranslation::factory()->make([
                'card_id' => $card->id,
                'language_id' => $language->id,
            ]);

            \App\Models\CardTranslation::firstOrCreate(
                [
                    'card_id' => $card->id,
                    'language_id' => $language->id,
                ],
                [
                    'translation' => $translation->translation,
                    'transcription' => $translation->transcription,
                    'audio' => $translation->audio,
                ]
            );
        });
    }
}
