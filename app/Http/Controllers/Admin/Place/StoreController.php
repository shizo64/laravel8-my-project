<?php

namespace App\Http\Controllers\Admin\Place;

use App\Models\Card;
use App\Models\CardTranslation;
use App\Http\Controllers\Controller;
use App\Http\Requests\Place\StoreRequest;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $card = Card::create([
            'category_id' => $request->category_id,
            'image' => null,
        ]);

        CardTranslation::create([
            'card_id'     => $card->id,
            'language_id' => 1,
            'translation' => $request->word_ru, // ← было word, исправлено
        ]);

        CardTranslation::create([
            'card_id'       => $card->id,
            'language_id'   => 2,
            'translation'   => $request->word_target,
            'transcription' => $request->transcription,
        ]);

        return redirect()->back()->with('success', 'Карточка добавлена!');
    }
}





