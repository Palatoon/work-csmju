<?php

namespace App\Http\Controllers\Backend;

use App\RoomType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller as Controller;

class RoomTypeController extends Controller
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
        $house_types = RoomType::all();
        return view('backend.room_type.index', [
            'roomtypes' => $house_types
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.room_type.form');
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
        $house_type = $request->all();
        $house_type['created_by'] = $username;
        $house_types = RoomType::create($house_type);
        $notification = array(
            'message' => 'Created room type successfully!',
            'alert-type' => 'success'
        );
        return redirect('backend/room-type')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RoomType  $house_type
     * @return \Illuminate\Http\Response
     */
    public function show(RoomType $house_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RoomType  $house_type
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $house_type)
    {
        $edit = RoomType::where('id', $house_type->id)->first();
        return view('backend.room_type.form', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RoomType  $house_type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoomType $house_type)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $house_types = RoomType::where('id', $request->id)->first();
        $house_types = $house_types->update($request->all());
        $notification = array(
            'message' => 'Edit room type successfully!',
            'alert-type' => 'success'
        );
        return redirect('backend/room-type')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RoomType  $house_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(RoomType $house_type)
    {
        //
    }

    public function reject(Request $request, RoomType $house_type)
    {
        $del = RoomType::where('id', $request->id)->first();
        $del->delete();
        return redirect('backend/room-type');
    }
}
