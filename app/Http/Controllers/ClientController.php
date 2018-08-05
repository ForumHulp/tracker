<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
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
            'clients' => Client::all(),
        ];

        return view('dashboard/client/index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('dashboard/client/create');
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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        $attributes = $request->all();


        $data = [
            'message' => __('client.create'),
            'alert-class' => 'alert-success',
        ];


        Client::create($attributes);

        return redirect()->route('client.index')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $client = Client::where('id', $id)->first();

        if(is_null($client)) {
            abort(404);
        }

        $data = [
            'client' => $client,
        ];

        return view('dashboard/client/edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, Client $client)
    {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
        ]);

        $client = Client::where('id', $request->get('id'))->first();

        if(is_null($client)) {
            abort(404);
        }

        $attributes = $request->all();

        $client->update($attributes);


        Client::create($attributes);

        $data = [
            'message' => __('client.update'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('client.index')->with($data);
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

        $client = Client::where('id', $request->get('id'))->first();

        if(is_null($client)) {
            abort(404);
        }

        $client->delete();
        $data = [
            'message' => __('client.destroy'),
            'alert-class' => 'alert-success',
        ];
        return redirect()->route('client.index')->with($data);
    }
}
