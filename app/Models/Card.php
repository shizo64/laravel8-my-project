<?php

namespace App\Models;

use App\Models\CardProgress;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'image',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function translations()
    {
        return $this->hasMany(CardTranslation::class);
    }

    public function progress()
    {
        return $this->hasMany(CardProgress::class);
    }

    public function scopeFilter($query, $filter)
    {
        $filter->apply($query);
    }
}