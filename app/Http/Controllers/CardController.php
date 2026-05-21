<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Card;
use App\Http\Filters\CardFilter;
use App\Models\CardTranslation;

class CardController extends Controller
{
    public function index(Request $request)
    {
    $builder = Card::query();

    $filter = new CardFilter($request->all());
    $filter->apply($builder);
    $cards = $builder->with('translations.language')->get();

        return view('card.index', compact('cards'));
    }

   public function store(Request $request)
    {
        // 1. Валидация (проверяем, что нам прислали данные)
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'word_ru'     => 'required|string|max:255',
            'word_target' => 'required|string|max:255',
        ]);

        // 2. Создаем саму карточку (в таблицу cards)
        // Мы НЕ создаем Place, поэтому ошибка 1364 исчезнет.
        $card = Card::create([
            'category_id' => $request->category_id,
        ]);

        // 3. Сохраняем русский вариант (language_id = 1)
        CardTranslation::create([
            'card_id'     => $card->id,
            'language_id' => 1, 
            'translation' => $request->word_ru,
        ]);

        // 4. Сохраняем иностранный вариант (language_id = 2)
        CardTranslation::create([
            'card_id'       => $card->id,
            'language_id'   => 2,
            'translation'   => $request->word_target,
            'transcription' => $request->transcription, // Транскрипция обычно нужна только здесь
        ]);

        return redirect()->back()->with('success', 'Карточка успешно создана без использования Places!');
    }
}
