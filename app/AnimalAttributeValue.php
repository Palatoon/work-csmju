<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalAttributeValue extends Model
{
    protected $fillable = [
        'animal_id',
        'animal_attributes_id',
        'value'
    ];

    protected $table = 'animal_attribute_values';
    
    public function attribute()
    {
        return $this->belongsTo(AnimalAttribute::class, 'animal_attributes_id');
    }
    
}
