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
        $data = [
            'projects'	=> Project::all(),
			'clients'	=> Client::all(),
			'status'	=> Status::all(),
			'type'		=> Type::all(),
			'priority'	=> Priority::all(),
			'user'		=> User::whereHas('roles', function($q){
								$q->where('name', '!=', 'manager');
							})->get(),
			'issue'		=> Issue::all()->where('parent_id', null),
        ];

		$data['userList'][''] = $data['projectList'][''] = $data['clientList'][''] = $data['issueList'][''] =  __('issue.no_record');
		foreach($data['projects'] as $projects)
		{
			$data['projectList'][$projects->id] = $projects->title;
		}
		foreach($data['clients'] as $client)
		{
			$data['clientList'][$client->id] = $client->name;
		}
		foreach($data['status'] as $status)
		{
			$data['statusList'][$status->id] = $status->title;
		}
		foreach($data['type'] as $type)
		{
			$data['typeList'][$type->id] = $type->title;
		}
		foreach($data['priority'] as $priority)
		{
			$data['priorityList'][$priority->id] = $priority->title;
		}
		foreach($data['user'] as $user)
		{
			$data['userList'][$user->id] = $user->name;
		}
		foreach($data['issue'] as $issue)
		{
			$data['issueList'][$issue->id] = $issue->title;
		}

		unset($data['clients'], $data['projects'], $data['status'], $data['type'], $data['user'], $data['issue'], $data['priority']);
		$data['start_date'] = date('d-m-Y', strtotime('tomorrow 08:00'));

        return view('includes/create_issue')->with($data);
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
}
