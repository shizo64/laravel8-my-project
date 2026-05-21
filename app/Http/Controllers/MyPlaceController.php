<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Models\Card;
use App\Models\CardProgress; // Обязательно добавь этот импорт
use Illuminate\Support\Facades\Auth;

class MyPlaceController extends Controller
{
    public function index()
    {
        $places = Place::all();
        return view('place.index', compact('places'));
    }

    public function store()
    {
        $places = Place::all();
        foreach ($places as $place) {
            dump($place->title);
        }
        dd('end');
    }

    /**
     * Показывает карточки категории, которые нужно выучить или повторить
     */
    public function show(Category $category, Request $request)
{
    $userId = auth()->id();
    
    // По умолчанию показываем только то, что нужно учить (SRS)
    // Но если добавить ?mode=all в URL, покажет всё
    $query = $category->cards();

    if ($request->get('mode') !== 'all') {
        $query->where(function($q) use ($userId) {
            $q->whereDoesntHave('progress', function($sub) use ($userId) {
                $sub->where('user_id', $userId);
            })
            ->orWhereHas('progress', function($sub) use ($userId) {
                $sub->where('user_id', $userId)
                    ->where('next_review', '<=', now());
            });
        });
    }

    $cards = $query->with('translations.language')->get();

    if ($cards->isEmpty() && $request->get('mode') !== 'all') {
        return view('place.finished', compact('category'));
    }

    return view('place.show', compact('category', 'cards'));
}

    /**
     * Обновление прогресса (вызывается из JS кнопок Hard/Good/Easy)
     */
    public function updateProgress(Card $card, Request $request)
    {
        // 1. Валидация рейтинга
        $request->validate([
            'rating' => 'required|integer|between:1,3'
        ]);

        // 2. Поиск или создание записи прогресса для текущего пользователя
        $progress = CardProgress::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'card_id' => $card->id,
            ],
            [
                'interval' => 0,
                'ease_factor' => 2.5,
                'success_count' => 0,
                'next_review' => now(),
            ]
        );

        // 3. Используем метод твоей модели для расчета интервала
        $progress->updateForRating((int)$request->rating);

        // 4. Возвращаем JSON ответ для JS
        return response()->json([
            'status' => 'success',
            'message' => 'Progress updated',
            'next_review' => $progress->next_review->toDateTimeString()
        ]);
    }

    public function edit(Place $place)
    {
        return view('place.edit', compact('place'));
    }

    public function update(Place $place)
    {
        $date = request()->validate([
            'title' => 'string',
            'name' => 'string',
            'image' => 'string',
            'description' => 'string',
            'quantity' => 'integer',
            'category_id' => '',
        ]);
        $place->update($date);
        return redirect()->route('place.show', $place->id);
    }

    public function destroy(Place $place)
    {
        $place->delete();
        return redirect()->route('place.index');
    }

    public function create()
    {
        $categories = Category::all();
        return view('place.create', compact('categories'));
    }

    public function store_place()
    {
        $date = request()->validate([
            'title' => 'string',
            'name' => 'string',
            'image' => 'string',
            'description' => 'string',
            'quantity' => 'integer',
            'category_id' => '',
        ]);
        Place::create($date);
        return redirect()->route('place.index');
    }

    public function delete()
    {
        $place = Place::withTrashed()->find(1);
        $place->restore();
        dd('delete');
    }

    public function firstOrCreate()
    {
        $place = Place::firstOrCreate([
            'title' => 'ABC'
        ], [
            'title' => 'ABC',
            'name' => 'abcsdfsf',
            'description' => 'uadad',
            'quantity' => 6,
        ]);
        dd($place->title);
    }

    public function updateOrCreate()
    {
        $place = Place::updateOrCreate([
            'title' => 'ABCd'
        ], [
            'title' => 'ABC',
            'name' => 'якрутой',
            'description' => 'uadad',
            'quantity' => 6,
        ]);
    }
}