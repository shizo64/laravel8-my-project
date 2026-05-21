<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use App\Http\Filters\CategoryFilter;
use App\Http\Requests\Place\FilterRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;

class CategoryIndexController extends Controller
{
public function __invoke(FilterRequest $request)
{
    $data = $request->validated();  

    $filter = app()->make(CategoryFilter::class, ['queryParams' => array_filter($data)]); // - создаём фильтр и передаём ему отфильтрованные данные из запроса
    $categories = Category::filter($filter)->paginate(20); // - применяем фильтр к модели Category и получаем отфильтрованные данные

    return view("admin.category.index", compact('categories')); // отправляем в Blade);

}



}