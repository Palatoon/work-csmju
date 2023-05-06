<?php

namespace App\Http\Controllers\Backend;

use App\Datacode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller as Controller;
use App\Device;
use App\DeviceDatacode;
use App\DeviceDatacodeCondition;
use App\DeviceInit;
use App\DeviceType;
use App\HomeAssistant;
use App\Room;



class DeviceController extends Controller
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
        //

        $dd = Device::all();

        return view('backend.device.index', ['data' => $dd, 'chk' => "0"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $aa = Room::all();
        $dd = DeviceType::all();
        $hh = HomeAssistant::all();
        return view('backend.device.create', ['room' => $aa, 'device' => $dd, 'home' => $hh]);
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



        $client = new \GuzzleHttp\Client();
        $res = $client->post('http://ws.lanna.co.th/Ads/crypt', [\GuzzleHttp\RequestOptions::JSON => ['Password' => $request->password]]);
        $r = json_decode($res->getBody());

        foreach ($r as $ss) {
            $type_name = DeviceType::find($request->device_type)->name;
            switch ($request->type) {
                case "area": {
                        $aa = new Device();
                        $aa->name = $request->name;
                        $aa->device_type_id = $request->device_type;
                        $aa->area_id  = $request->fkid;
                        if ($type_name === "Access Control" || $type_name === "Camera") {
                            $aa->ip = $request->ip;
                            $aa->macaddress = $request->mac;
                            $aa->serial_id = $request->serial;
                            $aa->username = $request->username;
                            $aa->password = $ss->Password;
                        } else {
                            if ($request->home_assistant == "no") {
                                $aa->ip = $request->ip;
                                $aa->macaddress = $request->mac;
                                $aa->serial_id = $request->serial;
                                $aa->username = $request->username;
                                $aa->password = $ss->Password;
                            } else {
                                $aa->home_assistant_id = $request->home_assistant;
                            }
                        }
                        $aa->save();
                    }
                    break;
                case "room": {
                        $aa = new Device();
                        $aa->name = $request->name;
                        $aa->device_type_id = $request->device_type;
                        $aa->room_id  = $request->fkid;
                        if ($type_name === "Access Control" || $type_name === "Camera") {
                            $aa->ip = $request->ip;
                            $aa->macaddress = $request->mac;
                            $aa->serial_id = $request->serial;
                            $aa->username = $request->username;
                            $aa->password = $ss->Password;
                        } else if ($type_name != "Access Control" || $type_name != "Camera") {
                            if ($request->home_assistant == "no") {
                                $aa->ip = $request->ip;
                                $aa->macaddress = $request->mac;
                                $aa->serial_id = $request->serial;
                                $aa->username = $request->username;
                                $aa->password = $ss->Password;
                            } else {
                                $aa->home_assistant_id = $request->home_assistant;
                            }
                        }
                        $aa->save();
                    }
                    break;
                case "home-assistant": {
                        $aa = new Device();
                        $aa->name = $request->name;
                        $aa->device_type_id = $request->device_type;
                        if ($type_name === "Access Control" || $type_name === "Camera") {
                            $aa->ip = $request->ip;
                            $aa->macaddress = $request->mac;
                            $aa->serial_id = $request->serial;
                            $aa->username = $request->username;
                            $aa->password = $ss->Password;
                        } else {
                            if ($request->home_assistant == "no") {
                                $aa->ip = $request->ip;
                                $aa->macaddress = $request->mac;
                                $aa->serial_id = $request->serial;
                                $aa->username = $request->username;
                                $aa->password = $ss->Password;
                            } else {
                                $aa->home_assistant_id = $request->home_assistant;
                            }
                        }
                        $aa->save();
                    }
                    break;
            }
        }



        $notification = array(
            'message' => 'Created device successfully!',
            'alert-type' => 'success'
        );

        $tname = ($request->type == "room") ? 'house' : $request->type;

        return redirect('/backend/' . $tname . '/' . $request->fkid . '/device?id=' . $request->fkid . '&type=' . $request->type)->with($notification);

        //return redirect('backend/device')->with($notification);
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
        $rr = Room::all();
        $aa = Device::find($id);
        $dd = DeviceType::all();
        $hh = HomeAssistant::all();
        return view('backend.device.edit', ['data' => $aa, 'room' => $rr, 'device' => $dd, 'home' => $hh]);
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

        $dt = Device::find($id)->device_name($request->device_type);
        if ($request->password == null) {
            if ($dt == "Access Control" || $dt == "Camera") {
                $aa = Device::find($id);
                $aa->ip = $request->ip;
                $aa->macaddress = $request->mac;
                $aa->serial_id = $request->serial;
                $aa->name = $request->name;
                $aa->device_type_id = $request->device_type;
                $aa->username = $request->username;
                $aa->save();
            } else {

                $aa = Device::find($id);
                $aa->ip = $request->ip;
                $aa->macaddress = $request->mac;
                $aa->serial_id = $request->serial;
                $aa->name = $request->name;
                $aa->device_type_id = $request->device_type;
                if ($request->home_assistant != "no") {
                    $aa->home_assistant_id = $request->home_assistant;
                }
                $aa->username = $request->username;
                $aa->save();
            }
            $notification = array(
                'message' => 'Edit device successfully!',
                'alert-type' => 'success'
            );
        } else {

            $client = new \GuzzleHttp\Client();
            $res = $client->post('http://ws.lanna.co.th/Ads/crypt', [\GuzzleHttp\RequestOptions::JSON => ['Password' => $request->password]]);
            $r = json_decode($res->getBody());

            foreach ($r as $ss) {
                if ($ss->Password != null) {

                    $aa = Device::find($id);
                    $aa->ip = $request->ip;
                    $aa->macaddress = $request->mac;
                    $aa->serial_id = $request->serial;
                    $aa->name = $request->name;
                    $aa->device_type_id = $request->device_type;
                    $aa->home_assistant_id = null;
                    $aa->username = $request->username;
                    $aa->password = $ss->Password;
                    $aa->save();

                    $notification = array(
                        'message' => 'Edit device successfully!',
                        'alert-type' => 'success'
                    );
                } else {
                    $notification = array(
                        'message' => 'Edit device fail!',
                        'alert-type' => 'error'
                    );
                }
            }
        }

        $tname = ($request->type == "room") ? 'house' : $request->type;
        return redirect('/backend/' . $tname . '/' . $request->fkid . '/device?id=' . $request->fkid . '&type=' . $request->type)->with($notification);

        //return redirect('backend/device')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //


        $aa = Device::find($request->id);
        $aa->delete();
        // $notification = array(
        //     'message' => 'Delete device successfully!',
        //     'alert-type' => 'success'
        // );
        return "true";
        // return redirect('/backend/device/' . $aa->room_id . '/room')->with($notification);
    }




    public function remove($id)
    {
        //


        $aa = Device::find($id);
        $aa->delete();
        return "true";
    }

    public function destroy2(Request $request)
    {
        if (request()->has('id')) {
            $aa = Device::find($request->id);
            $aa->delete();
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }



    public function showdevice($id)
    {

        $dd = Device::where('room_id', $id)->get();
        return view('backend.device.index', ['data' => $dd, 'chk' => $id]);
    }


    public static function getroomname($id)
    {
        $room = Room::find($id);
        return $room->name;
    }




    public function getdeviceinit($id)
    {
        $dd = DeviceInit::where('device_id', $id)->first();
        if ($dd == null) {
            return "null";
        }
        return $dd;
    }


    public function adddeviceinit(Request $request)
    {
        $dd = DeviceInit::where('device_id', $request->device_id)->where('room_id', $request->room_id)->first();


        if ($dd == null) {

            $a = new DeviceInit();
            $a->device_id = $request->device_id;
            $a->room_id = $request->room_id;
            $a->start_time = $request->st_time;
            $a->end_time = $request->ed_time;
            $a->save();
            return "1";
        } else {
            $dd->device_id = $request->device_id;
            $dd->room_id = $request->room_id;
            $dd->start_time = $request->st_time;
            $dd->end_time = $request->ed_time;
            $dd->save();
            return "2";
        }
    }

    public function getDevice(Request $request)
    {
        return response()->json(Device::all());
    }

    public function getDatacode(Request $request)
    {
        $datacode = [];
        $datacode = DeviceDatacode::where('device_id', $request->device_id)->get();
        foreach ($datacode as $key => $value) {
            $value->label = Datacode::find($value->datacode_id)->DataLabel;
        }
        return response()->json($datacode);
    }

    public function getCondition(Request $request)
    {
        $c = DeviceDatacodeCondition::where('device_id', $request->id)->get();
        foreach ($c as $key => $value) {
            $value->label = Datacode::find($value->datacode_id)->DataLabel;
        }
        return response()->json($c);
    }

    public function storeCondition(Request $request)
    {
        //dd($request->all());
        $count = 0;
        foreach ($request->id as $key => $value) {
            if (is_null($value)) {
                DeviceDatacodeCondition::create([
                    'device_id' => $request->device_id,
                    'datacode_id' => $request->datacode[$count],
                    'condition' => $request->condition[$count],
                    'value' => $request->value[$count]
                ]);
            } else {
                $c = DeviceDatacodeCondition::find($value);
                $c->device_id = $request->device_id;
                $c->datacode_id = $request->datacode[$count];
                $c->condition = $request->condition[$count];
                $c->value = $request->value[$count];
                $c->update();
            }
            $count++;
        }

        if (\Config::get('app.locale') == 'en') {
            $notification = array(
                'message' => 'Stored condition successfully!',
                'alert-type' => 'success'
            );
        } else {
            $notification = array(
                'message' => 'บันทึกเงื่อนไขเรียบร้อยแล้ว!',
                'alert-type' => 'success'
            );
        }
        return redirect()->back()->with($notification);
    }
}
