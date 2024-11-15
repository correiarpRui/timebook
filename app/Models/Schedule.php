<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function users(): HasMany{
        return $this->hasMany(User::class);
    }
}
