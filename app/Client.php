<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    public $fillable = [
        'name',
        'email',
        'phone',
        'country',
        'city',
        'address',
    ];

    public $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
