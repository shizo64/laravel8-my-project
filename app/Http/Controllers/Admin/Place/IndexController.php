<?php

namespace App\Http\Controllers\Admin\Place;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use App\Http\Filters\PlaceFilter;
use App\Http\Requests\Place\FilterRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;

class IndexController extends Controller
{
public function __invoke(FilterRequest $request)
{
    $data = $request->validated();

    $filter = app()->make(PlaceFilter::class, ['queryParams' => array_filter($data)]); // - создаём фильтр и передаём ему отфильтрованные данные из запроса
    $places = Place::filter($filter)->paginate(20); // - применяем фильтр к модели Place и получаем отфильтрованные данные

    return view("admin.place.index", compact('places')); // отправляем в Blade);

}





}