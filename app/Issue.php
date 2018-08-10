<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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

  //////////////////////////////////////////////////////////////////////////////

  //
  // Below come the default values for Baum's own Nested Set implementation
  // column names.
  //
  // You may uncomment and modify the following fields at your own will, provided
  // they match *exactly* those provided in the migration.
  //
  // If you don't plan on modifying any of these you can safely remove them.
  //

  // /**
  //  * Column name which stores reference to parent's node.
  //  *
  //  * @var string
  //  */
  // protected $parentColumn = 'parent_id';

  // /**
  //  * Column name for the left index.
  //  *
  //  * @var string
  //  */
  // protected $leftColumn = 'lft';

  // /**
  //  * Column name for the right index.
  //  *
  //  * @var string
  //  */
  // protected $rightColumn = 'rgt';

  // /**
  //  * Column name for the depth field.
  //  *
  //  * @var string
  //  */
  // protected $depthColumn = 'depth';

  // /**
  //  * Column to perform the default sorting
  //  *
  //  * @var string
  //  */
  // protected $orderColumn = null;

  // /**
  // * With Baum, all NestedSet-related fields are guarded from mass-assignment
  // * by default.
  // *
  // * @var array
  // */
  // protected $guarded = array('id', 'parent_id', 'lft', 'rgt', 'depth');

  //
  // This is to support "scoping" which may allow to have multiple nested
  // set trees in the same database table.
  //
  // You should provide here the column names which should restrict Nested
  // Set queries. f.ex: company_id, etc.
  //

  // /**
  //  * Columns which restrict what we consider our Nested Set list
  //  *
  //  * @var array
  //  */
  // protected $scoped = array();

  //////////////////////////////////////////////////////////////////////////////

  //
  // Baum makes available two model events to application developers:
  //
  // 1. `moving`: fired *before* the a node movement operation is performed.
  //
  // 2. `moved`: fired *after* a node movement operation has been performed.
  //
  // In the same way as Eloquent's model events, returning false from the
  // `moving` event handler will halt the operation.
  //
  // Please refer the Laravel documentation for further instructions on how
  // to hook your own callbacks/observers into this events:
  // http://laravel.com/docs/5.0/eloquent#model-events


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

    public function projects()
    {
        return $this->belongsTo(Project::class, 'project_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'assigned', 'id')->withDefault(['id' => 0]);
    }

    public function tracks()
    {
        return $this->hasMany(Track::class, 'issue_id', 'id');
    }
}
