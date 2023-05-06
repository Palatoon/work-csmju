<?php

namespace App\Http\Controllers;

use App\BookingRequest;
use App\Configurations;
use App\Room;
use App\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getConfig()
    {
        $array = [];
        $configs = Configurations::all();

        foreach ($configs as $k => $c) {
            $array[str_replace('-', '_', $c->name)] = $c->value;
        }

        return $array;
    }

    public function checkQuota(Request $request)
    {
        if ($request->has('email')) {
            $user = User::where('email', $request->email)->first();
            if ($user) {
                $id = $user->id;
                $email = $user->email;
            } else {
                $id = null;
                $email = $request->email;
            }
        } else {
            $id = Auth::user()->id;
            $email = Auth::user()->email;
        }
        $array['booking_per_week'] = 0;
        $array['booking_per_day'] = 0;
        $start_of_week = date('Y-m-d 00:00:00', strtotime('monday this week', strtotime($request->start)));
        $end_of_week = date('Y-m-d 23:59:59', strtotime('sunday this week', strtotime($request->start)));
        $start_of_day = date('Y-m-d 00:00:00', strtotime($request->start));
        $end_of_day = date('Y-m-d 23:59:59', strtotime($request->start));
        $array['id'] = $id;
        $array['email'] = $email;
        if (!is_null($id)) {
            $array['booking_per_week'] += BookingRequest::whereBetween('start', [date('Y-m-d H:i:s', strtotime($start_of_week)), date('Y-m-d H:i:s', strtotime($end_of_week))])
                ->where('booker', $id)->where('status', true)->get()->count();
            $array['booking_per_day'] += BookingRequest::whereBetween('start', [date('Y-m-d H:i:s', strtotime($start_of_day)), date('Y-m-d H:i:s', strtotime($end_of_day))])
                ->where('booker', $id)->where('status', true)->get()->count();
        }
        $array['booking_per_week'] += intval(DB::connection('sqlsrv')->select("SELECT count(*) as count FROM participants as p join booking_requests as b on b.id = p.booking_id where b.status = 1 and p.email = '{$email}' and b.start between '{$start_of_week}' and '{$end_of_week}'")[0]->count);
        $array['booking_per_day'] += intval(DB::connection('sqlsrv')->select("SELECT count(*) as count FROM participants as p join booking_requests as b on b.id = p.booking_id where b.status = 1 and p.email = '{$email}' and b.start between '{$start_of_day}' and '{$end_of_day}'")[0]->count);
        return response()->json($array);
    }

    public function checkRoomBookable(Request $request)
    {

        $min = Configurations::where('name', 'after-using-end')->first()->value;
        $request->merge([
            'end' => date('Y-m-d H:i',strtotime("+".$min." minutes", strtotime($request->end))),
        ]);

        //if (Room::find($request->room_id)->checkBookable($request->room_id) == true) {
        $duplicate_time = BookingRequest::where('start', '>', date('Y-m-d H:i:s', strtotime($request->start)))
            ->where('start', '<', date('Y-m-d H:i:s', strtotime($request->end)))
            ->where('booker', auth()->user()->id)->where('status', true)
            ->orWhere('end', '>', date('Y-m-d H:i:s', strtotime($request->start)))
            ->where('end', '<', date('Y-m-d H:i:s', strtotime($request->end)))
            ->where('booker', auth()->user()->id)->where('status', true)
            ->get()->count();

        if ($duplicate_time > 0) {
            $array['result'] = false;
            $array['type'] = 'time';
        } else {
            $booking_duplicate = BookingRequest::where('start', '>', date('Y-m-d H:i:s', strtotime($request->start)))
                ->where('start', '<', date('Y-m-d H:i:s', strtotime($request->end)))
                ->where('room', $request->room_id)->where('status', true)
                ->where('booker', '<>', auth()->user()->id)
                ->orWhere('end', '>', date('Y-m-d H:i:s', strtotime($request->start)))
                ->where('end', '<', date('Y-m-d H:i:s', strtotime($request->end)))
                ->where('room', $request->room_id)->where('status', true)
                ->where('booker', '<>', auth()->user()->id)
                ->get()->count();
            if ($booking_duplicate > 0) {
                $array['result'] = false;
                $array['type'] = 'duplicate';
            } else {
                $array['result'] = true;
            }
        }
        // } else {
        //     $array['result'] = false;
        //     $array['type'] = 'group';
        // }
        return response()->json($array);
    }
}
