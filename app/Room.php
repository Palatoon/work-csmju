<?php

namespace App;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'name_en',
        'email',
        'seat',
        'description',
        'floor_plan_image',
        'room_type_id',
        'building_id',
        'area_id',
        'auto_approve',
        'approver',
        'created_by',
        'disable',
        'x',
        'y',
        'active_license',
        'ha_id',
        'ha_url'
    ];

    public function pwDecrypt($password)
    {
        return Crypt::decryptString($password);
    }

    // public function checkBookable($id)
    // {
    //     $group = RoomGroup::where('room_id', $id)->where('name', strtolower(\Session::get('type')))->first();
    //     //if((is_array($array1) && count(array_intersect($array1, $array2)) > 0) || count($array2) == 0){
    //     if ($group->bookable == true) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function bookableList($id)
    // {
    //     return RoomGroup::where('room_id', $id)->get();
    // }

}
