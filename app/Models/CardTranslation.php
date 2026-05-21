<?php

namespace App\Models;

use App\Models\Language;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardTranslation extends Model
{
    use HasFactory;


    protected $fillable = [
        'card_id',
        'language_id',
        'translation',
        'transcription',
        'audio',
    ];

    // 🔹 к какой карточке относится
    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    // 🔹 к какому языку относится
    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
