<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
        'type',
        'hours',
        'building_id',
        'area_id',
        'room_id',
        'camera_id'
    ];

    public function building() {
        return $this->belongsTo(Building::class, 'building_id');  // Register Foreign Key
    }

    public function area() {
        return $this->belongsTo(Area::class, 'area_id');  // Register Foreign Key
    }

    public function room() {
        return $this->belongsTo(Room::class, 'room_id');  // Register Foreign Key
    }

}
