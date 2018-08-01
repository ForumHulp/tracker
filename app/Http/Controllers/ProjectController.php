<?php

namespace App\Http\Controllers;

use App\Project;
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
            'projects' => Project::all(),
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
        $data = [
			'clientList'	=> ['client Billy', 'client Youp', 'client John'],
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

        return redirect()->route('project.index');
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

        $data = [
            'project' 		=> $project,
			'clientList'	=> ['client Billy', 'client Youp', 'client John'],
			'selected'		=> 2
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

        return redirect()->route('project.index');
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

        return redirect()->route('project.index');
    }
}
