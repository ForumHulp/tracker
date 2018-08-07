<?php

namespace App\Http\Controllers;

use App\Issue;
use App\Project;
use App\Client;
use App\Status;
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

        ];


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



		unset($data['clients'], $data['projects'], $data['status']);

        return view('includes/create_issue')->with($data);
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
            'progress'		=> 'required',
			'parent_id'		=> 'required',
			'client'		=> 'required',
			'status'		=> 'required',
			'type'			=> 'required',
			'priority'		=> 'required',
			'title'			=> 'required',
			'description'	=> 'required',
			'start_date'	=> 'required',
			'plan_time'		=> 'required',
			'assigned'		=> 'required',
			'time'			=> 'required',
        ]);

        $attributes = $request->all();
		$attributes['plan_time'] = date('Y-m-d H:i:s', strtotime($attributes['plan_time']));

        Issue::create($attributes);

        $data = [
            'message' => __('issue.create'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('home')->with($data);
    }
}
