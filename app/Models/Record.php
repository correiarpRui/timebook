<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Record extends Model
{
     protected $fillable = [
        'date',
        'week_day',
        'user_id',
        'morning_start',
        'morning_end',
        'afternoon_start',
        'afternoon_end',
        'is_present'
        
    ];
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
