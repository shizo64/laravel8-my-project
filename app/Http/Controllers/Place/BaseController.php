<?php

namespace App\Http\Controllers\Place;
use App\Http\Controllers\Controller;
use App\Service\Place\Service;
use App\Service\Category\ServiceCat;

class BaseController extends Controller
{
    public $service;
    public $serviceCat;
    public function __construct(Service $service, ServiceCat $serviceCat)
    {
        $this->service = $service;
        $this->serviceCat = $serviceCat;
    }
    

}