<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
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
        'description',
        'floor_plan_image',
        'building_id',
        'created_by',
        'disable',
        'x',
        'y',
    ];
}
