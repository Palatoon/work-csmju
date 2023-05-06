<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
		'name_en',
        'description',
        'floor_plan_image',
        'created_by',
        'x',
        'y',
    ];
}
