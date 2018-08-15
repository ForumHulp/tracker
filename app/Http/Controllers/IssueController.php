<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Project;
use App\Client;
use App\Status;
use App\Type;
use App\Priority;
use App\User;
use DB;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
		$data = $this->selectBoxes();
		$data['start_date'] = date('d-m-Y', strtotime('tomorrow 08:00'));

        return view('includes/create_issue')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $issue = Issue::with('project.client', 'project')->where('id', $id)->first();

        if(is_null($issue)) {
            abort(404);
        }

		$issue->plan_time = sprintf("%d:%02d", floor($issue->plan_time / 60), $issue->plan_time % 60);
		$data = $this->selectBoxes($issue->parent_id);		
        $data['issue'] = $issue;

        return view('includes/edit_issue')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Issue  $issue
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, Issue $issue)
    {
        $this->validate($request, [
			'project_id'	=> 'required|not_in:0',
			'status_id'		=> 'required',
			'type_id'		=> 'required',
			'priority_id'	=> 'required',
			'assigned'		=> 'required',
			'title'			=> 'required',
			'description'	=> 'required',
			'start_date'	=> 'required',
			'plan_time'		=> 'required',
        ]);

        $issue = Issue::where('id', $request->get('id'))->first();

        if(is_null($issue)) {
            abort(404);
        }

        $attributes = $request->all();
		
		$attributes['start_date'] = date('Y-m-d H:i:s', strtotime($attributes['start_date']));
		$plan_time = explode(':', $attributes['plan_time']);
		$attributes['plan_time'] = ($plan_time[0] * 60) + $plan_time[1];

        $issue->update($attributes);
		
		\Mail::send('email.new_issue', $issue->toArray(), function ($message) {
			$assigned = User::select('name', 'email')->where('id', \Request::get('assigned'))->first();
            $message->to($assigned->email, $assigned->name)
                ->subject('New issue for you');
        });

        $data = [
            'message' => __('issue.update'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('home')->with($data);
    }

    /**
     * Selecct values for issue dropdown.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postSelect(Request $request)
    {
		$id = $request->get('id');
		$type = $request->get('type');
		$combo1 = $combo2 = $combo2select = [];
		
		switch($type)
		{
			case 'client_id':
				$combo1 = Project::select(DB::raw('projects.id as id, projects.title as title'));
				$combo2 = Issue::select(DB::raw('issues.id as id, issues.title as title'));
			break;

			case 'project_id':
				$combo1 = Project::leftJoin('clients', function($join) {
						  $join->on('clients.id', '=', 'projects.client_id');
					})
					->select(DB::raw('clients.id as id, clients.name as title, projects.id as project_id'));
					$type = 'projects.id';
					
				$combo2 = Issue::select(DB::raw('issues.id as id, issues.title as title'));
			break;

			case 'parent_id':
				$combo1 = Project::leftJoin('issues', function($join) {
						  $join->on('projects.id', '=', 'issues.project_id');
					})
					->select(DB::raw('projects.id as id, projects.title as title'));
					$type = 'issues.id';
			
				$combo2 = Client::leftJoin('projects', function($join) {
						  $join->on('clients.id', '=', 'projects.client_id');
					})
					->select(DB::raw('clients.id as id, clients.name as title'));
			break;
		}

		$combo1 = ($id) ?  $combo1->where($type, $id)->get() : $combo1->get();
		
		foreach($combo1 as $value){$combo2select[] = (($type != 'projects.id') ? $value->id : $value->project_id);}

		$combo2 = (sizeof($combo2select) ? (($type == 'issues.id') ? $combo2->whereIn('projects.id', $combo2select)->get() : $combo2->whereIn('project_id', $combo2select)->get()) : $combo2->get());

		if ($type == 'issues.id')
		{
			$comb = $combo1;
			$combo1 = $combo2;	
			$combo2 = $comb;
			unset($comb);
		}

        if(is_null($combo1)) {
            abort(404);
        }

		$data['combo1'][] = ['key' => '', 'value' => __('issue.no_record')];
		foreach($combo1 as $value)
		{
			$data['combo1'][] = ['key' => $value->id, 'value' => $value->title];
		}
		$data['combo2'][] = ['key' => '', 'value' => __('issue.no_record')];
		foreach($combo2 as $value)
		{
			$data['combo2'][] = ['key' => $value->id, 'value' => $value->title];
		}

        if ($request->wantsJson()) {
            return response()->json($data);
        }
	}
	
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postStore(Request $request)
    {
        $this->validate($request, [
			'project_id'	=> 'required|not_in:0',
			'status_id'		=> 'required',
			'type_id'		=> 'required',
			'priority_id'	=> 'required',
			'assigned'		=> 'required',
			'title'			=> 'required',
			'description'	=> 'required',
			'start_date'	=> 'required',
			'plan_time'		=> 'required',
        ]);

        $attributes = $request->all();
		$attributes['start_date'] = date('Y-m-d H:i:s', strtotime($attributes['start_date']));
		$plan_time = explode(':', $attributes['plan_time']);
		$attributes['plan_time'] = ($plan_time[0] * 60) + $plan_time[1];

        Issue::create($attributes);

        $data = [
            'message' => __('issue.created_issue'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('home')->with($data);
    }

    /**
     * get selects.
     *
     * @return array    $data
     */
    private function selectBoxes($id = null)
	{
//        $projects = \Cache::rememberForever('projects', function() {
            $projects = Project::all();
//        });

  //      $clients = \Cache::rememberForever('clients', function() {
            $clients = Client::all();
//        });

 //       $status = \Cache::rememberForever('status', function() {
            $status = Status::all();
 //       });

//        $types = \Cache::rememberForever('types', function() {
            $types =  Type::all();
//        });

//        $priorities = \Cache::rememberForever('priorities', function() {
            $priorities =  Priority::all();
//        });

        $users = \Cache::rememberForever('users', function() {
            return User::whereHas('roles', function($q){
                $q->where('name', '!=', 'manager');
            })->get();
        });

//        $issues = \Cache::rememberForever('issues', function() {
            $issues = ($id == null) ? Issue::all()->where('parent_id', null) : Issue::where('id', $id)->first()->getDescendantsAndSelf();
//        });

        $data = [
            'projects' => ['' => __('issue.no_record')] + $projects->pluck('title', 'id')->toArray(),
			'clients' => ['' => __('issue.no_record')] + $clients->pluck('name', 'id')->toArray(),
			'status' => ['' => __('issue.no_record')] + $status->pluck('title', 'id')->toArray(),
			'types'	=> ['' => __('issue.no_record')] + $types->pluck('title', 'id')->toArray(),
			'priorities' => ['' => __('issue.no_record')] + $priorities->pluck('title', 'id')->toArray(),
			'users'	=> ['' => __('issue.no_record')] + $users->pluck('name', 'id')->toArray(),
			'issues' => ['' => __('issue.no_record')] + $issues->pluck('title', 'id')->toArray(),
        ];
		
		return $data;
	}
}
