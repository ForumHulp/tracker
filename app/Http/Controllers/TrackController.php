<?php

namespace App\Http\Controllers;

use App\Track;
use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
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
            'user_id'	=> 'required',
            'issue_id'	=> 'required',
            'remark'	=> 'required',
            'date'		=> 'required',
            'used_time'	=> 'required',
            'progress'	=> 'required'
        ]);

        $attributes = $request->all();
		$attributes['date'] = date('Y-m-d H:i:s', strtotime($attributes['date']));

		$extra_minutes = intval(15 - $attributes['used_time'] % 15);
		if ($extra_minutes > 0 && $extra_minutes < 15)
		{
			$attributes['used_time'] = $attributes['used_time'] + $extra_minutes;
		}

        Track::create($attributes);

        $data = [
            'message' => __('issue.create.track'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('home')->with($data);
    }
}
