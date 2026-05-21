<?php

namespace App\Http\Controllers\Place;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
class EditPlaceController extends Controller
{
public function __invoke(Place $place)
{
    $categories = Category::all();

    return view("place.edit", compact("place", "categories"));

}




}