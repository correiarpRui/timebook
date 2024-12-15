<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{   
     protected $fillable = [
        'name',
        'morning_start',
        'morning_end',
        'afternoon_start',
        'afternoon_end',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
    ];

    public function weekschedule():HasMany{
        return $this->hasMany(Weekschedule::class);
    }

    
}
