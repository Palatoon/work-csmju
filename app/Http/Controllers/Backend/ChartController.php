<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as Controller;
use App\Chart;
use App\ChartDevice;
use App\ChartType;
use App\Device;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.chart.index', [
            'chart' => Chart::where('user_id', auth()->user()->id)->get() ?? [],
            'chart_types' => ChartType::all(),
            'devices' => Device::all(),
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $chart = Chart::create([
            'name' => $request->name,
            'chart_type_id' => $request->chart_type_id,
            'user_id' => auth()->user()->id
        ]);
        foreach ($request->device_id as $key => $value) {
            ChartDevice::create([
                'chart_id' => $chart->id,
                'device_id' => $request->device_id[$key],
                'datacode_id' => $request->datacode_id[$key]
            ]);
        }
        return redirect()->route('report.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function show(Chart $chart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function edit(Chart $chart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chart $chart)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chart  $chart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chart $chart)
    {
        //
    }
}
