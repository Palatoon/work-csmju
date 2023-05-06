<?php

namespace App\Http\Controllers\Backend;

use App\Commands;
use App\Datacode;
use App\DeviceType;
use App\DeviceTypeDatacode;
use App\DeviceTypeStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller as Controller;

class DeviceTypeController extends Controller
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
        $devicetypes = DeviceType::all();
        foreach ($devicetypes as $key => $value) {
            $items = DeviceTypeStatus::where('device_type_id', $value->id)->get(['id', 'name', 'icon', 'icon_color', 'image']);
            $value->status =  $items;
            $list = DeviceTypeDatacode::where('device_type_id', $value->id)->get();
            $code = [];
            foreach ($list as $v) {
                $code[] = Datacode::find($v->datacode_id);
            }
            $value->code  = $code;
        }
        //dd($devicetypes);
        return view('backend.device_type.index', [
            'datacodes' => Datacode::all(),
            'devicetypes' => $devicetypes
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
        return view('backend.device_type.create');
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
            $dv = DeviceType::find($request->id);
            $dv->name = $request->name;
            $dv->name_en = $request->name_en;
            $dv->description = $request->des;
            $dv->save();
            $notification = array(
                'message' => 'The data was updated successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('device-type.index')->with($notification);
        } else {
            $dv = new DeviceType();
            $dv->name = $request->name;
            $dv->name_en = $request->name_en;
            $dv->description = $request->des;
            $dv->is_default = true;
            $dv->created_by = Auth::user()->id;
            $dv->save();

            $notification = array(
                'message' => 'The data was created successfully.',
                'alert-type' => 'success'
            );
            return redirect()->route('device-type.index')->with($notification);
        }

        // if ($request->has('id')) {
        //     $item = DeviceTypeStatus::find($request->id);
        //     if ($request->has('status_image') && Storage::disk('local')->exists($item->status_image)) {
        //         Storage::disk('local')->delete($item->status_image);
        //     }
        //     $item->update($request->all());

        //     $notification = array(
        //         'message' => 'The data was updated successfully.',
        //         'alert-type' => 'success'
        //     );
        // } else {
        //     $item = DeviceTypeStatus::create($request->all());

        //     $notification = array(
        //         'message' => 'The data was created successfully.',
        //         'alert-type' => 'success'
        //     );
        // }
        // if ($item && $request->has('status_image') && !is_null($request->status_image)) {
        //     // $path = storage_path() . '\app\public\img\type_status\\';
        //     // File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        //     $file = Storage::disk('local')->put('public/img/type_status', $request->status_image, 'public');
        //     $item->status_image = $file;
        //     $item->save();
        // }

        // return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeviceType  $deviceType
     * @return \Illuminate\Http\Response
     */
    public function show(DeviceType $deviceType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeviceType  $deviceType
     * @return \Illuminate\Http\Response
     */
    public function edit(DeviceType $deviceType)
    {
        //
        return view('backend.device_type.create', ['device' => $deviceType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeviceType  $deviceType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeviceType $deviceType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeviceType  $deviceType
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeviceType $deviceType)
    {
        //
    }



    public function command($id)
    {
        $data = Commands::where('device_type_id', $id)->get();
        return view('backend.device_type.command', ['id' => $id, 'data' => $data]);
    }


    public function commandstore(Request $request)
    {
        for ($i = 0; $i < count($request->editid); $i++) {
            if ($request->editid[$i] == null) {
                $dd = new Commands();
                $dd->device_type_id = $request->id;
                $dd->command_name = $request->name[$i];
                $dd->command_value = $request->value[$i];
                $dd->save();
            } else {
                $dd = Commands::find($request->editid[$i]);
                $dd->command_name = $request->name[$i];
                $dd->command_value = $request->value[$i];
                $dd->save();
            }
        }

        $notification = array(
            'message' => 'Process successfully.',
            'alert-type' => 'success'
        );
        return redirect('/backend/device-type')->with($notification);
    }



    public function commanddelete(Request $request)
    {

        $dd = Commands::find($request->id);
        $dd->delete();
        return "true";
    }

    public function datacode(Request $request)
    {
        return response()->json(1);
    }

    public function datacode_store(Request $request)
    {
        //return response()->json($request->all());
        $list = DeviceTypeDatacode::where('device_type_id', $request->device_type_id)->get();
        if(is_null($request->datacode_list)){
            $arr = [];
        }
        else {
            $arr = $request->datacode_list;
        }

        foreach ($list as $value) {
            if (!in_array($value->id, $arr)) {
                $item = DeviceTypeDatacode::where('device_type_id', $request->device_type_id)->where('datacode_id', $value->datacode_id)->first();
                $item->delete();
            }
        }
        if (count($arr) > 0) {
            foreach ($arr as $value) {
                $item = DeviceTypeDatacode::where('device_type_id', $request->device_type_id)->where('datacode_id', $value)->first();
                if (!$item) {
                    DeviceTypeDatacode::create([
                        'device_type_id' => $request->device_type_id,
                        'datacode_id' => $value
                    ]);
                }
            }
        }

        return response()->json(true);
    }
}
