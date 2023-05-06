<?php

namespace App\Http\Controllers;

use App\Configurations;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;

class SetupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domain_check = Configurations::where('name', 'domain')->first();

        if(is_null($domain_check->value)){
            return view('setting');
        }
        else {
            return redirect()->route('auth.login');
        }
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
        //dd($request->all());

        $this->validate($request, [
            'domain' => 'required',
            'suffix' => 'required',
            'organization' => 'required',
            'admin-username' => 'required',
            'admin-password' => 'required',
        ]);

        $arr["data"] = [];
        $numb = 0;
        $send = "{\\\"data\\\":[";

        foreach ($request->except('_token') as $key => $value) {
            $arr["data"][$numb]["name"] = $key;
            $arr["data"][$numb]["value"] = $value;
            if ($numb == 0) {
                $send .= "{\\\"name\\\":\\\"" . $key . "\\\",\\\"value\\\":\\\"" . $value . "\\\"}";
            } else {
                $send .= ",{\\\"name\\\":\\\"" . $key . "\\\",\\\"value\\\":\\\"" . $value . "\\\"}";
            }
            $numb++;
        }

        $send .= "]}";

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://ws.lanna.co.th/Ads/addsettings",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",

            CURLOPT_POSTFIELDS => "{\"data\":[{\"name\":\"" . $arr["data"][0]["name"] .
                "\",\"value\":\"" . $arr["data"][0]["value"] .
                "\"},{\"name\":\"" . $arr["data"][1]["name"] .
                "\",\"value\":\"" . $arr["data"][1]["value"] .
                "\"},{\"name\":\"" . $arr["data"][2]["name"] .
                "\",\"value\":\"" . $arr["data"][2]["value"] .
                "\"},{\"name\":\"" . $arr["data"][3]["name"] .
                "\",\"value\":\"" . $arr["data"][3]["value"] .
                "\"},{\"name\":\"" . $arr["data"][4]["name"] .
                "\",\"value\":\"" . $arr["data"][4]["value"] . "\"}]}",

            //CURLOPT_POSTFIELDS => $send,

            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
            ),
        ));

        $response = curl_exec($curl);

        //dd($response);
        curl_close($curl);


        $notification = array(
            'message' => 'Setting successfully!',
            'alert-type' => 'success'
        );


        return redirect('login')->with($notification);
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
}
