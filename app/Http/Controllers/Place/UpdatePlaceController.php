<?php

namespace App\Http\Controllers\Place;
use App\Http\Requests\Place\UpdateRequest;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use Faker\Provider\Base;

class UpdatePlaceController extends BaseController
{
public function __invoke(UpdateRequest $request, Place $place)
{
    $date = $request->validated();
    

    $this->service->update($place,$date);

    return redirect()->route('place.show', $place->id);

}




}