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
     * Show the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'issues' => Issue::with('project.client', 'status', 'type', 'project', 'user', 'tracks', 'order')->orderBy('lft')->paginate(20),
        ];

        return view('pages.home')->with($data);
    }
}
