<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $fillable = [
        'type',
        'start_date',
        'end_date',
        'start_day',
        'end_day',
        'month',
        'year',
        'status_id',

    ];

    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class);
    }

    public function status(): BelongsTo{
        return $this->belongsTo(Status::class);
    }
}
