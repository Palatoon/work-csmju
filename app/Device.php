<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ip',
        'macaddress',
        'serial_id',
        'name',
        'username',
        'password',
        'device_type_id',
        'building_id',
        'area_id',
        'room_id',
        'sync_date',
        'created_by',
        'x',
        'y',
    ];

    public function room() {
        return $this->belongsTo(Room::class, 'room_id');  // Register Foreign Key
    }


    public function home_assistant() {
        return $this->belongsTo(HomeAssistant::class, 'home_assistant_id');  // Register Foreign Key
    }

    public function device_name($id){
        $aa = DeviceType::find($id);
        return $aa->name;
    }
}
