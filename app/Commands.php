<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commands extends Model
{
    //
    protected $fillable = [
        'device_type_id',
        'command_name',
        'command_value',
    ];

    public function device_name($id){
        $aa = DeviceType::find($id);
        return $aa->name;
    }
}
