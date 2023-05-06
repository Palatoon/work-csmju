<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller as Controller;

use App\Chart;
use App\ChartDevice;
use App\ChartType;
use App\Datacode;
use App\Device;
use App\DeviceDatacodeCondition;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.report.index', [
            'chart' => Chart::where('user_id', auth()->user()->id)->get() ?? [],
            'chart_types' => ChartType::all(),
            'devices' => Device::all()
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
    public function destroy($id)
    {
        //
    }

    public function getChartData(Request $request)
    {
        $data = [];
        $label = [];
        $color = [];
        $series = [];
        $condition = [];
        $type = Chart::find($request->id)->chart_type_id;
        $chart = ChartDevice::where('chart_id', $request->id)->get();
        $today = date('d-m-Y');
        $i = 0;
        foreach ($chart as $key => $value) {
            if ($type == 3) {
                $data[$i] = rand(10, 100);
                $label[$i] = Device::find($value->device_id)->name . " [" . Datacode::find($value->datacode_id)->DataLabel . "]";
            } else {
                for ($j = 0; $j < 10; $j++) {
                    $data[$i][$j] = rand(10, 100);
                    $label[$i][$j] = date('d-m-Y', strtotime($today . "-" .  ($j + 1) . " days"));
                }
                $series[$i] = Device::find($value->device_id)->name . " [" . Datacode::find($value->datacode_id)->DataLabel . "]";
            }
            $color[$i] = $this->rand_color();
            $condition[$i] = [];
            $cons = DeviceDatacodeCondition::where('device_id', $value->device_id)->where('datacode_id', $value->datacode_id)->get();
            foreach ($cons as $key2 => $value2) {
                $value2->label = Device::find($value->device_id)->name . " [" . Datacode::find($value->datacode_id)->DataLabel . "]";
                $condition[$i][] = $value2;
            }
            $i++;
        }

        $result = (object) [
            'data' => $data,
            'label' => $label,
            'color' => $color,
            'series' => $series,
            'condition' => $condition,
        ];
        return response()->json($result);
    }

    function rand_color()
    {
        return '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
