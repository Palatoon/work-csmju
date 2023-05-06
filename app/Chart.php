<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'chart_type_id',
        'user_id',
    ];
}
