<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HomeAssistant extends Model
{
    //
    protected $table = "home_assistant";
    protected $fillable = [
        'name',
        'ip',
        'port',
        'created_by',
        'token',
    ];
}
