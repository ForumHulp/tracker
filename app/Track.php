<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Track extends Model
{
    use SoftDeletes;

    public $fillable = [
        'user_id',
        'issue_id',
        'remark',
        'used_time',
		'date',
		'attachment'
    ];

    public $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
		'date'
    ];

    public function issues()
    {
        return $this->belongsTo(Issue::class);
    }
}
