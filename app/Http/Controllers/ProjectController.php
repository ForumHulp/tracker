<?php

namespace App\Http\Controllers;

use App\Project;
use App\Client;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data = [
            'projects' => Project::with('client')->get()
        ];

        return view('dashboard/project/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
		$client = Client::select('id', 'name')->get();
		$clients = [];
		foreach($client as $data)
		{
			$clients[$data->id] = $data->name;
		}

        $data = [
			'clientList'	=> $clients,
			'selected'		=> 0
        ];

        return view('dashboard/project/create')->with($data);
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
            'client_id'		=> 'required',
            'title'			=> 'required',
            'description'	=> 'required',
        ]);

        $attributes = $request->all();

        Project::create($attributes);

        $data = [
            'message' => __('project.create'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('project.index')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $project = Project::where('id', $id)->first();

        if(is_null($project)) {
            abort(404);
        }

		$client = Client::select('id', 'name')->get();
		foreach($client as $data)
		{
			$clients[$data->id] = $data->name;
		}

        $data = [
            'project' 		=> $project,
			'clientList'	=> $clients,
			'selected'		=> $project->client
        ];

        return view('dashboard/project/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, Project $project)
    {
        $this->validate($request, [
            'id' 			=> 'required',
            'client_id' 	=> 'required',
            'title'			=> 'required',
            'description'	=> 'required',
        ]);

        $project = Project::where('id', $request->get('id'))->first();

        if(is_null($project)) {
            abort(404);
        }

        $attributes = $request->all();

        $project->update($attributes);

        $data = [
            'message' => __('project.update'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('project.index')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function postDestroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $project = Project::where('id', $request->get('id'))->first();

        if(is_null($project)) {
            abort(404);
        }

        $project->delete();

        $data = [
            'message' => __('project.destroy'),
            'alert-class' => 'alert-success',
        ];

        if($request->wantsJson()) {
            return response()->json($data);
        }

        return redirect()->route('project.index')->with($data);
    }
}
