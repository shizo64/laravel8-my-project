<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use App\Http\Filters\PlaceFilter;
use App\Http\Requests\Place\FilterRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;

class CategoryShowController extends Controller
{
public function __invoke(Category $category)
{


    $category->load('cards.translations'); // Подгружаем связанные слова
    return view('admin.category.show', compact('category'));


}





}