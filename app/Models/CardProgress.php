<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class CardProgress extends Model
{
    use HasFactory;

    protected $table = 'card_progress';

    protected $fillable = [
        'user_id',
        'card_id',
        'interval',
        'ease_factor',
        'next_review',
        'success_count',
    ];

    protected $casts = [
        'next_review' => 'datetime',
        'interval' => 'integer',
        'ease_factor' => 'float',
        'success_count' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function card()
    {
        return $this->belongsTo(Card::class);
    }

    public function updateForRating(int $rating): void
    {
        $currentInterval = max(1, $this->interval);
        $easeFactor = max(1.3, $this->ease_factor ?: 2.5);

        if ($rating === 1) {
            $nextInterval = 1;
        } elseif ($rating === 2) {
            $nextInterval = (int) round($currentInterval * $easeFactor);
        } else {
            $nextInterval = (int) round($currentInterval * $easeFactor * 1.2);
        }

        $nextInterval = max(1, $nextInterval);

        $this->interval = $nextInterval;
        $this->next_review = now()->addDays($nextInterval);
        $this->success_count = $this->success_count + 1;
        $this->save();
    }
}
