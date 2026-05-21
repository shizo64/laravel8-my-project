<?php

namespace App\Http\Controllers\Admin\Place;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use App\Http\Filters\PlaceFilter;
use App\Http\Requests\Place\FilterRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;

class CreateController extends Controller
{
public function __invoke()
{


        $categories = Category::all();

        // Теперь берем шаблон из папки card, а не place
        return view('admin.place.create', compact('categories'));
    
}





}