<?php 


namespace App\Http\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


interface FilterInterface
{
    public function apply(Builder $builder); // - применить фильтр к билдеру
}