<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as Controller;
use App\DatacodeCondition;
use Illuminate\Http\Request;

class DatacodeConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        //dd($request->all());
        $checker = DatacodeCondition::where('datacode_id', $request->datacode_id)->first();
        // /dd($checker);
        if (!$checker) {
            DatacodeCondition::create([
                'datacode_id' => $request->datacode_id,
                'condition' => $request->condition,
                'value' => $request->value
            ]);

            if (\Config::get('app.locale') == 'en') {
                $notification = array(
                    'message' => 'Created condition successfully!',
                    'alert-type' => 'success'
                );
            } else {
                $notification = array(
                    'message' => 'สร้างเงื่อนไขเรียบร้อยแล้ว!',
                    'alert-type' => 'success'
                );
            }
        } else {
            $checker->update($request->all());

            if (\Config::get('app.locale') == 'en') {
                $notification = array(
                    'message' => 'Updated condition successfully!',
                    'alert-type' => 'success'
                );
            } else {
                $notification = array(
                    'message' => 'อัพเดทเงื่อนไขเรียบร้อยแล้ว!',
                    'alert-type' => 'success'
                );
            }
        }
        return redirect()->route('datacode.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DatacodeCondition  $datacodeCondition
     * @return \Illuminate\Http\Response
     */
    public function show(DatacodeCondition $datacodeCondition)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DatacodeCondition  $datacodeCondition
     * @return \Illuminate\Http\Response
     */
    public function edit(DatacodeCondition $datacodeCondition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DatacodeCondition  $datacodeCondition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DatacodeCondition $datacodeCondition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DatacodeCondition  $datacodeCondition
     * @return \Illuminate\Http\Response
     */
    public function destroy(DatacodeCondition $datacodeCondition)
    {
        //
    }
}
