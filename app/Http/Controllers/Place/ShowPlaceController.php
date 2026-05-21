<?php

namespace App\Http\Controllers\Place;

use App\Http\Controllers\Controller;
use App\Models\Place;

class ShowPlaceController extends Controller
{
    public function __invoke(Place $place)
    {
        $place->load('category');
        return view('place.show', compact('place'));
    }
}