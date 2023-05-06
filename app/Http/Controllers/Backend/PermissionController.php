<?php

namespace App\Http\Controllers\Backend;

use App\DeviceType;
use App\Http\Controllers\Controller as Controller;

use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $dd = DeviceType::all();
        return view('backend.permission.create', ['device' => $dd]);
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
            'disting' => 'required',
        ]);
        switch ($request->type) {
            case "building": {
                    $aa = new Permission();
                    $aa->template_id = 1;
                    $aa->name = $request->name;
                    $aa->type = "Access Control";
                    $aa->address = $request->disting;
                    $aa->hours = (int)$request->hours;
                    $aa->building_id = $request->fkid;
                    $aa->save();
                }
                break;
            case "area": {
                    $aa = new Permission();
                    $aa->template_id = 1;
                    $aa->name = $request->name;
                    $aa->type = "Access Control";
                    $aa->address = $request->disting;
                    $aa->hours = (int)$request->hours;
                    $aa->area_id = $request->fkid;
                    $aa->save();
                }
                break;
            case "room": {
                    $aa = new Permission();
                    $aa->template_id = 1;
                    $aa->name = $request->name;
                    $aa->type = "Access Control";
                    $aa->address = $request->disting;
                    $aa->hours = (int)$request->hours;
                    $aa->room_id = $request->fkid;
                    $aa->save();
                }
                break;
        }

        $notification = array(
            'message' => 'Created successfully!',
            'alert-type' => 'success'
        );

        return redirect('backend/'.$request->type.'/' . $request->fkid . '/permission?id='.$request->fkid.'&type='.$request->type)->with($notification);
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
    // public function destroy($id)
    // {
    //     //
    //     $aa = Permission::find($id);
    //     $type = $aa->type;
    //     switch ($type) {
    //         case 'building':
    //             $bid = $aa->building_id;
    //             break;
    //         case 'room':
    //             $bid = $aa->room_id;
    //             break;
    //         case 'camera':
    //             $bid = $aa->camera_id;
    //             break;
    //     }
    //     $aa->deleted = true;
    //     $aa->save();

    //     $notification = array(
    //         'message' => 'Delete successfully!',
    //         'alert-type' => 'success'
    //     );

    //     return redirect('backend/permission/' . $bid . '/' . $type)->with($notification);
    // }



    public function destroy(Request $request)
    {
        if (request()->has('id')) {
            $r = Permission::find($request->id);
            $r->delete();
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }


    public function showbuild($id)
    {

        $aa = Permission::where('building_id', $id)->where('deleted', false)->get();
        return view('backend.permission.index', ['id' => $id, 'data' => $aa, 'type' => 'building']);
    }

    public function showroom($id)
    {
        $aa = Permission::where('room_id', $id)->where('deleted', false)->get();
        return view('backend.permission.index', ['id' => $id, 'data' => $aa, 'type' => 'room']);
    }


    public function showcamera($id)
    {
        $aa = Permission::where('camera_id', $id)->where('deleted', false)->get();
        return view('backend.permission.index', ['id' => $id, 'data' => $aa, 'type' => 'camera']);
    }
}
