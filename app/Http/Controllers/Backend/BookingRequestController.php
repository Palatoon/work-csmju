<?php

namespace App\Http\Controllers\Backend;

use App\BookingRequest;
use App\Participant;
use App\Room;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

class BookingRequestController extends Controller
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
        return view('backend.request.index', [
            'requests' => BookingRequest::all()
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
    // public function store(Request $request)
    // {
    //     $token = getToken();

    //     if (!is_null($request->booking_id)) {
    //         $request_booking = BookingRequest::Find($request->booking_id);


    //         if (is_null($request->participants)) {
    //             $participants = [];
    //         } else {
    //             $participants = explode(',', $request->participants);
    //         }

    //         $request_booking->title = $request->title;
    //         $request_booking->start = $this->convertToSQLDate($request->start);
    //         $request_booking->end = $this->convertToSQLDate($request->end);
    //         $timestamp1 = strtotime($request_booking->start);
    //         $timestamp2 = strtotime($request_booking->end);
    //         $request_booking->hour = abs(strtotime($request_booking->end) - strtotime($request_booking->start)) / (60 * 60);
    //         $request_booking->detail = $request->detail;
    //         $request_booking->online_meeting = $request->online_meeting == "true" ? true : false;
    //         $request_booking->save();

    //         $allp = Participant::where('booking_id', $request_booking->id)->get();

    //         foreach ($allp as $pts) {
    //             if (!in_array($pts->email, $participants)) {
    //                 $curl = curl_init();
    //                 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    //                 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    //                 curl_setopt_array($curl, array(
    //                     CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $pts->email . "/events?filter=iCalUId%20eq%20'" . $request_booking->icaluid . "'",
    //                     CURLOPT_RETURNTRANSFER => true,
    //                     CURLOPT_ENCODING => "",
    //                     CURLOPT_MAXREDIRS => 10,
    //                     CURLOPT_TIMEOUT => 0,
    //                     CURLOPT_FOLLOWLOCATION => true,
    //                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                     CURLOPT_CUSTOMREQUEST => "GET",
    //                     CURLOPT_HTTPHEADER => array(
    //                         "Authorization: Bearer " . $token
    //                     ),
    //                 ));

    //                 $response = curl_exec($curl);
    //                 curl_close($curl);

    //                 $res = json_decode($response);

    //                 if (isset($res->value[0]->id)) {

    //                     $curl = curl_init();
    //                     curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    //                     curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    //                     curl_setopt_array($curl, array(
    //                         CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $pts->email . "/events/" . $res->value[0]->id,
    //                         CURLOPT_RETURNTRANSFER => true,
    //                         CURLOPT_ENCODING => "",
    //                         CURLOPT_MAXREDIRS => 10,
    //                         CURLOPT_TIMEOUT => 0,
    //                         CURLOPT_FOLLOWLOCATION => true,
    //                         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                         CURLOPT_CUSTOMREQUEST => "DELETE",
    //                         CURLOPT_HTTPHEADER => array(
    //                             "Authorization: Bearer " . $token
    //                         ),
    //                     ));
    //                     $response = curl_exec($curl);
    //                     curl_close($curl);

    //                     Participant::find($pts->id)->delete();
    //                 }
    //             }
    //         }

    //         foreach ($participants as $email) {
    //             $p = Participant::where('booking_id', $request_booking->id)->where('email', $email)->first();
    //             if (!$p) {
    //                 Participant::create([
    //                     'booking_id' => $request_booking->id,
    //                     'email' => $email,
    //                 ]);
    //             }
    //         }

    //         if ($request_booking->room($request_booking->room)->auto_approve == true) {

    //             if (!is_null($request_booking->calendar_id) && !is_null($request_booking->icaluid) && $request_booking->status == 1) {

    //                 $booking = BookingRequest::find($request->booking_id);
    //                 $start = str_replace(' ', 'T', $request_booking->start);
    //                 $end = str_replace(' ', 'T', $request_booking->end);
    //                 $room_email = $booking->room($request->room_id)->email;

    //                 $qrcode = '<img src="https://chart.googleapis.com/chart?cht=qr&amp;chl=' . $booking->qrcode . '&chs=500x500&chld=L|0" />';
    //                 $content = str_replace('"', "'", $booking->detail . "<br/><br/>" . $qrcode);
    //                 if ($booking->online_meeting == 1) {
    //                     $online_meeting = 'true';
    //                 } else {
    //                     $online_meeting = 'false';
    //                 }

    //                 $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $room_email . "\"},\"type\" : \"resource\"}";

    //                 $attendees[] =  "{\"emailAddress\" : {\"address\" : \"" . User::find($request->booker)->email . "\"},\"type\" : \"required\"}";

    //                 if (count($participants) > 0) {
    //                     foreach ($participants as $email) {
    //                         $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $email . "\"},\"type\" : \"required\"}";
    //                     }
    //                 }

    //                 $attendees = '[' . implode(",", $attendees) . ']';

    //                 $curl = curl_init();
    //                 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    //                 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    //                 curl_setopt_array($curl, array(
    //                     CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $room_email . "/events/" . $request_booking->calendar_id,
    //                     CURLOPT_RETURNTRANSFER => true,
    //                     CURLOPT_ENCODING => "",
    //                     CURLOPT_MAXREDIRS => 10,
    //                     CURLOPT_TIMEOUT => 0,
    //                     CURLOPT_FOLLOWLOCATION => true,
    //                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                     CURLOPT_CUSTOMREQUEST => "PATCH",
    //                     CURLOPT_POSTFIELDS => "{\"subject\": \"" . $booking->title .
    //                         "\",\"body\": {\"contentType\": \"HTML\",\"content\": \"" . $content .
    //                         "\"},\"start\": {\"dateTime\": \"" . $start .
    //                         "\",\"timeZone\": \"Asia/Bangkok\"},\"end\": {\"dateTime\": \"" . $end .
    //                         "\",\"timeZone\": \"Asia/Bangkok\"},\"isOnlineMeeting\":\"" . $online_meeting .
    //                         "\",\"onlineMeetingProvider\":\"teamsForBusiness\",\"location\":{\"locationType\":\"conferenceRoom\",\"displayName\": \"" . $booking->title .
    //                         "\",\"locationEmailAddress\": \"" . $room_email . "\"},\"attendees\":  " . $attendees . "}",
    //                     CURLOPT_HTTPHEADER => array(
    //                         "Authorization: Bearer " . $token,
    //                         "Content-Type: application/json"
    //                     ),
    //                 ));

    //                 $response = curl_exec($curl);
    //                 curl_close($curl);

    //                 $curl = curl_init();
    //                 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    //                 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    //                 curl_setopt_array($curl, array(
    //                     CURLOPT_URL => "dev.lanna.co.th/api/booking/EditEvent",
    //                     CURLOPT_RETURNTRANSFER => true,
    //                     CURLOPT_ENCODING => "",
    //                     CURLOPT_MAXREDIRS => 10,
    //                     CURLOPT_TIMEOUT => 0,
    //                     CURLOPT_FOLLOWLOCATION => true,
    //                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                     CURLOPT_CUSTOMREQUEST => "POST",
    //                     CURLOPT_POSTFIELDS => "{\r\n    \"Room_Email\":\"" . $room_email .
    //                         "\",\r\n    \"Event_ID\":\"" . $request_booking->calendar_id .
    //                         "\",\r\n    \"StartDate\":\"" . $start .
    //                         "\",\r\n    \"EndDate\":\"" . $end . "\",\r\n}",
    //                     CURLOPT_HTTPHEADER => array(
    //                         "Content-Type: application/json"
    //                     ),
    //                 ));

    //                 $response = curl_exec($curl);
    //                 curl_close($curl);
    //             } else {
    //             }

    //             $notification = array(
    //                 'message' => 'Booking update successfully!',
    //                 'alert-type' => 'success'
    //             );
    //         } else {
    //             $request_booking->status = NULL;
    //             $request_booking->save();

    //             $notification = array(
    //                 'message' => 'Booking update successfully! The request is being processed.',
    //                 'alert-type' => 'success'
    //             );
    //         }

    //         return redirect()->back()->with($notification);
    //     } else {
    //         if (!is_null($request->booker)) {
    //             $room = Room::find($request->room_id);
    //             $request_booking = new BookingRequest();
    //             $request_booking->qrcode = uniqid();
    //             $request_booking->booker = $request->booker;
    //             $request_booking->room = $request->room_id;
    //             $request_booking->title = $request->title;
    //             $request_booking->start = $this->convertToSQLDate($request->start);
    //             $request_booking->end = $this->convertToSQLDate($request->end);
    //             $request_booking->hour = abs(strtotime($request_booking->end) - strtotime($request_booking->start)) / (60 * 60);
    //             $request_booking->detail = $request->detail;
    //             $request_booking->online_meeting = $request->online_meeting == "true" ? true : false;

    //             if (is_null($request->participants)) {
    //                 $participants  = [];
    //             } else {
    //                 $participants = explode(',', $request->participants);
    //             }

    //             if ($room->auto_approve == false) {
    //                 $request_booking->status = NULL;
    //                 $request_booking->save();

    //                 foreach ($participants as $email) {
    //                     Participant::create([
    //                         'booking_id' => $request_booking->id,
    //                         'email' => $email,
    //                     ]);
    //                 }
    //             } else {
    //                 $request_booking->status = true;
    //                 $request_booking->save();

    //                 foreach ($participants as $email) {
    //                     Participant::create([
    //                         'booking_id' => $request_booking->id,
    //                         'email' => $email,
    //                     ]);
    //                 }

    //                 $token = getToken();
    //                 $booking_request = BookingRequest::find($request_booking->id);
    //                 $subject = $booking_request->title;
    //                 $start = str_replace(' ', 'T', $booking_request->start);
    //                 $end = str_replace(' ', 'T', $booking_request->end);
    //                 $room_email = $booking_request->room($request->room_id)->email;
    //                 $organizer = $room_email;
    //                 $qrcode = '<img src="https://chart.googleapis.com/chart?cht=qr&amp;chl=' . $booking_request->qrcode . '&chs=500x500&chld=L|0" />';
    //                 $content = str_replace('"', "'", $booking_request->detail . "<br/>" . $qrcode);
    //                 if ($booking_request->online_meeting == 1) {
    //                     $online_meeting = 'true';
    //                 } else {
    //                     $online_meeting = 'false';
    //                 }

    //                 $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $room_email . "\"},\"type\" : \"resource\"}";

    //                 $attendees[] =  "{\"emailAddress\" : {\"address\" : \"" . User::find($request->booker)->email . "\"},\"type\" : \"required\"}";

    //                 if (count($participants) > 0) {
    //                     foreach ($participants as $email) {
    //                         $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $email . "\"},\"type\" : \"required\"}";
    //                     }
    //                 }

    //                 $attendees = '[' . implode(",", $attendees) . ']';
    //                 $calendar = createEvent($token, $organizer, $subject, $content, $start, $end, $subject, $room_email, $online_meeting, $attendees);

    //                 $booking_request->calendar_id = $calendar->id;
    //                 $booking_request->icaluid = $calendar->uid;
    //                 $booking_request->save();

    //                 $curl = curl_init();
    //                 curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    //                 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    //                 curl_setopt_array($curl, array(
    //                     CURLOPT_URL => "dev.lanna.co.th/api/booking/QREvent",
    //                     CURLOPT_RETURNTRANSFER => true,
    //                     CURLOPT_ENCODING => "",
    //                     CURLOPT_MAXREDIRS => 10,
    //                     CURLOPT_TIMEOUT => 0,
    //                     CURLOPT_FOLLOWLOCATION => true,
    //                     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //                     CURLOPT_CUSTOMREQUEST => "POST",
    //                     CURLOPT_POSTFIELDS => "{\r\n    \"Room_Email\":\"" . $room_email .
    //                         "\",\r\n    \"Organizer\":\"" . $organizer .
    //                         "\",\r\n    \"Event_ID\":\"" . $calendar->id .
    //                         "\",\r\n    \"StartDate\":\"" . $booking_request->start .
    //                         "\",\r\n    \"EndDate\":\"" . $booking_request->end .
    //                         "\",\r\n    \"QR_Code\":\"" . $booking_request->qrcode . "\"\r\n}",
    //                     CURLOPT_HTTPHEADER => array(
    //                         "Content-Type: application/json"
    //                     ),
    //                 ));
    //                 $response = curl_exec($curl);
    //                 curl_close($curl);
    //             }
    //             $notification = array(
    //                 'message' => 'Booking successfully!',
    //                 'alert-type' => 'success'
    //             );
    //             return redirect()->back()->with($notification);
    //         } else {
    //             $notification = array(
    //                 'message' => 'Error',
    //                 'alert-type' => 'error'
    //             );
    //             return redirect()->back()->with($notification);
    //         }
    //     }
    // }

    public function store(Request $request)
    {
        //dd($request->all());

        // convert participants string to array
        $request->merge([
            'participants' => json_decode($request->participants) ?? [],
        ]);

        $participants = $request->participants->participant;
        $email_checker = [];

        $token = getToken();

        // update booking
        if (!is_null($request->booking_id)) {
            //dd($request->all());
            // update booking detail
            $request_booking = BookingRequest::Find($request->booking_id);

            $old_start = $request_booking->start;
            $old_end = $request_booking->end;

            $request_booking->title = $request->title;
            $request_booking->start = $this->convertToSQLDate($request->start);
            $request_booking->end = $this->convertToSQLDate($request->end);
            $request_booking->hour = abs(strtotime($request_booking->end) - strtotime($request_booking->start)) / (60 * 60);
            $request_booking->detail = $request->detail;
            $request_booking->online_meeting = $request->online_meeting == "true" ? true : false;
            $request_booking->save();

            $attendees = [];
            $attendees_qr = [];

            // create participant
            if (count($participants) > 0) {

                // set booker to participant
                $booker = User::find($request_booking->booker);

                $attendees_qr[] = '{"email" : "' . $booker->email . '", "member_no": "", "member_key": ""}';

                foreach ($participants as $key => $value) {
                    if ($value->email != $booker->email) {
                        $email_checker[] = $value->email;
                    }
                }

                // remove unselect participant
                $allp = Participant::where('booking_id', $request_booking->id)->get();

                if ($allp) {
                    foreach ($allp as $pts) {
                        if (!in_array($pts->email, $email_checker)) {
                            // search participant in graph
                            $curl = curl_init();
                            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                            curl_setopt_array($curl, array(
                                CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $pts->email . "/events?filter=iCalUId%20eq%20'" . $request_booking->icaluid . "'",
                                CURLOPT_RETURNTRANSFER => true,
                                CURLOPT_ENCODING => "",
                                CURLOPT_MAXREDIRS => 10,
                                CURLOPT_TIMEOUT => 0,
                                CURLOPT_FOLLOWLOCATION => true,
                                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                CURLOPT_CUSTOMREQUEST => "GET",
                                CURLOPT_HTTPHEADER => array(
                                    "Authorization: Bearer " . $token
                                ),
                            ));

                            $response = curl_exec($curl);
                            curl_close($curl);

                            $res = json_decode($response);

                            // remove unselect participant in graph
                            if (isset($res->value[0]->id)) {

                                $curl = curl_init();
                                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $pts->email . "/events/" . $res->value[0]->id,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "DELETE",
                                    CURLOPT_HTTPHEADER => array(
                                        "Authorization: Bearer " . $token
                                    ),
                                ));
                                $response = curl_exec($curl);
                                curl_close($curl);
                            }

                            // remove unselect participant in db
                            Participant::find($pts->id)->delete();
                        }
                    }
                }

                // add new participant
                foreach ($participants as $p_user) {
                    if (isset($p_user->email) && $p_user->email != $booker->email) {
                        $p = Participant::where('booking_id', $request_booking->id)->where('email', $p_user->email)->first();
                        if (!$p) {
                            Participant::create([
                                'booking_id' => $request_booking->id,
                                'email' => $p_user->email,
                            ]);
                            $attendees_qr[] = '{"email" : "' . $p_user->email . '", "member_no": "", "member_key": ""}';
                        } else {
                            $attendees_qr[] = '{"email" : "' . $p->email . '", "member_no": "", "member_key": ""}';
                        }
                    }
                }
            }

            if ($request_booking->room($request_booking->room)->auto_approve == true) {

                if (!is_null($request_booking->calendar_id) && !is_null($request_booking->icaluid) && $request_booking->status == 1) {

                    // set booking data for API
                    $booking = BookingRequest::find($request->booking_id);
                    $start = str_replace(' ', 'T', $booking->start);
                    $end = str_replace(' ', 'T', $booking->end);

                    $room = Room::find($booking->room);
                    $booker = User::find($booking->booker);
                    $approver = User::find($room->approver);

                    $qrcode = '<img src="https://chart.googleapis.com/chart?cht=qr&amp;chl=' . $booking->qrcode . '&chs=500x500&chld=L|0" />';

                    if ($booking->online_meeting == 1) {
                        $online_meeting = 'true';
                    } else {
                        $online_meeting = 'false';
                    }

                    $db_participants = Participant::where('booking_id', $booking->id)->get();

                    $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $room->email . "\"},\"type\" : \"resource\"}";

                    $attendees[] =  "{\"emailAddress\" : {\"address\" : \"" . $booker->email . "\"},\"type\" : \"required\"}";

                    if (count($db_participants) > 0) {
                        foreach ($db_participants as $v) {
                            if ($v->email != $booker->email) {
                                $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $v->email . "\"},\"type\" : \"required\"}";
                            }
                        }
                    }

                    $attendees = '[' . implode(",", $attendees) . ']';
                    $attendees_qr = '[' . implode(",", $attendees_qr) . ']';

                    // send API
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "dev.lanna.co.th/api/booking/EditEvent",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => '{"Room_Email" : "' . $room->email . '",' .
                            '"Organizer" : "' . $room->email . '",' .
                            '"Event_ID" : "' . $booking->calendar_id . '",' .
                            '"ID" : "' . $request->api_booking_id . '",' .
                            '"StartDate" : "' . $booking->start . '",' .
                            '"EndDate" : "' . $booking->end . '",' .
                            '"QR_Code" : "' . $booking->qrcode . '",' .
                            '"Subject" : "' . $booking->title . '",' .
                            '"Detail" : "' . $booking->detail . '",' .
                            '"Online_Meeting" : ' . $online_meeting . ',' .
                            '"Attendee" : ' . $attendees_qr . '}',
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json"
                        ),
                    ));
                    $response = json_decode(curl_exec($curl));
                    curl_close($curl);

                    $access_detail = '';

                    $access_detail = $access_detail . 'การจองของท่านได้รับการอนุมัติแล้ว' . '<br/>' .
                        'ห้อง : ' . $room->name . ''  . '<br/>' .
                        'วันที่ทำการจอง : ' . date('H:i', strtotime($booking->start)) . ' - ' . date('H:i d/m/Y', strtotime($booking->end));
                    //'ผู้เข้าร่วมแต่ละคนสามารถเปิดประตูหน้าห้องได้ด้วยวิธีการดังต่อไปนี้ :<br/>';

                    // if (!is_null($response)) {
                    //     foreach ($response as $key => $value) {
                    //         $name = $value->Attendee_Email;
                    //         if ($value->Face == true) {
                    //             $face = ', Face';
                    //         } else {
                    //             $face = NULL;
                    //         }
                    //         if (is_null($face)) {
                    //             $qr_code = 'QR Code';
                    //         } else {
                    //             $qr_code = '';
                    //         }
                    //         $access_detail = $access_detail . $name . ' : '  . $face . $qr_code . '<br/>';
                    //     }
                    // }

                    //$logo = '<img src="https://room.kku.ac.th/web/img/kkul-logo.jpg" width="250px" />';
                    $content = str_replace('"', "'", $booking->detail . "<br/><br/>" .
                        $access_detail . "<br/><br/>" .
                        "ท่านสามารใช้ QR Code ด้านล่างนี้เพื่อแสกนเข้าห้องได้" . "<br/><br/>" . $qrcode);

                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $room->email . "/events/" . $booking->calendar_id,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "PATCH",
                        CURLOPT_POSTFIELDS => "{\"subject\": \"" . $booking->title .
                            "\",\"body\": {\"contentType\": \"HTML\",\"content\": \"" . $content .
                            "\"},\"start\": {\"dateTime\": \"" . $start .
                            "\",\"timeZone\": \"Asia/Bangkok\"},\"end\": {\"dateTime\": \"" . $end .
                            "\",\"timeZone\": \"Asia/Bangkok\"},\"isOnlineMeeting\":\"" . $online_meeting .
                            "\",\"onlineMeetingProvider\":\"teamsForBusiness\",\"location\":{\"locationType\":\"conferenceRoom\",\"displayName\": \"" . $booking->title .
                            "\",\"locationEmailAddress\": \"" . $room->email . "\"},\"attendees\":  " . $attendees . "}",
                        CURLOPT_HTTPHEADER => array(
                            "Authorization: Bearer " . $token,
                            "Content-Type: application/json"
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);

                    if (\Config::get('app.locale') == 'en') {
                        $notification = array(
                            'message' => 'Booking update successfully!',
                            'alert-type' => 'success'
                        );
                    } else {
                        $notification = array(
                            'message' => 'อัปเดตการจองเรียบร้อยแล้ว!',
                            'alert-type' => 'success'
                        );
                    }
                } else {
                    if (\Config::get('app.locale') == 'en') {
                        $notification = array(
                            'message' => 'Booking update fail!',
                            'alert-type' => 'error'
                        );
                    } else {
                        $notification = array(
                            'message' => 'การอัปเดตการจองล้มเหลว!',
                            'alert-type' => 'error'
                        );
                    }
                }
            } else {
                $room = Room::find($request->room_id);
                $request_booking->status = NULL;
                $request_booking->save();

                if (\Config::get('app.locale') == 'en') {
                    $notification = array(
                        'message' => 'Booking update successfully! The request is being processed.',
                        'alert-type' => 'success'
                    );
                } else {
                    $notification = array(
                        'message' => 'อัปเดตการจองเรียบร้อยแล้ว! กำลังดำเนินการตามคำขอ ',
                        'alert-type' => 'success'
                    );
                }

                $booker = User::find($request_booking->booker);
                $approver = User::find($room->approver);
                $title = 'คำร้องขอการจองห้อง ' . $room->name . ' โดย ' . $booker->name . ' (แก้ไข)';
                $body = 'ผู้ร้องขอ : ' . $booker->name . '' . '<br/>' .
                    'ห้อง : ' . $room->name . ''  . '<br/>' .
                    'วันที่ทำการจอง : ' . date('H:i', strtotime($old_start)) . ' - ' . date('H:i d/m/Y', strtotime($old_end)) . '' . '<br/>' .
                    'แก้ไขเป็น : ' . date('H:i', strtotime($request_booking->start)) . ' - ' . date('H:i d/m/Y', strtotime($request_booking->end)) . '' . '<br/>' .
                    'ท่านสามารถจัดการการจองห้องได้ที่ : <a href="https://room.kku.ac.th/web/backend/booking-request">LINK<a/>' . '<br/>' . '<br/>';

                // send mail to approver
                $this->requestEmail($room->email, $room->password, $approver->email, $title, $body);
            }

            return redirect()->back()->with($notification);
        } else {
            // insert booking

            // check booker
            if (is_null($request->booker) && !is_null(session()->get('uid'))) {
                $request->merge(['booker' => session()->get('uid')]);
            }

            if (!is_null($request->booker)) {
                // create event
                $room = Room::find($request->room_id);
                $request_booking = new BookingRequest();
                $request_booking->qrcode = uniqid();
                $request_booking->booker = $request->booker;
                $request_booking->room = $request->room_id;
                $request_booking->title = $request->title;
                $request_booking->start = $this->convertToSQLDate($request->start);
                $request_booking->end = $this->convertToSQLDate($request->end);
                $request_booking->hour = abs(strtotime($request_booking->end) - strtotime($request_booking->start)) / (60 * 60);
                $request_booking->detail = $request->detail;
                $request_booking->online_meeting = $request->online_meeting == "true" ? true : false;

                // check auto_approve
                if ($room->auto_approve == false) {
                    $request_booking->status = NULL;
                    $request_booking->save();

                    $booker = User::find($request_booking->booker);
                    $approver = User::find($room->approver);

                    // create participant
                    if (count($participants) > 0) {
                        foreach ($participants as $p_user) {
                            if (isset($p_user->email) && $p_user->email != $booker->email) {
                                Participant::create([
                                    'booking_id' => $request_booking->id,
                                    'email' => $p_user->email,
                                ]);
                            }
                        }
                    }

                    $title = 'คำร้องขอการจองห้อง ' . $room->name . ' โดย ' . $booker->name . '';
                    $body = 'ผู้ร้องขอ : ' . $booker->name . '' . '<br/>' .
                        'ห้อง : ' . $room->name . ''  . '<br/>' .
                        'วันที่ทำการจอง : ' . date('H:i', strtotime($request_booking->start)) . ' - ' . date('H:i d/m/Y', strtotime($request_booking->end)) . '' . '<br/>' .
                        'ท่านสามารถจัดการการจองห้องได้ที่ : <a href="https://room.kku.ac.th/web/backend/booking-request">LINK<a/>' . '<br/>' . '<br/>';

                    // send mail to approver
                    $this->requestEmail($room->email, $room->password, $approver->email, $title, $body);

                    if (\Config::get('app.locale') == 'en') {
                        $notification = array(
                            'message' => 'Booking successfully! The request is being processed.',
                            'alert-type' => 'success'
                        );
                    } else {
                        $notification = array(
                            'message' => 'จองสำเร็จ! กำลังดำเนินการตามคำขอ ',
                            'alert-type' => 'success'
                        );
                    }

                    return redirect()->back()->with($notification);
                } else {
                    // auto approve = true
                    $request_booking->status = true;
                    $request_booking->save();

                    $room = Room::find($request_booking->room);
                    $booker = User::find($request_booking->booker);
                    $approver = User::find($room->approver);

                    $attendees = [];
                    $attendees_qr = [];

                    // set room to resource
                    $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $room->email . "\"},\"type\" : \"resource\"}";

                    $attendees[] =  "{\"emailAddress\" : {\"address\" : \"" . $booker->email . "\"},\"type\" : \"required\"}";

                    $attendees_qr[] = '{"email" : "' . $booker->email . '", "member_no": "' . $booker->citizen_id . '", "member_key": ""}';

                    // create participant
                    if (count($participants) > 0) {
                        foreach ($participants as $p_user) {
                            if (isset($p_user->email) && $p_user->email != $booker->email) {
                                $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $p_user->email . "\"},\"type\" : \"required\"}";
                                $attendees_qr[] = '{"email" : "' . $p_user->email . '", "member_no": "", "member_key": ""}';
                            }
                        }
                    }

                    $attendees = '[' . implode(",", $attendees) . ']';
                    $attendees_qr = '[' . implode(",", $attendees_qr) . ']';

                    // set booking data for MS GRAPH
                    $booking_request = BookingRequest::find($request_booking->id);
                    $subject = $booking_request->title;
                    $start = str_replace(' ', 'T', $booking_request->start);
                    $end = str_replace(' ', 'T', $booking_request->end);
                    $room_email = $booking_request->room($request->room_id)->email;
                    $organizer = $room_email;
                    $qrcode = '<img src="https://chart.googleapis.com/chart?cht=qr&amp;chl=' . $booking_request->qrcode . '&chs=500x500&chld=L|0" />';

                    if ($booking_request->online_meeting == 1) {
                        $online_meeting = 'true';
                    } else {
                        $online_meeting = 'false';
                    }



                    $access_detail = '';

                    $access_detail = $access_detail . 'การจองของท่านได้รับการอนุมัติแล้ว' . '<br/>' .
                        'ห้อง : ' . $room->name . ''  . '<br/>' .
                        'วันที่ทำการจอง : ' . date('H:i', strtotime($request_booking->start)) . ' - ' . date('H:i d/m/Y', strtotime($request_booking->end));
                    //'ผู้เข้าร่วมแต่ละคนสามารถเปิดประตูหน้าห้องได้ด้วยวิธีการดังต่อไปนี้ :<br/>';

                    // if (!is_null($response)) {
                    //     foreach ($response as $key => $value) {
                    //         $name = $value->Attendee_Email;
                    //         if ($value->Face == true) {
                    //             $face = ', Face';
                    //         } else {
                    //             $face = NULL;
                    //         }
                    //         if (is_null($face)) {
                    //             $qr_code = 'QR Code';
                    //         } else {
                    //             $qr_code = '';
                    //         }
                    //         $access_detail = $access_detail . $name . ' : '  . $face . $qr_code . '<br/>';
                    //     }
                    // }

                    //$logo = '<img src="https://room.kku.ac.th/web/img/kkul-logo.jpg" width="250px" />';
                    $content = str_replace('"', "'", $booking_request->detail . "<br/><br/>" .
                        $access_detail . "<br/><br/>" .
                        "ท่านสามารใช้ QR Code ด้านล่างนี้เพื่อแสกนเข้าห้องได้" . "<br/><br/>" . $qrcode);

                    $calendar = createEvent($token, $organizer, $subject, $content, $start, $end, $subject, $room_email, $online_meeting, $attendees);


                    // send API
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "dev.lanna.co.th/api/booking/QREvent",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => '{"Room_Email" : "' . $room_email . '",' .
                            '"Organizer" : "' . $room_email . '",' .
                            '"Event_ID" : "' . $calendar->id . '",' .
                            '"StartDate" : "' . $booking_request->start . '",' .
                            '"EndDate" : "' . $booking_request->end . '",' .
                            '"QR_Code" : "' . $booking_request->qrcode . '",' .
                            '"Subject" : "' . $booking_request->title . '",' .
                            '"Detail" : "' . $booking_request->detail . '",' .
                            '"Online_Meeting" : false,' .
                            '"Attendee" : ' . $attendees_qr . '}',
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json"
                        ),
                    ));
                    $response = json_decode(curl_exec($curl));
                    curl_close($curl);

                    $booking_request->calendar_id = $calendar->id;
                    $booking_request->icaluid = $calendar->uid;
                    $booking_request->save();

                    if (\Config::get('app.locale') == 'en') {
                        $notification = array(
                            'message' => 'Booking successfully!',
                            'alert-type' => 'success'
                        );
                    } else {
                        $notification = array(
                            'message' => 'จองสำเร็จ!',
                            'alert-type' => 'success'
                        );
                    }

                    if ($request->dashboard_booking == "true") {
                        return redirect()->route('logout', [
                            'logout' => true,
                            'message' => $notification['message'],
                            'type' => $notification['alert-type'],

                        ]);
                    } else {
                        return redirect()->back()->with($notification);
                    }
                }
            } else {
                if (\Config::get('app.locale') == 'en') {
                    $notification = array(
                        'message' => 'Error: Account is invalid',
                        'alert-type' => 'error'
                    );
                } else {
                    $notification = array(
                        'message' => 'ข้อผิดพลาด: บัญชีไม่ถูกต้อง',
                        'alert-type' => 'error'
                    );
                }
                return redirect()->back()->with($notification);
            }
        }
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

    public function action(Request $request)
    {

        $token = getToken();

        switch ($request->type) {
            case 0:
                $booking_request = BookingRequest::find($request->id);
                $booking_request->status = false;
                $booking_request->save();
                break;
            case 1:
                $booking_request = BookingRequest::find($request->id);
                $subject = $booking_request->title;
                $start = str_replace(' ', 'T', $booking_request->start);
                $end = str_replace(' ', 'T', $booking_request->end);
                $room_email = $booking_request->room($booking_request->room)->email;
                $organizer = $room_email;
                $qrcode = '<img src="https://chart.googleapis.com/chart?cht=qr&amp;chl=' . $booking_request->qrcode . '&chs=500x500&chld=L|0" />';
                $content = str_replace('"', "'", $booking_request->detail . "<br/>" . $qrcode);

                if ($booking_request->online_meeting == 1) {
                    $online_meeting = 'true';
                } else {
                    $online_meeting = 'false';
                }

                $participants = Participant::select('email')->where('booking_id', $booking_request->id)->get();

                $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $room_email . "\"},\"type\" : \"resource\"}";

                $attendees[] =  "{\"emailAddress\" : {\"address\" : \"" . User::find($booking_request->booker)->email . "\"},\"type\" : \"required\"}";

                if (count($participants) > 0) {
                    foreach ($participants as $p) {
                        Participant::create(['booking_id' => $booking_request->id, 'email' => $p->email]);
                        $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $p->email . "\"},\"type\" : \"required\"}";
                    }
                }

                $attendees = '[' . implode(",", $attendees) . ']';

                $calendar = createEvent($token, $organizer, $subject, $content, $start, $end, $subject, $room_email, $online_meeting, $attendees);

                $booking_request->calendar_id = $calendar->id;
                $booking_request->icaluid = $calendar->uid;
                $booking_request->save();

                if (isset($calendar->error)) {
                    return response()->json(json_decode(json_encode($calendar)));
                } else {
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "dev.lanna.co.th/api/booking/QREvent",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "{\r\n    \"Room_Email\":\"" . $room_email .
                            "\",\r\n    \"Organizer\":\"" . $organizer .
                            "\",\r\n    \"Event_ID\":\"" . $calendar->id .
                            "\",\r\n    \"StartDate\":\"" . $booking_request->start .
                            "\",\r\n    \"EndDate\":\"" . $booking_request->end .
                            "\",\r\n    \"QR_Code\":\"" . $booking_request->qrcode . "\"\r\n}",
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json"
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);

                    $booking_request->status = true;
                    $booking_request->save();
                }
                break;
            case 3:
                $booking_request = BookingRequest::find($request->id);
                $booking_request->status = false;
                $booking_request->cancel = true;
                $booking_request->save();

                $room_email = $booking_request->room($booking_request->room)->email;

                if (!is_null($booking_request->calendar_id) && !is_null($booking_request->icaluid)) {

                    // Cancel on webservice
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "dev.lanna.co.th/api/booking/CancelEvent",
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "POST",
                        CURLOPT_POSTFIELDS => "{\r\n    \"Room_Email\":\"" . $room_email .
                            "\",\r\n    \"Event_ID\":\"" . $booking_request->calendar_id . "\"}",
                        CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json"
                        ),
                    ));

                    $response = curl_exec($curl);
                    curl_close($curl);

                    // Cancel main calendar
                    $curl = curl_init();
                    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $room_email . "/events/" . $booking_request->calendar_id,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => "",
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => "DELETE",
                        CURLOPT_HTTPHEADER => array(
                            "Authorization: Bearer " . $token
                        ),
                    ));
                    $response = curl_exec($curl);
                    curl_close($curl);

                    // Cancel on participant
                    $participant = Participant::where('booking_id', $booking_request->id)->get();

                    foreach ($participant as $key => $value) {
                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $value->email . "/events?filter=iCalUId%20eq%20'" . $booking_request->icaluid . "'",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => array(
                                "Authorization: Bearer " . getToken()
                            ),
                        ));

                        $response = curl_exec($curl);
                        curl_close($curl);

                        $res = json_decode($response);

                        $curl = curl_init();
                        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $value->email . "/events/" . $res->value[0]->id,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_MAXREDIRS => 10,
                            CURLOPT_TIMEOUT => 0,
                            CURLOPT_FOLLOWLOCATION => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "DELETE",
                            CURLOPT_HTTPHEADER => array(
                                "Authorization: Bearer " . $token
                            ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                    }
                }

                break;
            case 4:
                $booking_request = BookingRequest::find($request->id);
                $booking_request->status = true;
                $booking_request->save();

                $participant = Participant::where('booking_id', $booking_request->id)->get();

                $start = str_replace(' ', 'T', $booking_request->start);
                $end = str_replace(' ', 'T', $booking_request->end);

                $room_email = $booking_request->room($booking_request->room)->email;

                $qrcode = '<img src="https://chart.googleapis.com/chart?cht=qr&amp;chl=' . $booking_request->qrcode . '&chs=500x500&chld=L|0" />';
                $content = str_replace('"', "'", $booking_request->detail . "<br/><br/>" . $qrcode);
                if ($booking_request->online_meeting == 1) {
                    $online_meeting = 'true';
                } else {
                    $online_meeting = 'false';
                }

                $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $room_email . "\"},\"type\" : \"resource\"}";

                $attendees[] =  "{\"emailAddress\" : {\"address\" : \"" . User::find($booking_request->booker)->email . "\"},\"type\" : \"required\"}";

                if (count($participant) > 0) {
                    foreach ($participant as $key => $value) {
                        $attendees[] = "{\"emailAddress\" : {\"address\" : \"" . $value->email . "\"},\"type\" : \"required\"}";
                    }
                }

                $attendees = '[' . implode(",", $attendees) . ']';

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $room_email . "/events/" . $booking_request->calendar_id,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "PATCH",
                    CURLOPT_POSTFIELDS => "{\"subject\": \"" . $booking_request->title .
                        "\",\"body\": {\"contentType\": \"HTML\",\"content\": \"" . $content .
                        "\"},\"start\": {\"dateTime\": \"" . $start .
                        "\",\"timeZone\": \"Asia/Bangkok\"},\"end\": {\"dateTime\": \"" . $end .
                        "\",\"timeZone\": \"Asia/Bangkok\"},\"isOnlineMeeting\":\"" . $online_meeting .
                        "\",\"onlineMeetingProvider\":\"teamsForBusiness\",\"location\":{\"locationType\":\"conferenceRoom\",\"displayName\": \"" . $booking_request->title .
                        "\",\"locationEmailAddress\": \"" . $room_email . "\"},\"attendees\":  " . $attendees . "}",
                    CURLOPT_HTTPHEADER => array(
                        "Authorization: Bearer " . $token,
                        "Content-Type: application/json"
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);

                $curl = curl_init();
                curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "dev.lanna.co.th/api/booking/EditEvent",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{\r\n    \"Room_Email\":\"" . $room_email .
                        "\",\r\n    \"Event_ID\":\"" . $booking_request->calendar_id .
                        "\",\r\n    \"StartDate\":\"" . $start .
                        "\",\r\n    \"EndDate\":\"" . $end . "\",\r\n}",
                    CURLOPT_HTTPHEADER => array(
                        "Content-Type: application/json"
                    ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                break;
            case 5:
                break;
        }

        return response()->json(true);
    }

    public function convertToSQLDate($date)
    {
        $date = explode(' ', $date);
        $d = explode('/', $date[0]);
        return $d[2] . '-' . $d[1] . '-' . $d[0] . ' ' . $date[1] . ':00';
    }

    public function check_booking_permission(Request $request)
    {
        $limit_per_day = (float)\Session::get('booking-per-day');
        $limit_per_week = (float)\Session::get('booking-per-week');

        $start_of_day = date('Y-m-d 00:00:00', strtotime(date('Y-m-d', strtotime($request->start))));
        $end_of_day = date('Y-m-d 23:59:59', strtotime(date('Y-m-d', strtotime($request->end))));

        $start_of_week = date('Y-m-d 00:00:00', strtotime('previous sunday', strtotime(date('Y-m-d', strtotime($request->start)))));
        $end_of_week = date('Y-m-d 23:59:59', strtotime('next saturday', strtotime(date('Y-m-d', strtotime($request->end)))));

        $booking_in_week =  Bookingrequest::where('booker', \Session::get('uid'))
            ->where('status', true)
            ->whereBetween('start', [$start_of_week, $end_of_week])
            ->whereBetween('end', [$start_of_week, $end_of_week])
            ->get()->count();

        $x['count'] = $booking_in_week;

        if ($booking_in_week < $limit_per_week) {
            $booking_in_day = Bookingrequest::where('booker', \Session::get('uid'))
                ->where('status', true)
                ->whereBetween('start', [$start_of_day, $end_of_day])
                ->whereBetween('end', [$start_of_day, $end_of_day])
                ->get()->count();

            $x['count'] = $booking_in_day;

            if ($booking_in_day < $limit_per_day) {

                if (isset($request->room_id)) {
                    $booking_duplicate = Bookingrequest::where('status', true)
                        ->whereBetween('start', [$request->start, $request->end])
                        ->where('room', $request->room_id)
                        ->get()->count();

                    if ($booking_duplicate > 0) {
                        $x['result'] = false;
                        $x['type'] = 'duplicate';
                        return response()->json($x);
                    } else {
                        $x['result'] = true;
                        return response()->json($x);
                    }
                } else {
                    $x['result'] = true;
                    return response()->json($x);
                }
            } else {
                $x['result'] = false;
                $x['type'] = 'day';
                return response()->json($x);
            }
        } else {
            $x['result'] = false;
            $x['type'] = 'week';
            return response()->json($x);
        }
    }
}
