<?php

namespace App\Http\Controllers\Backend;

use App\User;
use App\Configurations;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class ConfigurationController extends Controller
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
    public function index()
    {
        return view('backend.configuration.index', [
            'data' => Configurations::where('type' , '!=' , 'power-meter')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        dd(11);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $username = $request->session()->get('username');
        $username = User::where('username', $username)->first();
        $username = $username['id'];
        $config = $request->all();
        $config['created_by'] = $username;
        $configs = Configurations::create($config);
        $notification = array(
            'message' => 'Created configuration successfully!',
            'alert-type' => 'success'
        );
        return redirect('backend/configuration')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Configurations $configuration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Configurations $configurations)
    {
        // $this->validate($request, [
        //     'name' => 'required',
        // ]);
        $configurations = Configurations::where('id', $request->id)->first();
        $configurations = $configurations->update($request->all());
        $notification = array(
            'message' => 'Edit configurations type successfully!',
            'alert-type' => 'success'
        );
        return redirect('backend/configuration')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function reject(Request $request, Configurations $configuration)
    {
        $del = Configurations::where('id', $request->id)->first();
        $del->delete();
        return redirect('backend/configuration');
    }



   
}
