<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeAttribute extends Model
{
    protected $fillable = [
        'animal_types_id',
        'animal_attributes_id'
    ];
    
}
