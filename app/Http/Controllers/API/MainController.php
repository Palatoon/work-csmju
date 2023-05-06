<?php

namespace App\Http\Controllers\API;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    public function CalendarView(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        //dd($request);
        $suffix = env('SUFFIX');
        $RoomMail = $request->Room . $suffix;
        $startDate = $request->start;

        $endDate = $request->end;
        $token = getToken();
        $UID = getUserID($token, $RoomMail);
        if (isset($UID->error)) {
            return response()->json(json_decode(json_encode($UID)));
        }
        $calendar = CalendarDetail($token, $UID, $startDate, $endDate);
        if (isset($calendar->error)) {
            return response()->json(json_decode(json_encode($calendar)));
        }
        $event = (array) null;
        $allevent = (array) null;
        $allData = (array) null;
        $data = (array) null;
        for ($i = 0; $i < count($calendar); $i++) {
            if ($calendar[$i]->type == "seriesMaster") {
                if ($calendar[$i]->isCancelled == false) {
                    $event["id"] = $calendar[$i]->id;
                    $sj = explode("] ", $calendar[$i]->subject);
                    if (count($sj) == 3) {
                        $event["subject"] = $sj[1] . "]" . $sj[2];
                    } else {
                        $event["subject"] = $sj[1];
                    }
                    $event["bodyPreview"] = $calendar[$i]->bodyPreview;
                    $event["isCancelled"] = $calendar[$i]->isCancelled;
                    $event["onlineMeetingUrl"] = $calendar[$i]->OnlineMeeting;
                    $event["locations"] = $calendar[$i]->locations;
                    //$event["attendees"]=$calendar[$i]->attendees;
                    $event["organizer"] = $calendar[$i]->organizer;
                    array_push($allevent, $event);
                }
            } else if ($calendar[$i]->type == "occurrence" || $calendar[$i]->type == "exception") {
                $event = (array) null;
                for ($j = 0; $j < count($allevent); $j++) {
                    if ($calendar[$i]->seriesMasterId == $allevent[$j]["id"]) {
                        $sTime = explode(".", $calendar[$i]->start->dateTime);
                        $eTime = explode(".", $calendar[$i]->end->dateTime);
                        //$eDay = date('D', strtotime($sTime[0]));

                        $allData["title"] = $allevent[$j]["subject"];
                        $allData["start"] = $sTime[0];
                        $allData["end"] = $sTime[0];
                        array_push($data, $allData);
                    }
                }
            } else if ($calendar[$i]->type == "singleInstance") {
                $sTime = explode(".", $calendar[$i]->start->dateTime);
                $eTime = explode(".", $calendar[$i]->end->dateTime);
                //$eDay = date('D', strtotime($sTime[0]));

                $allData["title"] = $calendar[$i]->subject;
                $allData["start"] = $sTime[0];
                $allData["end"] = $sTime[0];
                array_push($data, $allData);
            } else {
            }
        }
        return response()->json(json_decode(json_encode($data)));
    }
    public function CreateEvent(Request $request)
    {
        $suffix = env('SUFFIX');
        $token = getToken();
        $organizer = $request->Email;
        $subject = $request->Subject;
        $start = $request->Start;
        $end = $request->End;
        $classroom = $request->Classroom;
        $room_email = $classroom . $suffix;
        $OnlineMeeting = $request->OnlineMeeting;
        $calendar = createEvent($token, $organizer, $subject, $start, $end, $classroom, $room_email, $OnlineMeeting);
        if (isset($calendar->error)) {
            return response()->json(json_decode(json_encode($calendar)));
        }
        return response()->json($calendar);
    }
}
