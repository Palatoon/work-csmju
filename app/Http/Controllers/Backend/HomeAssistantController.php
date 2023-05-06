<?php

namespace App\Http\Controllers\Backend;

use App\HomeAssistant;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Device;
use App\Room;

class HomeAssistantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = HomeAssistant::all();
        return view('backend.home_assistant.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.home_assistant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if(request()->has('id')){
            $dd = HomeAssistant::find($request->id);
            $dd->name = $request->name;
            $dd->ip = $request->ip;
            $dd->port = $request->port;
            $dd->token = $request->token;
            $dd->save();
            $notification = array(
                'message' => 'Updated successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('home-assistant.index')->with($notification);
        }else{
            $dd = new HomeAssistant();
            $dd->name = $request->name;
            $dd->ip = $request->ip;
            $dd->port = $request->port;
            $dd->created_by = Auth::user()->id;
            $dd->token = $request->token;
            $dd->save();
            $notification = array(
                'message' => 'Created successfully!',
                'alert-type' => 'success'
            );
            return redirect()->route('home-assistant.index')->with($notification);
        }
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
    public function edit($id)
    {
        //
        $dd = HomeAssistant::find($id);
        return view('backend.home_assistant.create', ['data' => $dd]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $dd = HomeAssistant::find($request->id);
        $dd->delete();
        return "true";
    }



    public function device(Request $request)
    {
        return view('backend.device.index', [
            'data' => Device::where('home_assistant_id', $request->id)->get(),
            'model' => HomeAssistant::find($request->id),
            'type' => 'homeassistant'
        ]);
    }
}
