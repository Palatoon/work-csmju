<?php

namespace App\Http\Controllers\Backend;

use App\DeviceTypeStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller as Controller;

class DeviceTypeStatusController extends Controller
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
            $item = DeviceTypeStatus::find($request->id);
            if ($request->has('status_image') && Storage::disk('local')->exists($item->status_image)) {
                Storage::disk('local')->delete($item->status_image);
            }
            $item->update($request->all());

            $notification = array(
                'message' => 'The data was updated successfully.',
                'alert-type' => 'success'
            );
        } else {
            $item = DeviceTypeStatus::create($request->all());

            $notification = array(
                'message' => 'The data was created successfully.',
                'alert-type' => 'success'
            );
        }
        if ($item && $request->has('status_image') && !is_null($request->status_image)) {
            $file = Storage::disk('local')->put('public/img/type_status', $request->status_image, 'public');
            $item->status_image = $file;
            $item->save();
        }

        return redirect()->back()->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DeviceTypeStatus  $deviceTypeStatus
     * @return \Illuminate\Http\Response
     */
    public function show(DeviceTypeStatus $deviceTypeStatus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DeviceTypeStatus  $deviceTypeStatus
     * @return \Illuminate\Http\Response
     */
    public function edit(DeviceTypeStatus $deviceTypeStatus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DeviceTypeStatus  $deviceTypeStatus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeviceTypeStatus $deviceTypeStatus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DeviceTypeStatus  $deviceTypeStatus
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeviceTypeStatus $deviceTypeStatus)
    {
        //
    }

    public function delete(Request $request)
    {
        $item = DeviceTypeStatus::find($request->id);
        if (Storage::disk('local')->exists($item->status_image)) {
            Storage::disk('local')->delete($item->status_image);
        }
        if ($item->delete()) {
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
}
