<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timeslot extends Model
{
    use SoftDeletes;

    public $fillable = [
        'time amount',
    ];

    public $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
