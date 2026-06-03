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

   // ====== Admin index for cards ======
   public function adminIndex()
   {
       $cards = Card::with('translations.language', 'category')->paginate(20);
       return view('admin.card.index', compact('cards'));
   }

   public function create()
   {
       $categories = \App\Models\Category::all();
       return view('admin.card.create', compact('categories'));
   }

   public function edit(Card $card)
   {
       $card->load('translations.language');
       $categories = \App\Models\Category::all();
       return view('admin.card.edit', compact('card', 'categories'));
   }

   public function update(Request $request, Card $card)
   {
       $data = $request->validate([
           'category_id' => 'required|exists:categories,id',
           'word_ru' => 'nullable|string|max:255',
           'word_target' => 'nullable|string|max:255',
           'transcription' => 'nullable|string|max:255',
           'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
       ]);

       $imageName = $card->image;
       if ($request->hasFile('image')) {
           $file = $request->file('image');
           $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
           $file->move(public_path('images/cards'), $imageName);
       }

       $card->update(['category_id' => $data['category_id'], 'image' => $imageName]);

       // update or create translations (language_id = 1 -> ru, =2 -> target)
       if (!empty($data['word_ru'])) {
           \App\Models\CardTranslation::updateOrCreate(
               ['card_id' => $card->id, 'language_id' => 1],
               ['translation' => $data['word_ru']]
           );
       }

       if (!empty($data['word_target'])) {
           \App\Models\CardTranslation::updateOrCreate(
               ['card_id' => $card->id, 'language_id' => 2],
               ['translation' => $data['word_target'], 'transcription' => $data['transcription'] ?? null]
           );
       }

       return redirect()->route('admin.card.index')->with('success', 'Card updated');
   }

   public function destroy(Card $card)
   {
       $card->delete();
       return redirect()->route('admin.card.index')->with('success', 'Card deleted');
   }

   public function store(Request $request)
    {
        // 1. Валидация (проверяем, что нам прислали данные)
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'word_ru'     => 'required|string|max:255',
            'word_target' => 'required|string|max:255',
            'transcription'=> 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/cards'), $imageName);
        }

        // 2. Создаем саму карточку (в таблицу cards)
        // Мы НЕ создаем Place, поэтому ошибка 1364 исчезнет.
        $card = Card::create([
            'category_id' => $data['category_id'],
            'image' => $imageName,
        ]);

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
