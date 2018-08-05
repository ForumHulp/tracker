<?php

namespace App\Http\Controllers;

use App\Priority;
use Illuminate\Http\Request;

class PriorityController extends Controller
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
            'priorities' => Priority::all(),
        ];

        return view('dashboard/priority/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('dashboard/priority/create');
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
            'title' => 'required',
        ]);

        $attributes = $request->all();

        Priority::create($attributes);

        $data = [
            'message' => __('priority.create'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('priority.index')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $priority = Priority::where('id', $id)->first();

        if(is_null($priority)) {
            abort(404);
        }

        $data = [
            'priority' => $priority,
        ];

        return view('dashboard/priority/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Priority  $priority
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, Priority $priority)
    {
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
        ]);

        $priority = Priority::where('id', $request->get('id'))->first();

        if(is_null($priority)) {
            abort(404);
        }

        $attributes = $request->all();

        $priority->update($attributes);

        $data = [
            'message' => __('priority.update'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('priority.index')->with($data);
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

        $priority = Priority::where('id', $request->get('id'))->first();

        if(is_null($priority)) {
            abort(404);
        }

        $priority->delete();

        $data = [
            'message' => __('priority.destroy'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('priority.index')->with($data);
    }
}
