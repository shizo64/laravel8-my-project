<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;

class CategoryStoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);
        return redirect()->route('admin.category.show', $category->id);
    }
}