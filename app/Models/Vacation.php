<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacation extends Model
{
    
    protected $fillable = [
        'user_id',
        'year',
        'vacation_days',
        'vacation_days_left'
    ];

    public function user (): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
