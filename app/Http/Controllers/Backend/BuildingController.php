<?php 

namespace App\Http\Controllers\Backend;

use App\Area;
use App\Building;
use App\Device;
use App\permission;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller as Controller;

class BuildingController extends Controller
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
    public function index(Request $request)
    {
        $farms = Building::all();
        return view('backend.building.index', [
            'buildings' => $farms
        ]);
    }

    public function floor_plan(Request $request)
    {
        $areas = [];
        $areas = Area::where('building_id', $request->id)->get();
        return view('backend.building.floor-plan', [
            'building' => Building::find($request->id),
            'areas' => $areas,
        ]);
    }

    public function room(Request $request)
    {
        $farm = Building::find($request->route('id'));
        return view('backend.building.room', [
            'building' => $farm
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
            'data' => Device::where('building_id', $request->id)->get(),
            'model' => Building::find($request->id),
            'type' => 'building'
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
            'data' => Permission::where('building_id', $request->id)->where('deleted', false)->get(),
            'model' => Building::find($request->id),
            'type' => 'building'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.building.form', [
            'action' => 'create'
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
            $item = Building::find($request->id);
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
            $item = Building::create($request->all());

            $notification = array(
                'message' => 'The data was created successfully.',
                'alert-type' => 'success'
            );
        }
        if ($item && $request->has('floor_plan_image') && !is_null($request->floor_plan_image)) {
            if (!Storage::disk('local')->has('floor_plan_image')) {
                Storage::disk('local')->makeDirectory('img/floor_plan');
            }
            $file_name = 'farm_' . $item->id . '.' . $request->file('floor_plan_image')->getClientOriginalExtension();
            $path = 'public/img/floor_plan/' . $file_name;
            Storage::disk('local')->put($path, file_get_contents($request->file('floor_plan_image')));
            $item->floor_plan_image = $path;
            $item->update();
        }

        $notification = array(
            'message' => 'Create building successfully!', 
            'alert-type' => 'success'
        );
        return redirect()->route('farm.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Building  $farm
     * @return \Illuminate\Http\Response
     */
    public function show(Building $farm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Building  $farm
     * @return \Illuminate\Http\Response
     */
    public function edit(Building $farm)
    {
        $farm = Building::where('id', $farm->id)->first();
        return view('backend.building.form', [
            'action' => 'edit',
            'building' => $farm
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $farm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $farm)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $farm = Building::where('id', $request->id)->first();
        $farms = $farm->update($request->all());
        $notification = array(
            'message' => 'Edit building successfully!', 
            'alert-type' => 'success'
        );
        return redirect()->route('farm.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $farm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $farm)
    {
        //
    }

    public function reject(Request $request, Building $farm)
    {
        $del = Building::where('id', $request->id)->first();
        $del->delete();
        return redirect()->route('farm.index');
    }

}
