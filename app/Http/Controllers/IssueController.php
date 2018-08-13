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
		$data = $this->selectBoxes($id);		
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
	//		'parent_id'		=> 'required',
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
		
//		$attributes['parent_id'] = ($attributes['parent_id'] == $request->get('id')) ? null : $attributes['parent_id'];
		$attributes['start_date'] = date('Y-m-d H:i:s', strtotime($attributes['start_date']));
		$plan_time = explode(':', $attributes['plan_time']);
		$attributes['plan_time'] = ($plan_time[0] * 60) + $plan_time[1];
//dd($attributes);
 //       $issue->update($attributes);

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
		$json =	$issue = [];
		
		switch($type)
		{
			case 'client_id':
				$json = Project::select(DB::raw('projects.id as id, projects.title as title'));
			break;

			case 'project_id':
				$json = Project::leftJoin('clients', function($join) {
						  $join->on('clients.id', '=', 'projects.client_id');
					})
					->select(DB::raw('clients.id as id, clients.name as title'));
					$type = 'projects.id';
					
				$issue = Issue::select(DB::raw('issues.id as id, issues.title as title'));
			break;
		}

		if ($id)
		{
			$json = $json->where($type, $id);
				
			if ($type == 'projects.id')
			{
				$issue = $issue->where('project_id', $id)->where('parent_id', null);
				$issue = $issue->get();
			}
		}
		$json = $json->get();
		
        if(is_null($json)) {
            abort(404);
        }
		$data['selects'][] = ['key' => '', 'value' => __('issue.no_record')];
		foreach($json as $value)
		{
			$data['selects'][] = ['key' => $value->id, 'value' => $value->title];
		}
		$data['issue'][] = ['key' => '', 'value' => __('issue.no_record')];
		foreach($issue as $value)
		{
			$data['issue'][] = ['key' => $value->id, 'value' => $value->title];
		}

        if($request->wantsJson()) {
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
        $projects = \Cache::rememberForever('projects', function() {
            return Project::all();
        });

        $clients = \Cache::rememberForever('clients', function() {
            return Client::all();
        });

        $status = \Cache::rememberForever('status', function() {
            return Status::all();
        });

        $types = \Cache::rememberForever('types', function() {
            return Type::all();
        });

        $priorities = \Cache::rememberForever('priorities', function() {
            return Priority::all();
        });

        $users = \Cache::rememberForever('users', function() {
            return User::whereHas('roles', function($q){
                $q->where('name', '!=', 'manager');
            })->get();
        });

        $issues = \Cache::rememberForever('issues', function() {
            return Issue::all()->where('parent_id', null);
        });

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
