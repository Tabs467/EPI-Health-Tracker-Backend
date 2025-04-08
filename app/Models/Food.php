<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Food extends Model
{
    protected $fillable = ['date', 'time', 'food_title', 'size', 'spice', 'fat', 'gluten', 'dairy', 'medication'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}