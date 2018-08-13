<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;

class PlanController extends Controller
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
    public function getIndex()
    {
        $projects = Issue::with('user')
				->selectRaw('start_date as start, start_date + INTERVAL plan_time MINUTE as end, title as label')
			//	->where('status_id', '!=', 3)
				->orderBy('lft')->get();

		$gantt = new \Swatkins\LaravelGantt\Gantt($projects, array(
			'title'      => 'Planning',
			'cellwidth'  => 25,
			'cellheight' => 35
		));
		
		return view('includes.gantt')->with([ 'gantt' => $gantt ]);
    }
}
