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

    public function schedules():HasMany{
        return $this->hasMany(Schedule::class);
    }

    public function users():HasMany{
        return $this->hasMany(User::class);
    }
}
