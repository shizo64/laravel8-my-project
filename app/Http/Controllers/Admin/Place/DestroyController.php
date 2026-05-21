<?php

namespace App\Http\Controllers\Admin\Place;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use App\Http\Filters\PlaceFilter;
use App\Http\Requests\Place\FilterRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;

class DestroyController extends Controller
{
public function __invoke(Place $place)
{

    $place->delete();
    return redirect()->route('admin.place.index');

}





}