<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends Model
{
    use SoftDeletes;

    public $fillable = [
        'title',
    ];

    public $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
