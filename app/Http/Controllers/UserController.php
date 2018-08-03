<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;

class UserController extends Controller
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
            'users' => User::all(),
        ];

        return view('dashboard/user/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
		$role = Role::select('id', 'name')->get();
		$roles = [];
		foreach($role as $data)
		{
			$roles[$data->id] = $data->name;
		}

        $data = [
			'roleList'	=> $roles,
			'selected'	=> 1
       ];

        return view('dashboard/user/create')->with($data);
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
            'name'			=> 'required',
            'email'			=> 'required',
            'password'		=> 'required',
        ]);

        $attributes = $request->all();
		
        $user = User::create($attributes);

		$role = $request->get('role');
	    $user->roles()->attach($role);

        return redirect()->route('user.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $user = User::where('id', $id)->first();

        if(is_null($user)) {
            abort(404);
        }
		
		$role = Role::select('id', 'name')->get();
		foreach($role as $data)
		{
			$roles[$data->id] = $data->name;
		}

        $data = [
            'user' 		=> $user,
			'roleList'	=> $roles,
			'selected'	=> $user->roles->first()->id
       ];

        return view('dashboard/user/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, User $user)
    {
        $this->validate($request, [
            'id' 			=> 'required',
            'name'			=> 'required',
            'email'			=> 'required',
            'role' 			=> 'required',
        ]);

        $user = User::where('id', $request->get('id'))->first();

        if(is_null($user)) {
            abort(404);
        }

        $attributes = $request->all();
		
		if (empty($request->get('password', '')))
		{
			$attributes = $request->except('password');
		} else
		{
			$attributes['password'] = bcrypt($attributes['password']);
		}

        $user->update($attributes);
		
		$role = $request->get('role');
		$user->roles()->detach();
	    $user->roles()->attach($role);

        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function postDestroy(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $user = User::where('id', $request->get('id'))->first();

        if(is_null($user)) {
            abort(404);
        }

        $user->delete();
		$user->roles()->detach();

        return redirect()->route('user.index');
    }
}
