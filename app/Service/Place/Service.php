<?php

namespace App\Service\Place;
 


class Service
{

    public function store($place,$data){
       //$place = Place::create($date);
    }



    public function update($place, $date){
        $place->update($date);
    }
}