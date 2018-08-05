<?php

namespace App\Http\Controllers;

use App\Timeslot;
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
        $user_id = auth()->user()->id;
        //Select Timeslots per current user
        $timeslots = Timeslot::where('user_id', $user_id)->get();
        //Select Timeslots per project
        //$issue_id = -1;
        //$timeslots = Timeslot::where('issue_id', $issue_id)->get();
        $data = [
            'timeslots' => $timeslots,
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
      for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
        {
          for($mins=0; $mins<60; $mins+=15) // the interval for mins is '30'
          {
            $time_amounts[''.str_pad($hours,2,'0',STR_PAD_LEFT)
            .':'.str_pad($mins,2,'0',STR_PAD_LEFT)
            .':'.str_pad(0,2,'0',STR_PAD_LEFT).''] = ''.str_pad($hours,2,'0',STR_PAD_LEFT)
                                                       .':'.str_pad($mins,2,'0',STR_PAD_LEFT).'';

          };
        };

        //$issues = User::with('issues')->find(auth()->user()->id)->tasks,
        $default_time = '00:00:00';
        $user_id = auth()->user()->id;

        $data = [
            'default_time'  => $default_time,
            'time_amounts' => $time_amounts,
            'user_id'      => $user_id,
        ];

        //dd($data);
        return view('dashboard/timeslot/create', $data);
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
            'time_amount' => 'required',
            'user_id' => 'required',
        ]);

        $attributes = $request->all();

        Timeslot::create($attributes);

        $data = [
            'message' => __('timeslot.create'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('timeslot.index')->with($data);
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

        for($hours=0; $hours<24; $hours++) // the interval for hours is '1'
          {
            for($mins=0; $mins<60; $mins+=15) // the interval for mins is '30'
            {
              $time_amounts[''.str_pad($hours,2,'0',STR_PAD_LEFT)
              .':'.str_pad($mins,2,'0',STR_PAD_LEFT)
              .':'.str_pad(0,2,'0',STR_PAD_LEFT).''] = ''.str_pad($hours,2,'0',STR_PAD_LEFT)
                                                         .':'.str_pad($mins,2,'0',STR_PAD_LEFT).'';

            };
          };

          $user_id = auth()->user()->id;
          $data = [
              'timeslot'     => $timeslot,
              'time_amounts' => $time_amounts,
              'user_id'      => $user_id,
          ];

          //dd($data);

        return view('dashboard/timeslot/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Timeslot
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, Timeslot $timeslot)
    {
        $this->validate($request, [
            'id' => 'required',
            'user_id' => 'required',
            'time_amount' => 'required',
        ]);

        $timeslot = Timeslot::where('id', $request->get('id'))->first();

        if(is_null($timeslot)) {
            abort(404);
        }

        $attributes = $request->all();

        $timeslot->update($attributes);

        $data = [
            'message' => __('timeslot.update'),
            'alert-class' => 'alert-success',
        ];

        return redirect()->route('timeslot.index')->with($data);;
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

        $data = [
            'message' => __('timeslot.destroy'),
            'alert-class' => 'alert-success',
        ];

        return redirect()->route('timeslot.index')->with($data);
    }
}
