<?php

namespace App\Http\Controllers\Backend;

use App\Group;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $aa = Group::all();
        return view('backend.group.index', ['data' => $aa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.group.create');
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
        $this->validate($request, [
            'name' => 'required',
            'sid' => 'required',
            'disting' => 'required',
            'hours' => 'required',
        ]);

        $aa = new Group();
        $aa->group_id = $request->sid;
        $aa->name = $request->name;
        $aa->ou = $request->disting;
        $aa->hour = $request->hours;
        $aa->save();

        $notification = array(
            'message' => 'Created successfully!',
            'alert-type' => 'success'
        );
        return redirect('backend/group')->with($notification);

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
        $aa = Group::find($id);
        return view('backend.group.edit', ['item' => $aa]);
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
        $this->validate($request, [
            'name' => 'required',
            'hours' => 'required',
        ]);

        $aa = Group::find($id);
        $aa->name = $request->name;
        $aa->hour = $request->hours;
        $aa->save();

        $notification = array(
            'message' => 'Edit successfully!',
            'alert-type' => 'success'
        );
        return redirect('backend/group')->with($notification);

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
        $aa = Group::find($id);
        $aa->delete();
        $notification = array(
            'message' => 'Delete group successfully!',
            'alert-type' => 'success'
        );
        return redirect('backend/group')->with($notification);
    }
}
