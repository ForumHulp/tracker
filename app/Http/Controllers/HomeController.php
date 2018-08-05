<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;
use App\Timeslot;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    //    $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		Issue::rebuild();
		
		$timeslots = Timeslot::select('id', 'time_amount')->get();
		foreach($timeslots as $value) {
			$timeslot[$value->id] = $value->time_amount;
		}
		
		
        $data = [
            'issues'	=> Issue::with('projects.clients', 'statuses', 'types', 'projects', 'users', 'tracks')->get(),
			'timeslot'	=> $timeslot
        ];

        return view('pages.home')->with($data);

    }
}
