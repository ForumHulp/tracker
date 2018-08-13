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
		Issue::rebuild();

        $data = [
            'issues'	=> Issue::with('project.client', 'status', 'type', 'project', 'user', 'tracks')->orderBy('lft')->paginate(10),
        ];

        return view('pages.home')->with($data);
    }
}
