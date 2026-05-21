<?php

namespace App\Http\Controllers\Admin\Category;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use App\Http\Filters\PlaceFilter;
use App\Http\Requests\Place\FilterRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;

class CategoryDestroyController extends Controller
{
public function __invoke(Category $category)
{
    // Отвязываем связанные места перед удалением категории.
    if ($category->places()->exists()) {
        $category->places()->update(['category_id' => null]);
    }

    $category->delete();

    return redirect()->route('admin.category.index')
        ->with('success', 'Категория успешно удалена. Связанные места отвязаны (category_id -> null).');
}





}