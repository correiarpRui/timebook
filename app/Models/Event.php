<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $fillable = [
        'type',
        'start_date',
        'end_date'
    ];

    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }
}
