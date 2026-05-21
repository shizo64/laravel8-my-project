<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\UpdateRequest;

class CategoryUpdateADController extends Controller
{
    public function __invoke(Category $category, UpdateRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/categories'), $name);
            $data['image'] = $name;
        }

        $category->update($data);
        return redirect()->route('admin.category.show', $category->id);
    }
}