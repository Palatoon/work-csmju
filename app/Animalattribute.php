<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalAttribute extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
		'name_en',
        'unit',
        
    ];

    protected $table = 'animal_attributes';
    
    public function values()
    {
        return $this->hasMany(AnimalAttributeValue::class, 'animal_attributes_id');
    }
}
