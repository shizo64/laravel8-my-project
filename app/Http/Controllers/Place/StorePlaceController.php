<?php

namespace App\Http\Controllers\Place;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Place;
use App\Http\Controllers\Controller;
use App\Http\Requests\Place\StoreRequest;
use Faker\Provider\Base;
use Symfony\Component\HttpKernel\HttpCache\Store;
use App\Http\Controllers\Place\BaseController;

class StorePlaceController extends BaseController
{
public function __invoke(StoreRequest $request)
{
    $date = $request->validated();
    $place = Place::create($date);

    //$this->service->store($date);

    return redirect()->route('place.show', $place->id);
}




}