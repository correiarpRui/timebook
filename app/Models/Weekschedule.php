<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Weekschedule extends Model
{
     protected $fillable = [
        'user_id',
        'schedule_id',
        'year',
        'week_number',
    ];

    public function schedule():BelongsTo{
        return $this->belongsTo(Schedule::class);
    }

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
