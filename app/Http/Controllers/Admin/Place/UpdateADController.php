<?php

namespace App\Http\Controllers\Admin\Place;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use App\Http\Filters\PlaceFilter;
use App\Http\Requests\Place\FilterRequest;
use App\Http\Requests\Place\UpdatePlaceRequest;
use App\Http\Requests\Place\UpdateRequest;
use Faker\Provider\Base;
use App\Http\Controllers\Place\BaseController;

class UpdateADController extends BaseController
{
public function __invoke(Place $place, UpdateRequest $request)
{

    $date = $request->validated();
    

    $this->service->update($place,$date);

    return redirect()->route('admin.place.show', $place->id);

}



}