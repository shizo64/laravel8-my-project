<?php

namespace App\Http\Controllers\Place;

use App\Models\Place;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Place\FilterRequest;
use App\Http\Filters\PlaceFilter;

class IndexPlaceController extends Controller
{
    public function __invoke(FilterRequest $request)
    {
        $data = $request->validated();

        $filter = app()->make(PlaceFilter::class, ['queryParams' => array_filter($data)]);
        $places = Place::filter($filter)->paginate(3);

        $categories = Category::paginate(3);

        // Получаем уникальные названия курсов (title) для отображения на главной
        $courses = Place::select('title', 'description', 'image')
            ->distinct('title')
            ->get();

        return view('place.index', compact('places', 'categories', 'courses'));
    }
}