<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
use App\Configurations;

class NotificationController extends Controller
{
    //

    public function index(){
        return view('backend.configuration.notification', [
            'data' => Configurations::where('type' , 'power-meter')->get()
        ]);
    }


    public function update(Request $request){

        $res = Configurations::where('id' , $request->id)->update([
            'name_th' => $request->name,
            'unit' => $request->unit,
            'value' => $request->value,
            'notify_status' => $request->active,
        ]);
        if($res){
            return "success";
        }else{
            return $res;
        }
        
    }
}
