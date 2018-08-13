<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;

class Issue extends \Baum\Node  
{
	/**
	* Table name.
	*
	* @var string
	*/
	protected $table = 'issues';

    use SoftDeletes;

    public $fillable = [
		'project_id',
		'parent_id',
		'status_id',
		'type_id',
		'priority_id',
		'assigned',
		'title',
		'description',
		'start_date',
		'plan_time',
    ];

    public $dates = [
        'start_date',
		'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'assigned', 'id');
    }

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }
}
