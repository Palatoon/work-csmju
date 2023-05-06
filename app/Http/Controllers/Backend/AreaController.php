<?php

namespace App\Http\Controllers\Backend;

use Image;
use App\Area;
use App\Device;
use App\Building;
use App\DeviceTypeStatus;
use App\permission;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller as Controller;


class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $areas = Area::all();
        return view('backend.area.index', [
            'areas' => $areas
        ]);
    }

    /**
     * Display a floor plan of area.
     *
     * @return \Illuminate\Http\Response
     */
    public function floor_plan(Request $request)
    {
        $area = [];
        $devices = [];
        $rooms = [];
        $area = Area::find($request->id);
        $area_items = Device::where('area_id', $request->id)->get();
        foreach ($area_items as $key => $value) {
            $devices[] = $value;
        }

        $rooms = Room::where('area_id', $request->id)->get();
        foreach ($rooms as $key => $value) {
            $room_items = Device::where('room_id', $value->id)->get();
            foreach ($room_items as $key2 => $value2) {
                $value2->image = DeviceTypeStatus::where('device_type_id', $value2->device_type_id)
                    ->where('name', 'Offline')->first()->status_image ?? NULL;
                // $devices[] = $value2;
            }
        }
        //dd($devices);
        return view('backend.area.floor-plan', [
            'area' => $area,
            'devices' => $devices,
            'rooms' => $rooms,
        ]);
    }

    /**
     * Display a listing of booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function booking(Request $request)
    {
        $items = [];
        $areas = Area::where('building_id', $request->id)->get();
        foreach ($areas as $key => $value) {
            $items[$key] = $value;
            $items[$key]->room = Room::where('area_id', $value->id)->get();
        }
        return view('backend.area.booking', [
            'areas' => $items,
            'building' => Building::find($request->id)
        ]);
    }

    /**
     * Display a listing of device.
     *
     * @return \Illuminate\Http\Response
     */
    public function device(Request $request)
    {
        return view('backend.device.index', [
            'data' => Device::where('area_id', $request->id)->get(),
            'model' => Area::find($request->id),
            'type' => 'area'
        ]);
    }

    /**
     * Display a listing of permission.
     *
     * @return \Illuminate\Http\Response
     */
    public function permission(Request $request)
    {
        return view('backend.permission.index', [
            'data' => Permission::where('area_id', $request->id)->where('deleted', false)->get(),
            'model' => Area::find($request->id),
            'type' => 'area'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.area.form', [
            'action' => 'create',
            'buildings' => Building::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->has('id')) {
            $item = Area::find($request->id);
            if ($request->has('floor_plan_image') && Storage::disk('local')->exists($item->floor_plan_image)) {
                Storage::disk('local')->delete($item->floor_plan_image);
            }
            $item->update($request->all());

            $notification = array(
                'message' => 'The data was updated successfully.',
                'alert-type' => 'success'
            );
        } else {
            $request->merge([
                'created_by' => session()->user()->id
            ]);
            $item = Area::create($request->all());

            $notification = array(
                'message' => 'The data was created successfully.',
                'alert-type' => 'success'
            );
        }
        if ($item && $request->has('floor_plan_image') && !is_null($request->floor_plan_image)) {
            if (!Storage::disk('local')->has('floor_plan_image')) {
                Storage::disk('local')->makeDirectory('img/floor_plan');
            }
            $file_name = 'area_' . $item->id . '.' . $request->file('floor_plan_image')->getClientOriginalExtension();
            $path = 'public/img/floor_plan/' . $file_name;
            Storage::disk('local')->put($path, file_get_contents($request->file('floor_plan_image')));
            $item->floor_plan_image = $path;
            $item->update();
        }
        return redirect('backend/area')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        return view('backend.area.form', [
            'action' => 'edit',
            'area' => Area::find($area->id),
            'buildings' => Building::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
    }

    public function delete(Request $request)
    {
        $area = Area::find($request->id);
        if (Storage::disk('local')->exists($area->floor_plan_image)) {
            Storage::disk('local')->delete($area->floor_plan_image);
        }
        $device = Device::where('area_id', $area->id)->get();
        Permission::where('area_id', $area->id)->delete();
        if (count($device) > 0) {
            foreach ($device as $value) {
                DB::delete("delete from conditions where device = '" . $value->id . "'");
            }
            Device::where('area_id', $area->id)->delete();
        }

        if ($area->delete()) {
            $notification = array(
                'message' => 'The data was deleted successfully.',
                'type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'The data was delete failed.',
                'type' => 'error'
            );
        }

        return response()->json($notification);
    }

    public function item_position(Request $request)
    {
        switch ($request->item_type) {
            case 'area':
                $area = Area::find($request->item_id);
                $area->x = $request->x;
                $area->y = $request->y;
                $area->save();
                break;

            case 'device':
                $device = Device::find($request->item_id);
                $device->x = $request->x;
                $device->y = $request->y;
                $device->save();
                break;

            case 'room':
                $room = Room::find($request->item_id);
                $room->x = $request->x;
                $room->y = $request->y;
                $room->save();
                break;
        }

        return response()->json(true);
    }
}
