<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use App\Http\Filters\PlaceFilter;
use App\Http\Requests\Place\FilterRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;


class CategoryCreateController extends Controller
{

public function __invoke()
    {
        // Получаем данные для выпадающих списков в форме
        $place = Place::all(); 
        $categories = Category::all(); 

        // Возвращаем ваш шаблон. 
        // Проверь, чтобы файл лежал в resources/views/admin/place/create.blade.php
        return view('admin.category.create', compact('categories', 'place'));
    }
}