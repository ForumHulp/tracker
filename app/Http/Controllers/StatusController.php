<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
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
            'statuses' => Status::all(),
        ];
		
		if (auth()->user()->hasRole('manager'))
		{
        	return view('dashboard/status/index')->with($data);
		} else
		{
	        return redirect()->route('home');
		}
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('dashboard/status/create');
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

        Status::create($attributes);

        $data = [
            'message' => __('status.create'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('status.index')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $status = Status::where('id', $id)->first();

        if(is_null($status)) {
            abort(404);
        }

        $data = [
            'status' => $status,
        ];

        return view('dashboard/status/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, Status $status)
    {
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
        ]);

        $status = Status::where('id', $request->get('id'))->first();

        if(is_null($status)) {
            abort(404);
        }

        $attributes = $request->all();
        $attributes['due_at'] = date('Y-m-d H:i:s', time());

        $status->update($attributes);

        $data = [
            'message' => __('status.update'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('status.index')->with($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function postDestroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $status = Status::where('id', $request->get('id'))->first();

        if(is_null($status)) {
            abort(404);
        }

        $status->delete();

        $data = [
            'message' => __('status.destroy'),
            'alert-class' => 'alert-success',
        ];
 
         if($request->wantsJson()) {
            return response()->json($data);
        }

       return redirect()->route('status.index')->with($data);
    }
}
