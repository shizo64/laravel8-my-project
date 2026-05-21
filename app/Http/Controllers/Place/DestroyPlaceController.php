<?php

namespace App\Http\Controllers\Place;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
class DestroyPlaceController extends Controller
{
public function __invoke(Place $place)
{
    $place->delete();
    return redirect()->route('place.index');

}




}