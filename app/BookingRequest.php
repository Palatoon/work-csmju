<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookingRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'calendar_id',
        'icaluid',
        'qrcode',
        'booker',
        'booker',
        'room',
        'room',
        'title',
        'start',
        'end',
        'hour',
        'detail',
        'online_meeting',
        'status',
        'cancel',
    ];

    public function user($id)
    {
        return \App\User::find($id);
    }

    public function room($id)
    {
        return \App\Room::find($id);
    }
}
