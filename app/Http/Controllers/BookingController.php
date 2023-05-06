<?php

namespace App\Http\Controllers;

use App\Bookingrequest;
use App\Building;
use App\Configurations;
use App\Room;
use App\RoomGroup;
use App\RoomType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use App\Participant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Auth::logout();
        \Session::flush();
        \Session::start();
        $room = Room::all()->toArray();
        session(['admin-username' => intval(\App\Configurations::select('value')->where('name', 'admin-username')->first()->value)]);
        session(['booking-per-week' => intval(\App\Configurations::select('value')->where('name', 'booking-per-week')->first()->value)]);
        session(['booking-per-day' => intval(\App\Configurations::select('value')->where('name', 'booking-per-day')->first()->value)]);
        session(['booking-ahead-day' => intval(\App\Configurations::select('value')->where('name', 'booking-ahead-day')->first()->value)]);
        session(['booking-hour-max' => intval(\App\Configurations::select('value')->where('name', 'booking-hour-max')->first()->value)]);
        session(['booking-hour-min' => intval(\App\Configurations::select('value')->where('name', 'booking-hour-min')->first()->value)]);
        session(['max-participant' => intval(\App\Configurations::select('value')->where('name', 'max-participant')->first()->value)]);
        session(['before-start' => intval(\App\Configurations::select('value')->where('name', 'before-start')->first()->value)]);
        session(['after-start' => intval(\App\Configurations::select('value')->where('name', 'after-start')->first()->value)]);
        session(['time-step' => intval(\App\Configurations::select('value')->where('name', 'time-step')->first()->value)]);
        return view('booking', [
            'room' => $room
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
        //
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

    public function booking(Request $request)
    {
        $start_of_week = date('Y-m-d 00:00:00', strtotime('monday this week'));
        $end_of_week = date('Y-m-d 23:59:59', strtotime('sunday this week'));

        if ($request->has('start') && $request->has('end')) {
            $startDate = date('Y-m-d', strtotime($request->start));
            $endDate = date('Y-m-d', strtotime($request->end));
        } else {
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d');
        }

        if ($request->has('room_array_list') && is_array(explode(",", $request->room_array_list))) {

            $main_room = Room::find($request->main_room);
            $room_id = explode(',', $request->room_array_list);

            $i = 0;

            foreach ($room_id as $value) {
                $r = Room::find($value);
                $active_room[] = $r->id;
                $multi_data[$i]['id'] = $r->id;
                $multi_data[$i]['name'] = $r->name;
                $i++;
            }

            return view('backend.room.booking', [
                'building' => Building::find($main_room->building_id),
                'event' => [],
                'room' => $main_room,
                'active_room' => $active_room,
                'multi_room' => $multi_data,
                'room_in_same_buliding' => Room::where('building_id', $main_room->building_id)->where('disable', false)->get(),
            ]);
        } else if ($request->has('room_id')) {

            $room = Room::find($request->room_id);
            $room_email = $room->email;
            $token = getToken();
            $UID = getUserID($token, $room_email);

            if (isset($UID->error)) {
                return response()->json(json_decode(json_encode($UID)));
            }

            $calendar = CalendarDetail($token, $UID, $startDate, $endDate);

            if (isset($calendar->error)) {
                return response()->json(json_decode(json_encode($calendar)));
            }

            $data = $this->getEvent($calendar, $request->room_id, $startDate, $endDate);

            return response()->json($data);
        } else {

            $active_room[] = $request->id;
            $room = Room::find($request->id);


            return view('backend.room.booking', [
                'building' => Building::find($room->building_id),
                'event' => [],
                'room' => $room,
                'active_room' => $active_room,
                'multi_room' => [],
                'room_in_same_buliding' => Room::where('building_id', $room->building_id)->where('disable', false)->get()
            ]);
        }
    }

    public function getEvent($calendar, $room_id, $start, $end)
    {
        $event = (array) null;
        $allevent = (array) null;
        $allData = (array) null;
        $data = (array) null;

        for ($i = 0; $i < count($calendar); $i++) {
            if ($calendar[$i]->type == "seriesMaster") {
                if ($calendar[$i]->isCancelled == false) {
                    $event["id"] = $calendar[$i]->id;
                    $event["subject"] = $calendar[$i]->subject;
                    $event["bodyPreview"] = $calendar[$i]->bodyPreview;
                    $event["isCancelled"] = $calendar[$i]->isCancelled;
                    if (isset($calendar[$i]->OnlineMeeting)) {
                        $event["onlineMeetingUrl"] = $calendar[$i]->OnlineMeeting;
                    }
                    $event["locations"] = $calendar[$i]->locations;
                    $event["attendees"] = $calendar[$i]->attendees;
                    $event["organizer"] = $calendar[$i]->organizer;
                    $calendar[$i]->attendees;
                    array_push($allevent, $event);
                }
            } else if ($calendar[$i]->type == "occurrence" || $calendar[$i]->type == "exception") {
                $event = (array) null;
                for ($j = 0; $j < count($allevent); $j++) {
                    if ($calendar[$i]->seriesMasterId == $allevent[$j]["id"]) {
                        $sTime = explode(".", $calendar[$i]->start->dateTime);
                        $eTime = explode(".", $calendar[$i]->end->dateTime);

                        if (isset($allevent[$j]["iCalUId"])) {
                            $allData["icaluid"] = $allevent[$j]["iCalUId"];
                            $book = Bookingrequest::where('icaluid', '=', $allevent[$j]["iCalUId"])->first();
                            if (!is_null($book)) {
                                $allData["system_booking_id"] = $book->id;
                                $allData["detail"] = $book->detail;
                                $allData["editable"] = 1;
                            } else {
                                $allData["editable"] = 0;
                            }
                        }
                        if (isset($allevent[$j]["id"])) {
                            $allData["calendar_id"] =  $allevent[$j]["id"];
                        }
                        $allData["title"] = $allevent[$j]["subject"];
                        $allData["start"] = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $sTime[0]) . ' +7 hours'));
                        $allData["end"] = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $eTime[0]) . ' +7 hours'));
                        $allData["attendees"] = $allevent[$j]['attendees'];
                        $allData["backgroundColor"] = '#50A7FE';
                        array_push($data, $allData);
                    }
                }
            } else if ($calendar[$i]->type == "singleInstance") {
                $sTime = explode(".", $calendar[$i]->start->dateTime);
                $eTime = explode(".", $calendar[$i]->end->dateTime);
                if (isset($calendar[$i]->iCalUId)) {
                    $allData["icaluid"] = $calendar[$i]->iCalUId;
                    $book = Bookingrequest::where('icaluid', '=', $calendar[$i]->iCalUId)->first();
                    if (!is_null($book)) {
                        $allData["system_booking_id"] = $book->id;
                        $allData["detail"] = $book->detail;
                        $allData["backgroundColor"] = 'orange';
                        $allData["editable"] = 1;
                    } else {
                        $allData["backgroundColor"] = 'red';
                        $allData["editable"] = 0;
                    }
                }
                if (isset($calendar[$i]->id)) {
                    $allData["calendar_id"] = $calendar[$i]->id;
                }
                $allData["title"] = $calendar[$i]->subject;
                $allData["start"] = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $sTime[0]) . ' +7 hours'));
                $allData["end"] = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $eTime[0]) . ' +7 hours'));
                $allData["attendees"] = $calendar[$i]->attendees;
                array_push($data, $allData);
            } else {
            }
        }

        $request = Bookingrequest::where('room', $room_id)->where('status', NULL)->whereBetween('start', [$start, $end])->get();

        if (!is_null($request)) {
            foreach ($request as $value) {
                $d["system_booking_id"] = $value->id;
                $d["icaluid"] = $value->caluid;
                $d["calendar_id"] = $value->calendar_id;
                $d["title"] =  $value->title;
                $d["start"] = $value->start;
                $d["end"] = $value->end;
                $d["backgroundColor"] = 'black';
                $d["attendees"] = Participant::where('booking_id', $value->id)->get();
                $d["detail"] = $value->detail;
                $d["editable"] = 1;
                array_push($data, $d);
            }
        }

        return $data;
    }

    public function getRoomGroupBookable(Request $request)
    {
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d');

        $data = $this->getEvent(null, $request->room_id, $startDate, $endDate);
        $group = DB::connection('sqlsrv')->select("select count(*) as total, sum(case when bookable = 1 then 1 else 0 end) as bookable from room_groups where room_id = '{$request->room_id}'");
        if($group[0]->total == $group[0]->bookable){
            $arr_group = [];
        }
        else {
            $arr_group = RoomGroup::where('room_id', $request->room_id)->where('bookable', 1)->get();
        }
        $array =  array(
            'room' => Room::find($request->room_id),
            'group' => $arr_group,
            'seat' => Room::find($request->room_id)->seat,
            'event' => $data,
            'max' => Configurations::where('name', 'booking-hour-max')->get()

        );
        return $array;
    }

    public function getrooms()
    {
        $now = date('Y-m-d H:i:s');
        $room_with_status = [];
        $rooms = Room::all()->toArray();
        $n = 0;
        foreach ($rooms as $key => $value) {
            $room_with_status[$n] = $value;
            $b = Bookingrequest::where('room', $value['id'])->where('start', '<', $now)->where('end', '>', $now)->where('status', 1)->count();
            if ($b > 0) {
                $room_with_status[$n]['status'] = 0;
            } else {
                $room_with_status[$n]['status'] = 1;
            }
            $n++;
        }

        return $room_with_status;
    }
}
