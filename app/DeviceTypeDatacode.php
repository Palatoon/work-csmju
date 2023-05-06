<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceTypeDatacode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_type_id',
        'datacode_id'
    ];
}
