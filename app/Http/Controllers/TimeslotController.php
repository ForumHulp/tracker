<?php

namespace App\Http\Controllers;

use App\TimeConsumed;
use Illuminate\Http\Request;

class TimeslotController extends Controller
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
            'timeslots' => Timeslot::all(),
        ];

        return view('dashboard/timeslot/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('dashboard/timeslot/create');
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
            'time amount' => 'required',
        ]);

        $attributes = $request->all();

        Timeslot::create($attributes);

        return redirect()->route('timeslot.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Timeslot  $status
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $timeslot = Timeslot::where('id', $id)->first();

        if(is_null($timeslot)) {
            abort(404);
        }

        $data = [
            'time amount' => $timeslot,
        ];

        return view('dashboard/timeslot/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timeslot  $status
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, Status $timeslot)
    {
        $this->validate($request, [
            'id' => 'required',
            'time amount' => 'required',
        ]);

        $timeslot = TimeConsumed::where('id', $request->get('id'))->first();

        if(is_null($timeslot)) {
            abort(404);
        }

        $attributes = $request->all();

        $timeslot->update($attributes);

        return redirect()->route('timeslot.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Timeslot  $status
     * @return \Illuminate\Http\Response
     */
    public function postDestroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $timeslot = Timeslot::where('id', $request->get('id'))->first();

        if(is_null($timeslot)) {
            abort(404);
        }

        $timeslot->delete();

        return redirect()->route('timeslot.index');
    }
}
