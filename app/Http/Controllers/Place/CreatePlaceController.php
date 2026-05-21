<?php

namespace App\Http\Controllers\Place;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use Faker\Provider\Base;

class CreatePlaceController extends BaseController
{
public function __invoke()
{

    $place = Place::all(); // берём все записи
    $categories = Category::all(); // берём все записи
    return view('place.create', compact('place', 'categories')); // отправляем в Blade

}




}