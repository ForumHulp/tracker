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
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEdit(Request $request, $id)
    {
        $track = Track::where('id', $id)->first();

        if(is_null($track)) {
            abort(404);
        }

		$track->used_time = sprintf("%d:%02d", floor($track->used_time / 60), $track->used_time % 60);
		$track->datum = $track->date->format('d-m-Y');
        if($request->wantsJson()) {
            return response()->json([
                'track' => $track,
				'route'	=> route('tracker.update')
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Priority  $priority
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, Track $track)
    {
        $this->validate($request, [
            'user_id'	=> 'required',
            'issue_id'	=> 'required',
            'remark'	=> 'required',
            'date'		=> 'required',
            'used_time'	=> 'required',
            'progress'	=> 'required'
        ]);

        $track = Track::where('id', $request->get('track_id'))->first();
        if(is_null($track)) {
            abort(404);
        }

        $attributes = $request->all();
		$attributes['date'] = date('Y-m-d H:i:s', strtotime($attributes['date']));

		$time = explode(':', $attributes['used_time']);
		$time = (int) ($time[0] * 60) + $time[1];
		$extra_minutes = intval(15 - $time % 15);
		if ($extra_minutes > 0 && $extra_minutes < 15)
		{
			$time = $time + $extra_minutes;
		}
		$attributes['used_time'] = $time;

		$track->update($attributes);

        $data = [
            'message' => __('issue.updated.track'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('home')->with($data);
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

		$time = explode(':', $attributes['used_time']);
		$time = (int) ($time[0] * 60) + $time[1];
		$extra_minutes = intval(15 - $time % 15);
		if ($extra_minutes > 0 && $extra_minutes < 15)
		{
			$time = $time + $extra_minutes;
		}
		$attributes['used_time'] = $time;

        $track = Track::create($attributes);

		if ($request->file('document'))
		{
			$docName = $track->id . '.' . $request->file('document')->getClientOriginalExtension();
			$request->file('document')->move(base_path() . '/public/docs/', $docName);

        	$track = Track::where('id', $track->id)->first();

			if(is_null($track)) {
				abort(404);
			}
			$attributes['attachment'] = $docName;

	        $track->update($attributes);
		}

        $data = [
            'message' => __('issue.create.track'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('home')->with($data);
    }

    /**
     * Download attachment.
     *
     * @param string  $id
     * @return \Illuminate\Http\Response
     */
	public function getDownload($id)
	{
		return response()->download(public_path('docs/' . $id));
	}
}
