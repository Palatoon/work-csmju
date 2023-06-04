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
        'animal_attributes_name',
        'animal_attributes_name_en',
        'animal_attributes_unit'
    ];
    
    protected $table = 'animal_attributes';
    
    public function values()
    {
        return $this->hasMany(AnimalAttributeValue::class, 'animal_attributes_id');
    }
}
