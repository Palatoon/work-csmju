<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChartType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

}
