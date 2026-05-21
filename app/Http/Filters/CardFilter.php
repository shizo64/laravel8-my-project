<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class CardFilter extends AbstractFilter
{
    public const CATEGORY_ID = 'category_id';
    public const LANGUAGE_ID = 'language_id';
    public const TRANSLATION = 'translation';

    protected function getCallbacks(): array
    {
        return [
            self::CATEGORY_ID => [$this, 'category_id'],
            self::LANGUAGE_ID => [$this, 'language_id'],
            self::TRANSLATION => [$this, 'translation'],
        ];
    }

    public function category_id(Builder $builder, $value)
    {
        $builder->where('category_id', $value);
    }

    public function language_id(Builder $builder, $value)
    {
        $builder->whereHas('translations', function ($q) use ($value) {
            $q->where('language_id', $value);
        });
    }

    public function translation(Builder $builder, $value)
    {
        $builder->whereHas('translations', function ($q) use ($value) {
            $q->where('translation', 'like', "%{$value}%");
        });
    }
}