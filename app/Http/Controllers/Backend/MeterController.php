<?php

namespace App\Http\Controllers\Backend;

use App\Area;
use App\Building;
use App\Configurations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Requests;
use App\Meter;
use App\Room;
use App\SensorList;
use App\UserLog;
use Illuminate\Support\Facades\Session;

class MeterController extends Controller
{
    public function dashboard()
    {
        $meter_datas = [];
        $price = [];
        $chart_data = [];
        $total = [];
        $hourly_usages = [];
        $sql = "with cteRowNumber as (
                select [SensorID] 
                  ,[ELECV1] 
                  ,[ELECV2] 
                  ,[ELECV3] 
                  ,[ELECI1] 
                  ,[ELECI2] 
                  ,[ELECI3] 
                  ,[ELECP1] 
                  ,[ELECP2] 
                  ,[ELECP3] 
                  ,[ELECU] 
                  ,[Timestamp]
                       ,row_number() over(partition by [SensorID] order by [Timestamp] desc) as RowNum
                    from vwPowerMeter3PhaseLogV2
            )
            SELECT SL.[SensorID]
                  ,SL.[Label]as label
                  ,SL.[building]as building
                  ,SL.[area]as area
                  ,SL.[room]as room
                  ,round(last.[ELECV1] ,2)as elecv1
                  ,round(last.[ELECV2] ,2)as elecv2
                  ,round(last.[ELECV3] ,2)as elecv3
                  ,round(last.[ELECI1] ,2)as eleci1
                  ,round(last.[ELECI2] ,2)as eleci2
                  ,round(last.[ELECI3] ,2)as eleci3
                  ,round(last.[ELECP1] ,2)as elecp1
                  ,round(last.[ELECP2] ,2)as elecp2
                  ,round(last.[ELECP3] ,2)as elecp3
                  ,(Max(log.[ELECU])-MIN(log.[ELECU])) as elecu
                  ,last.[Timestamp] as time
              FROM SensorLists SL
              left join(SELECT [SensorID] 
                  ,[ELECV1] 
                  ,[ELECV2] 
                  ,[ELECV3] 
                  ,[ELECI1] 
                  ,[ELECI2] 
                  ,[ELECI3] 
                  ,[ELECP1] 
                  ,[ELECP2] 
                  ,[ELECP3] 
                  ,[ELECU] 
                  ,[Timestamp] 
            FROM vwPowerMeter3PhaseLogV2
            where Timestamp between DATEADD(M,-1,GETDATE())  and GETDATE()) log
            on SL.SensorID=log.SensorID
            left join( select [SensorID] 
                  ,[ELECV1] 
                  ,[ELECV2] 
                  ,[ELECV3] 
                  ,[ELECI1] 
                  ,[ELECI2] 
                  ,[ELECI3] 
                  ,[ELECP1] 
                  ,[ELECP2] 
                  ,[ELECP3] 
                  ,[ELECU] 
                  ,[Timestamp]
                from cteRowNumber
                where RowNum = 1) last
                on SL.SensorID=last.SensorID
                where SL.active_license = 1
            group by SL.[SensorID],SL.[Label],SL.[building],SL.[area],SL.[room]
                  ,last.ELECV1
                  ,last.[ELECV2] 
                  ,last.[ELECV3] 
                  ,last.[ELECI1] 
                  ,last.[ELECI2] 
                  ,last.[ELECI3] 
                  ,last.[ELECP1] 
                  ,last.[ELECP2] 
                  ,last.[ELECP3]
                  ,last.[Timestamp]
            order by sl.SensorID";

        $meter_datas = []; //DB::select($sql);

        $price = Configurations::where('name', 'price')->first()->value;

        $sql = "SELECT top 60 [RowID]
              ,[SensorID]
              ,[DataCode]
              ,abs([Value]) as Value
              ,[Timestamp]
                FROM DataLog 
                where DataCode like 'ELECP%'
                order by Timestamp desc";
        $chart_data = []; //DB::select($sql);

        // $hourly_usage = DB::select("SELECT (sum([ELECP1]) + sum([ELECP2]) + sum([ELECP3])) as TotalkWh, datepart(hour,[Timestamp]) as Time
        //         FROM vwPowerMeter3PhaseLogV2 
        //         where Timestamp >= CAST(GETDATE() AS DATE)
        //         group by datepart(hour,[Timestamp]), 
        //         dateadd(d, 0, datediff(d, 0, [Timestamp]))");

        $hourly_usage = [];
        // $today_kW =  DB::select("SELECT (sum([ELECP1]) + sum([ELECP2]) + sum([ELECP3])) as TotalkWh
        // FROM vwPowerMeter3PhaseLogV2 
        // where Timestamp >= CAST(GETDATE() AS DATE)")[0];
        $today_kW = [];

        $total['kwh'] = null; //$today_kW->TotalkWh;

        $total['price'] = null; //$total['kwh'] * $price;

        // Return View
        return view('backend.meter.dashboard', [
            'meter_datas' => $meter_datas,
            'meters' => Meter::all(),
            'price' => $price,
            'chart_data' => $chart_data,
            'total' => $total,
            'hourly_usages' => $hourly_usages
        ]);
    }
    /**
     * Show Meter List
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sql = "select * from SensorLists";
        $sensor = DB::select($sql);
        // Return View
        return view('backend.meter.index', ['route' => Route::currentRouteName(), 'sensor' => $sensor]);
    }

    /**
     * Create New Meter
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request) {
            if ($request->has('id')) {
                if ($request->has('meter_image')) {
                    $pic = Meter::where('SensorID', $request->id)->first();
                    if (file_exists(public_path() . '/img/meter/' . $pic->Image)) {
                        File::delete(public_path() . '/img/meter/' . $pic->Image);
                    }

                    $file = $request->file('meter_image');
                    $picName = $file->getClientOriginalName();
                    $imagePath = 'img/meter';
                    $file->move(public_path($imagePath), $picName);
    

                    Meter::where('SensorID', $request->id)->update([
                        'Label' => $request->meter_name,
                        'TokenGuid' => $request->meter_guid,
                        'building' => $request->meter_building,
                        'area' => $request->meter_area,
                        'room' => $request->meter_room,
                        'Status' => $request->meter_status,
                        'Notify' => $request->meter_notify,
                        'active_license' => $request->meter_license,
                        'Image' => $picName
                    ]);

                } else {
                    Meter::where('SensorID', $request->id)->update([
                        'Label' => $request->meter_name,
                        'TokenGuid' => $request->meter_guid,
                        'building' => $request->meter_building,
                        'area' => $request->meter_area,
                        'room' => $request->meter_room,
                        'Status' => $request->meter_status,
                        'Notify' => $request->meter_notify,
                        'active_license' => $request->meter_license
                    ]);
                }
                $notification = array(
                    'message' => 'Created successfully!',
                    'alert-type' => 'success'
                );
            } else {
                $meter = new Meter();
                $meter->Label = $request->meter_name;
                $meter->TokenGuid = $request->meter_guid;
                $meter->building = $request->meter_building;
                $meter->area = $request->meter_area;
                $meter->room = $request->meter_room;
                $meter->Status = $request->meter_status;
                $meter->Notify = $request->meter_notify;
                $meter->active_license = $request->meter_license;
                if ($request->has('meter_image')) {
                    $file = $request->file('meter_image');
                    $picName = $file->getClientOriginalName();
                    $imagePath = 'img/meter';
                    $file->move(public_path($imagePath), $picName);
                    $meter->Image = $picName;
                }
                $meter->save();
                $notification = array(
                    'message' => 'Created successfully!',
                    'alert-type' => 'success'
                );
            }
        }
        // if ($request) {
        //     $select = "select max(SensorID) as SensorID from SensorLists";
        //     $meter = DB::select($select);
        //     $name = $request->input('name');
        //     $location = $request->input('location');
        //     $floor = $request->input('floor');
        //     $room = $request->input('room');
        //     $create = "insert into SensorLists 
        //            values (" . ($meter[0]->SensorID + 1) . ", '" . $name . "', '', '" . $location . "', '', '" . $floor . "','" . $room . "')";
        //     DB::statement($create);
        // }

        // Return View
        return redirect()->route('meter.dashboard')->with($notification);
    }

    /**
     * Edit Meter
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        // Return View
        return view('backend.meter.form', [
            'action' => 'edit',
            'buildings' => Building::all(),
            'areas' => Area::all(),
            'rooms' => Room::all(),
            'data' => Meter::where('SensorID', $id)->first()
        ]);
    }

    /**
     * Delete Meter
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if($id){
            $pic = Meter::where('SensorID', $id)->first();
            if (file_exists(public_path() . '/img/meter/' . $pic->Image)) {
                File::delete(public_path() . '/img/meter/' . $pic->Image);
            }
            Meter::where('SensorID', $id)->delete();
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'failed']);
        }
        // Return View
        return view('backend.meter.index');
    }

    public function updateLicenseStatus(Request $request)
    {

        $active = SensorList::where('active_license', true)->get()->count();
        if ($request->active_license == "false") {
            $active--;
        }
        if ($active >= Session::get('meter_activate_limit')) {
            return response()->json(999);
        }

        $meter = SensorList::where('SensorID', $request->id)->first();
        $meter->active_license = $request->active_license == "true" ? true : false;
        $update = "update SensorLists set active_license='" . $meter->active_license . "' where SensorID = '" . $meter->SensorID . "'";

        if (DB::statement($update)) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function updateLoopTime(Request $request)
    {
        $update = "update SensorLists set Loop_Time ='" . $request->Loop_Time . "' where SensorID = '" . $request->SensorID . "'";

        if (DB::statement($update)) {
            UserLog::create([
                'userid' => Session::get('uid'),
                'action' => 'update loop time on sensor ' . $request->SensorID,
                'ip' => \Request::ip()
            ]);
            $notification = array(
                'message' => 'Updated successfully.',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'Update failed.',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }





    public function add()
    {

        return view('backend.meter.form', [
            'action' => 'add',
            'buildings' => Building::all(),
            'areas' => Area::all(),
            'rooms' => Room::all()
        ]);
    }
}
