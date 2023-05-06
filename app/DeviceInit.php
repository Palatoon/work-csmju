<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceInit extends Model
{
    //
    protected $table = "devices_init";
    protected $fillable = [
        'ip',
        'device_id',
        'room_id',
        'start_time',
        'end_time',
    ];
}
