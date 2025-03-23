<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Symptom extends Model
{
    protected $fillable = ['date', 'time', 'type'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}