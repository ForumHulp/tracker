<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    public $fillable = [
        'client_id',
        'title',
        'description',
    ];

    public $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function clients()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }
}
