<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
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
            'types' => Type::all(),
        ];

        return view('dashboard/type/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('dashboard/type/create');
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
            'title' => 'required',
        ]);

        $attributes = $request->all();

        Type::create($attributes);

        $data = [
            'message' => __('type.create'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('status.index')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $type = Type::where('id', $id)->first();

        if(is_null($type)) {
            abort(404);
        }

        $data = [
            'type' => $type,
        ];

        return view('dashboard/type/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, Type $type)
    {
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required',
        ]);

        $type = Type::where('id', $request->get('id'))->first();

        if(is_null($type)) {
            abort(404);
        }

        $attributes = $request->all();

        $type->update($attributes);

        $data = [
            'message' => __('type.update'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('status.index')->with($data);
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

        $type = Type::where('id', $request->get('id'))->first();

        if(is_null($type)) {
            abort(404);
        }

        $type->delete();

        $data = [
            'message' => __('type.destroy'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('status.index')->with($data);
    }
}
