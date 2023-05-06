<?php

namespace App\Http\Controllers\Backend;

use Auth;
use App\Area;
use App\Bookingrequest;
use App\Building;
use App\DataLoger;
use App\Device;
use App\DeviceTypeStatus;
use App\Configurations;
use App\HomeAssistant;
use App\permission;
use App\Room;
use App\RoomType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller as Controller;
use App\Participant;
use Illuminate\Support\Facades\Session;

class RoomController extends Controller
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
        $houses = Room::all();
        foreach ($houses as $key => $value) {
            $area = Area::find($value->area_id);
            if ($area) {
                $value->area = $area->name;
                $value->building = Building::find($area->building_id)->name;
            } else {
                $value->area = NULL;
                $value->building = NULL;;
            }
        }
        return view('backend.room.index', [
            'rooms' => $houses
        ]);
    }

    /**
     * Display a listing of device.
     *
     * @return \Illuminate\Http\Response
     */
    public function device(Request $request)
    {

        $res = Device::find(59);

        //dd($res->password);

        return view('backend.device.index', [
            'data' => Device::where('room_id', $request->id)->get(),
            'model' => Room::find($request->id),
            'type' => 'room'
        ]);
    }

    public function floor_plan(Request $request)
    {

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'http://192.168.10.133:8123/api/states',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'GET',
        //     CURLOPT_HTTPHEADER => array(
        //         'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJhMzFkZDk4ZDY0YzA0NWYwYWFlNjU3MTQzN2NiOWE4NiIsImlhdCI6MTY2NjE2NzQ4NSwiZXhwIjoxOTgxNTI3NDg1fQ.HYu_7LWvtgMwoCZb-KPP3-ug9gXkKFjItdBMrRnlmRc'
        //     ),
        // ));

        // $device_status = json_decode(curl_exec($curl));
        // curl_close($curl);
        //dd($device_status);

        // $curl = curl_init();
        // curl_setopt_array($curl, array(
        //     CURLOPT_URL => 'http://192.168.10.133:8123/api/services/switch/turn_off',
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => '',
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => 'POST',
        //     CURLOPT_POSTFIELDS => '{
        //         "entity_id" : "switch.tz3000_o005nuxx_ts011f_switch"

        //     }',
        //     CURLOPT_HTTPHEADER => array(
        //         'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJhMzFkZDk4ZDY0YzA0NWYwYWFlNjU3MTQzN2NiOWE4NiIsImlhdCI6MTY2NjE2NzQ4NSwiZXhwIjoxOTgxNTI3NDg1fQ.HYu_7LWvtgMwoCZb-KPP3-ug9gXkKFjItdBMrRnlmRc',
        //         'Content-Type: application/json'
        //     ),
        // ));

        // $response = json_decode(curl_exec($curl));
        // curl_close($curl);
        // dd($response);

        $devices = [];
        $house_items = [];
        $house = Room::find($request->id);
        if (!is_null($house->ha_id)) {
            $house->ha_token = HomeAssistant::find($house->ha_id)->token;
        }
        $house_items = Device::where('room_id', $house->id)->get();
        // $device_list = Device::where('room_id', $house->id)->pluck('id')->toArray();
        // dd($device_list);
        if (count($house_items) > 0) {
            foreach ($house_items as $value) {
                //$value->status = DB::select('select top 1 * from dataloger where device_id = '.$value->id.' order by id desc')->status ?? NULL;

                if (!is_null($value->status)) {
                    $default = DeviceTypeStatus::where('device_type_id', $value->device_type_id)
                        ->where('name', ucfirst($value->status->value))->first();
                } else {
                    $default =  DeviceTypeStatus::where('device_type_id', $value->device_type_id)
                        ->where('name', 'Default')->first();
                }

                if (!$default) {
                    $default =  DeviceTypeStatus::where('device_type_id', $value->device_type_id)
                        ->where('name', 'Default')->first();
                }

                $value->icon =  $default->icon ?? NULL;
                $value->icon_color =  $default->icon_color ?? NULL;
                $value->image =  $default->image ?? NULL;

                $devices[] = $value;
            }
        }
        // $device_list = DB::select("SELECT SensorID as device_id FROM [IoTData].[dbo].[DataLog] where Timestamp between '2022-10-19 00:00:00.000' and '2022-10-19 23:59:59.000' group by SensorID");
        // foreach ($device_list as $key => $value) {
        //     $house_items[] = DB::select("SELECT * FROM [IoTData].[dbo].[SensorLists] where SensorID = '{$value->device_id}'");
        // }
        // dd($house_items);
        $item = new Device();
        $d = DB::select("SELECT * FROM [IoTData].[dbo].[SensorLists] where SensorID = 8")[0];
        $item->id = 8;
        $item->name = $d->Label;
        $item->device_type_id = 1;
        $item->visible = "1";
        $item->display_status = "hover";
        $item->x = 75;
        $item->y = 75;
        $default =  DeviceTypeStatus::where('device_type_id',  $item->device_type_id)->where('name', 'Default')->first();
        $item->icon =  $default->icon ?? NULL;
        $item->icon_color =  $default->icon_color ?? NULL;
        $item->data =  DB::select("SELECT TOP 5 [RowID], [SensorID], [DataCode], [Value], [Timestamp] FROM [IoTData].[dbo].[DataLog] where SensorID = 8");
        $devices[] = $item;
        //dd($devices);
        return view('backend.room.floor-plan', [
            'room' => $house,
            'devices' => $devices,
            'floor_plan' => true
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
            'data' => Permission::where('room_id', $request->id)->where('deleted', false)->get(),
            'model' => Room::find($request->id),
            'type' => 'room'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.room.form', [
            'action' => 'create',
            'approvers' => User::all(),
            'areas' => Area::all(),
            'room_types' => RoomType::all(),
            'has' => HomeAssistant::all()
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

        if ($request->has('auto_approve') && $request->auto_approve == true) {
            $request->merge([
                'approver' => NULL,
            ]);
        }

        if ($request->has('id')) {
            $item = Room::find($request->id);
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
            $item = Room::create($request->all());

            $notification = array(
                'message' => 'The data was created successfully.',
                'alert-type' => 'success'
            );
        }
        if ($item && $request->has('floor_plan_image') && !is_null($request->floor_plan_image)) {
            if (!Storage::disk('local')->has('floor_plan_image')) {
                Storage::disk('local')->makeDirectory('img/floor_plan');
            }
            $file_name = 'room_' . $item->id . '.' . $request->file('floor_plan_image')->getClientOriginalExtension();
            $path = 'public/img/floor_plan/' . $file_name;
            Storage::disk('local')->put($path, file_get_contents($request->file('floor_plan_image')));
            $item->floor_plan_image = $path;
            $item->update();
        }

        return redirect()->route('house.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Room  $house
     * @return \Illuminate\Http\Response
     */
    public function show(Room $house)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Room  $house
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $house)
    {
        return view('backend.room.form', [
            'action' => 'edit',
            'approvers' => User::all(),
            'areas' => Area::all(),
            'room' => $house,
            'room_types' => RoomType::all(),
            'has' => HomeAssistant::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $house
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $house)
    {
        $house = Room::where('id', $request->id)->first();
        $houses = $house->update($request->all());
        $notification = array(
            'message' => 'Edit room successfully!',
            'alert-type' => 'success'
        );
        return redirect('backend/room')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $house
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $house)
    {
        //
    }

    public function reject(Request $request, Room $house)
    {
        if ($request->type == 'Reject') {
            $del = Room::find($request->id);
            $del->delete();
            return "success";
        }
    }

    public function disable(Request $request)
    {
        $r = Room::find($request->id);
        $r->disable = $request->disable === 'true' ? true : false;
        if ($r->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function booking(Request $request)
    {
        //dd($request->all());

        if ($request->has('start') && $request->has('end')) {
            $startDate = date('Y-m-d', strtotime($request->start));
            $endDate = date('Y-m-d', strtotime($request->end));
        } else {
            $startDate = date('Y-m-d');
            $endDate = date('Y-m-d');
        }

        if ($request->has('room_array_list') && !is_null($request->room_array_list) && is_array(explode(",", $request->room_array_list))) {

            $main_room = Room::find($request->main_room);
            if ($main_room->active_license == false || $main_room->disable == true) {
                return redirect()->back();
            }

            $house_id = explode(',', $request->room_array_list);

            $area = Area::find($main_room->area_id);

            $i = 0;

            foreach ($house_id as $value) {
                $r = Room::find($value);
                $active_room[] = $r->id;
                $multi_data[$i]['id'] = $r->id;
                $multi_data[$i]['name'] = $r->name;
                $i++;
            }

            $tree = [];;
            $tree = Area::where('building_id', $main_room->area_id)->get();

            foreach ($tree as $a) {
                $r = Room::where('area_id', $a->id)->where('disable', false)->where('active_license', true)->get();
                $a->rooms = $r;
            }

            return view('backend.room.booking', [
                'active_room' => $active_room,
                'area' => $area,
                'building' => Building::find($area->building_id),
                'event' => [],
                'multi_room' => $multi_data,
                'room' => $main_room,
                'room_in_same_buliding' => Room::where('area_id', $main_room->area_id)->where('disable', false)->get(),
                'tree' => $tree
            ]);
        } else if ($request->has('room_id')) {

            $house = Room::find($request->room_id);
            if ($house->active_license == false || $house->disable == true) {
                response()->json(false);
            }

            $house_email = $house->email;
            $token = getToken();
            $UID = getUserID($token, $house_email);

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
            $house = Room::find($request->id);
            if ($house->active_license == false || $house->disable == true) {
                return redirect()->back();
            }
            $area = Area::find($house->area_id);
            $building = Building::find($area->building_id);
            $tree = [];;
            $tree = Area::where('building_id', $house->area_id)->get();

            foreach ($tree as $a) {
                $r = Room::where('area_id', $a->id)->where('disable', false)->where('active_license', true)->get();
                $a->rooms = $r;
            }

            return view('backend.room.booking', [
                'active_room' => $active_room,
                'area' => $area,
                'building' => $building,
                'event' => [],
                'multi_room' => [],
                'room' => $house,
                'room_in_same_buliding' => Room::where('area_id', $house->area_id)->where('disable', false)->get(),
                'tree' => $tree
            ]);
        }
    }

    public function getEvent($calendar, $house_id, $start, $end)
    {
        $event = (array) null;
        $allevent = (array) null;
        $allData = (array) null;
        $data = (array) null;
        $time_checker = strtotime(date('Y-m-d H:i:s'));

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
                            $book = BookingRequest::where('icaluid', '=', $allevent[$j]["iCalUId"])->first();
                            if (!is_null($book)) {
                                $allData["organizer"] = User::find($book->booker)->email;
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
                $allData["start"] = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $sTime[0]) . ' +7 hours'));
                $allData["end"] = date("Y-m-d H:i:s", strtotime(str_replace('T', ' ', $eTime[0]) . ' +7 hours'));
                if (isset($calendar[$i]->iCalUId)) {
                    $allData["icaluid"] = $calendar[$i]->iCalUId;
                    $book = BookingRequest::where('icaluid', '=', $calendar[$i]->iCalUId)->first();
                    if (!is_null($book)) {
                        $allData["organizer"] = User::find($book->booker)->email;
                        $allData["system_booking_id"] = $book->id;
                        $allData["detail"] = $book->detail;
                        if (strtotime($allData["end"]) < $time_checker) {
                            $allData["backgroundColor"] = '#bbb';
                        } else {
                            $allData["backgroundColor"] = 'orange';
                        }
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
                $allData["attendees"] = $calendar[$i]->attendees;
                array_push($data, $allData);
            } else {
            }
        }

        $request = Bookingrequest::where('room', $house_id)->where('status', NULL)->whereBetween('start', [$start, $end])->get();

        if (!is_null($request)) {
            foreach ($request as $value) {
                $d["system_booking_id"] = $value->id;
                $d["organizer"] = User::find($value->booker)->email;
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

    public function getRoomSeat(Request $request)
    {
        return Room::find($request->room_id)->seat;
    }

    public function delete(Request $request)
    {
        $item = Room::find($request->id);
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

    public function item_position(Request $request)
    {
        unset($request['url']);
        switch ($request->item_type) {
            case 'device':
                $device = Device::find($request->item_id);
                $device->x = $request->x;
                $device->y = $request->y;
                $device->save();
                break;
        }

        return response()->json(true);
    }

    public function updateLicenseStatus(Request $request)
    {
        $active = Room::where('active_license', true)->get()->count();
        if ($request->active_license == "false") {
            $active--;
        }
        if ($active >= Session::get('room_activate_limit')) {
            return response()->json(999);
        }

        $house = Room::find($request->id);
        $house->active_license = $request->active_license == "true" ? true : false;
        if ($house->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function updateVisible(Request $request)
    {
        $data = Room::find($request->id);
        $data->visible = $request->visible == "true" ? true : false;
        if ($data->update()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function updateDisplayStatus(Request $request)
    {
        $data = Room::find($request->id);
        $data->display_status = $request->display_status;
        if ($data->update()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function chart(Request $request)
    {
        $data = Room::find($request->id);
        return view('backend.room.chart', [
            'room' => $data,
        ]);
    }
}
