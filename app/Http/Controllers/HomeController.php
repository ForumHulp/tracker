<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Issue;

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
	//	Issue::rebuild();
        $data = [
            'issues'	=> Issue::with('project.client', 'status', 'type', 'project', 'user', 'tracks')->where('parent_id', null)->orderBy('lft')->paginate(20),
            'subissues'	=> Issue::with('project.client', 'status', 'type', 'project', 'user', 'tracks')->whereNotNull('parent_id')->orderBy('lft')->paginate(20),
        ];

        return view('pages.home')->with($data);
    }
}
