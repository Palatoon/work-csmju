<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceTypeStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_type_id',
        'name',
        'icon',
        'icon_color',
        'image',
    ];
}
