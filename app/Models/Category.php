<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Card;
use App\Models\Traits\Filterable;

class Category extends Model
{
    use HasFactory, Filterable;

    protected $table = 'categories';

    protected $fillable = [
        'title',
        'name',
        'image',
        'description',
        'quantity',
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'category_id', 'id');
    }
}