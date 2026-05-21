<?php 


namespace App\Http\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class PlaceFilter extends AbstractFilter
{   
    public const CATEGORY_ID = 'category_id';
    public const NAME = 'name';
    public const TITLE = 'title';


    protected function getCallbacks(): array
    {
    return [
            self::TITLE => [$this, 'title'],
            self::NAME => [$this, 'name'],
            self::CATEGORY_ID => [$this, 'category_id'],
        ];
    }

    public function title( Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");

        
    }

    public function name( Builder $builder, $value)
    {
        $builder->where('name', 'like', "%{$value}%");
    }

    public function category_id( Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    }
}