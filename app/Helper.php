<?php

function getToken()
{

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://login.microsoftonline.com/195c2309-d731-4bfe-98ce-ea7b0bf5a899/oauth2/v2.0/token",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "grant_type=client_credentials&client_id=41b1320b-2075-47c5-866a-41e8d5c7f090&client_secret=0zznLI42_W.OYh7g2f8NqqITLN6_t-_vrg&scope=https://graph.microsoft.com/.default",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
        ),
    ));


    $response = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($response);
    return $res->access_token;
}
function getUserID($Token, $RoomMail)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $RoomMail,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $Token
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($response);
    if (isset($res->error)) {
        return $res;
    } else {
        return $res->id;
    }
    //return $res->id ;
}

function CalendarDetail($Token, $UID, $startDay, $endDay)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://graph.microsoft.com/v1.0/users/" . $UID . "/calendarView/delta?startdatetime=" . $startDay . "T00:00:00.0000000&enddatetime=" . $endDay . "T23:59:59.0000000",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer " . $Token
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($response);
    if (isset($res->error)) {
        return $res;
    } else {
        return $res->value;
    }
}
function getAttend($Token, $GID)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://graph.microsoft.com/v1.0/groups/" . $GID . "/members",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "SdkVersion: postman-graph/v1.0",
            "Authorization: Bearer " . $Token
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $res = json_decode($response);
    return $res->value;
}
function createEvent($Token, $organizer, $subject, $body, $start, $end, $classroom, $room_email, $OnlineMeeting, $attendees)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://graph.microsoft.com/beta/users/" . $organizer . "/calendar/events",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "{\"subject\": \"" . $subject .
            "\",\"body\": {\"contentType\": \"HTML\",\"content\": \"" . $body .
            "\"},\"start\": {\"dateTime\": \"" . $start .
            "\",\"timeZone\": \"Asia/Bangkok\"},\"end\": {\"dateTime\": \"" . $end .
            "\",\"timeZone\": \"Asia/Bangkok\"},\"isOnlineMeeting\":\"" . $OnlineMeeting .
            "\",\"onlineMeetingProvider\":\"teamsForBusiness\",\"location\":{\"locationType\":\"conferenceRoom\",\"displayName\": \"" . $classroom .
            "\",\"locationEmailAddress\": \"" . $room_email . "\"},\"attendees\":  ". $attendees . "}",
        CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer " . $Token
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($response);
    if (isset($res->error)) {
        return $res;
    } else {
        return $res;
    }
}
