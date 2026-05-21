<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\CardProgress;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;

class CategoriesController extends Controller
{
    // ====== Главная страница со всеми категориями ======
    public function index()
    {
        $categories = Category::paginate(20); // постраничный список категорий
        return view('place.categories', compact('categories'));
    }

    // ====== Отправка данных (пример) ======
    public function store()
    {
        $categories = Category::all();
        foreach ($categories as $category) {
            dump($category->title); // выводим названия категорий
        }
        dd('end');
    }

    // ====== Страница конкретной категории с карточками ======
    public function show(Request $request, Category $category)
    {
    $cards = $category->cards()
    ->with([
        'translations.language',
        'progress' => function($q) {        // ← используем progress (hasMany)
            $q->where('user_id', auth()->id() ?? 0);
        }
    ])
    ->when($request->query('mode') === 'review', function ($query) {
        $userId = auth()->id();
        $query->where(function ($query) use ($userId) {
            $query->whereDoesntHave('progress')
                ->orWhereHas('progress', function ($query) use ($userId) {
                    $query->where('user_id', $userId)
                          ->where('next_review', '<=', now());
                });
        });
    })
    ->get();
        return view('place.show', compact('category', 'cards'));
    }

    // ====== Обновление прогресса карточки ======
    public function updateProgress(Request $request, Card $card)
    {
        $request->validate([
            'rating' => 'required|integer|in:1,2,3',
        ]);

        $user = auth()->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $progress = CardProgress::firstOrNew([
            'user_id' => $user->id,
            'card_id' => $card->id,
        ], [
            'interval' => 0,
            'ease_factor' => 2.5,
            'success_count' => 0,
        ]);

        $progress->updateForRating((int) $request->input('rating'));

        return response()->json([
            'interval' => $progress->interval,
            'next_review' => optional($progress->next_review)->toDateTimeString(),
        ]);
    }

    // ====== Отдельная страница словаря категории ======
    public function dictionary(Category $category)
    {
        $cards = $category->cards()->with('translations.language')->get();
        return view('place.dictionary', compact('category', 'cards'));
    }

    // ====== Глобальная страница словаря всех тем ======
    public function dictionaryAll()
    {
        $categories = Category::with('cards.translations.language')->get();
        return view('place.dictionary_all', compact('categories'));
    }

    // ====== Редактирование категории ======
    public function edit(Category $category)
    {
        return view('place.edit', compact('category'));
    }

    // ====== Обновление категории ======
    public function update(Category $category)
    {
        $data = request()->validate([
            'title'       => 'string',
            'description' => 'nullable|string',
            'image'       => 'nullable|string',
        ]);

        $category->update($data);
        return redirect()->route('place.show', $category->id);
    }

    // ====== Удаление категории ======
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('place.index');
    }

}