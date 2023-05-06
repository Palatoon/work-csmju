<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
		'name_en',
        
    ];

    function attributes()
    {
        return $this->belongsToMany(AnimalAttribute::class, 'animal_attributes_id', 'animal_types_id');
    }
}
