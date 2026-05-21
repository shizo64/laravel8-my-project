<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use App\Http\Filters\PlaceFilter;
use App\Http\Requests\Category\FilterRequest;
use App\Http\Requests\Category\UpdatePlaceRequest;

class CategoryEditADController extends Controller
{
public function __invoke(Category $category)
{

    $categories = Category::all();

    return view("admin.category.edit", compact("category", "categories"));

}



}