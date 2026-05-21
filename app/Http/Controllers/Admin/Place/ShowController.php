<?php

namespace App\Http\Controllers\Admin\Place;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use App\Http\Filters\PlaceFilter;
use App\Http\Requests\Place\FilterRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;

class ShowController extends Controller
{
public function __invoke(Place $place)
    {
        // Загружаем связь с категорией, чтобы она была доступна в шаблоне
        $place->load('category');

        // Передаем переменную $place в шаблон. 
        // В шаблоне категория будет доступна как $place->category
        return view('admin.place.show', compact('place'));
    }




}