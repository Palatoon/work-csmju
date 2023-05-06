<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceDatacodeCondition extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id',
        'datacode_id',
        'condition',
        'value',
    ];
}
