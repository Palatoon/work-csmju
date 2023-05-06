<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Meter;
use App\Model\User;


class HistoricalController extends Controller
{
    /**
     * Show Recently
     *
     * @return \Illuminate\Http\Response
     */
    public function recently(Request $request)
    {
        $dt = date('Y-m-d H:i:s');
        $pevious = date('Y-m-d H:i:s', strtotime("-6 hours"));
        $sslist = Meter::all();

        if ($request->sltSenSor == null) {
            $sql = "SELECT SensorID, DataCode, round(abs([Value]),2) as Value, [Timestamp] 
            FROM History_15Minute 
            where [Timestamp] between '$pevious' and '$dt' and SensorID = '1'";

            $sensor = DB::select($sql);
            $filter = 1;
        } else {
            $sql = "SELECT SensorID, DataCode, round(abs([Value]),2) as Value, [Timestamp] 
            FROM History_15Minute 
            where [Timestamp] between '$pevious' and '$dt' and SensorID = '$request->sltSenSor'";

            $sensor = DB::select($sql);
            $filter = $request->sltSenSor;
        }

        return view('backend.historical.recently', [
            'route' => Route::currentRouteName(),
            'sensor' => $sensor,
            'sslist' => $sslist,
            'filter' => $filter
        ]);
    }

    /**
     * Show Hour
     *
     * @return \Illuminate\Http\Response
     */
    public function hour(Request $request)
    {
        $dt = date('Y-m-d H:00:00');
        $pevious = date('Y-m-d H:00:00', strtotime("-1 day "));
        $sslist = Meter::all();

        if ($request->sltSenSor == null) {
            $sql = "SELECT SensorID , DataCode, round(abs([Value]),2) as Value, [Price], [Timestamp] 
            FROM History_Hours 
            where [Timestamp] between '$pevious' and '$dt' and SensorID = '1'";

            $sensor = DB::select($sql);
            $filter = 1;
        } else {
            $sql = "SELECT SensorID , DataCode, round(abs([Value]),2) as Value, [Price], [Timestamp] 
            FROM History_Hours 
            where [Timestamp] between '$pevious' and '$dt' and SensorID = '$request->sltSenSor'";

            $sensor = DB::select($sql);
            $filter = $request->sltSenSor;
        }

        return view('backend.historical.hour', [
            'route' => Route::currentRouteName(),
            'sensor' => $sensor,
            'sslist' => $sslist,
            'filter' => $filter
        ]);
    }

    /**
     * Show Day
     *
     * @return \Illuminate\Http\Response
     */
    public function day(Request $request)
    {
        $dt = date('Y-m-d H:00:00');
        $pevious = date('Y-m-d H:00:00', strtotime("-14 day -1hours"));
        $sslist = Meter::all();

        if ($request->sltSenSor == null) {
            $sql = "SELECT SensorID , DataCode, round(abs([Value]),2) as Value, [Price], [Timestamp] 
            FROM History_Days 
            where [Timestamp] between '$pevious' and '$dt' and SensorID = '1'";

            $sensor = DB::select($sql);
            $filter = 1;
        } else {
            $sql = "SELECT SensorID , DataCode, round(abs([Value]),2) as Value, [Price], [Timestamp] 
            FROM History_Days 
            where [Timestamp] between '$pevious' and '$dt' and SensorID = '$request->sltSenSor'";

            $sensor = DB::select($sql);
            $filter = $request->sltSenSor;
        }

        return view('backend.historical.day', [
            'route' => Route::currentRouteName(),
            'sensor' => $sensor,
            'sslist' => $sslist,
            'filter' => $filter
        ]);
    }

    /**
     * Show Week
     *
     * @return \Illuminate\Http\Response
     */
    public function week(Request $request)
    {

        $dt = date('Y-m-d 00:00:00');
        $pevious = date('Y-m-d 00:00:00', strtotime("-63 days"));
        $sslist = Meter::all();

        if ($request->sltSenSor == null) {
            $sql = "SELECT SensorID , DataCode, round(abs([Value]),2) as Value, [Price], [Timestamp] 
                FROM History_Weeks
                where [Timestamp] between '$pevious' and '$dt' and SensorID = '1'";

            $sensor = DB::select($sql);
            $filter = 1;
        } else {
            $sql = "SELECT SensorID , DataCode, round(abs([Value]),2) as Value, [Price], [Timestamp] 
                FROM History_Weeks
                where [Timestamp] between '$pevious' and '$dt' and SensorID = '$request->sltSenSor'";

            $sensor = DB::select($sql);
            $filter = $request->sltSenSor;
        }

        return view('backend.historical.week', [
            'route' => Route::currentRouteName(),
            'sensor' => $sensor,
            'sslist' => $sslist,
            'filter' => $filter
        ]);
    }

    /**
     * Show Month
     *
     * @return \Illuminate\Http\Response
     */
    public function month(Request $request)
    {

        $dt = date('Y-m-d 00:00:00');
        $pevious = date('Y-m-d 00:00:00', strtotime("-1 years"));
        $sslist = Meter::all();

        if ($request->sltSenSor == null) {
            $sql = "SELECT SensorID , DataCode, round(abs([Value]),2) as Value, [Price], [Timestamp] 
                FROM History_Months
                where [Timestamp] between '$pevious' and '$dt' and SensorID = '1'";

            $sensor = DB::select($sql);
            $filter = 1;
        } else {
            $sql = "SELECT SensorID , DataCode, round(abs([Value]),2) as Value, [Price], [Timestamp] 
                FROM History_Months
                where [Timestamp] between '$pevious' and '$dt' and SensorID = '$request->sltSenSor'";

            $sensor = DB::select($sql);
            $filter = $request->sltSenSor;
        }

        return view('backend.historical.month', [
            'route' => Route::currentRouteName(),
            'sensor' => $sensor,
            'sslist' => $sslist,
            'filter' => $filter
        ]);
    }

    public function getData(Request $request)
    {

        $dt = date('Y-m-d H:i:s');
        $pevious = date('Y-m-d H:i:s', strtotime(" -6 hours"));

        if ($request->sltSenSor == null) {
            $sql = "SELECT SensorID, DataCode, 
            round(abs([Value]),2) as Value, 
            [Timestamp] FROM DataLog where [Timestamp] 
            between '$pevious' and '$dt' and SensorID = '1'";

            $sensor = DB::select($sql);
        } else {
            $sql = "SELECT SensorID, DataCode, 
            round(abs([Value]),2) as Value, [Timestamp] 
            FROM DataLog where [Timestamp] 
            between '$pevious' and '$dt' and SensorID = '$request->sltSenSor'";

            $sensor = DB::select($sql);
        }

        return response()->json($sensor);
    }
}
