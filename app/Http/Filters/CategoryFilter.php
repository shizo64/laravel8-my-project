<?php


namespace App\Http\Filters;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;


class CategoryFilter extends AbstractFilter
{
    public const TITLE = 'title';
    public const IMAGE = 'image';
    public const WORD_RU = 'word_ru';
    public const WORD_EN = 'word_en';
    public const TRANSLATION = 'translation';


    protected function getCallbacks(): array
    {
        return [
            self::TITLE => [$this, 'title'],
            self::IMAGE => [$this, 'image'],
            self::WORD_RU => [$this, 'word_ru'],
            self::WORD_EN => [$this, 'word_en'],
            self::TRANSLATION => [$this, 'translation'],
        ];
    }

    public function title(Builder $builder, $value)
    {
        $builder->where('title', 'like', "%{$value}%");
    }

    public function image(Builder $builder, $value)
    {
        $builder->where('image', 'like', "%{$value}%");
    }

    public function word_ru(Builder $builder, $value)
    {
        $builder->where('word_ru', 'like', "%{$value}%");
    }

    public function word_en(Builder $builder, $value)
    {
        $builder->where('word_en', 'like', "%{$value}%");
    }

    public function translation(Builder $builder, $value)
    {
        $builder->where('translation', 'like', "%{$value}%");
    }
}