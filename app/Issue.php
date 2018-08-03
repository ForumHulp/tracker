<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends Model
{
    use SoftDeletes;

    public $fillable = [
        'parent',
        'client',
        'status',
        'type',
        'priority',
        'title',
        'description',
        'start_date',
        'plan_time',
        'assigned',
        'time',
    ];

    public $dates = [
        'start_date',
		'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function clients()
    {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function statuses()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function types()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'assigned', 'id')->withDefault(['id' => 0]);
    }
}
