<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CardTranslation;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'name'];

    public function CardTranslations()
    {
        return $this->hasMany(CardTranslation::class);
    }
}
