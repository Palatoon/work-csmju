<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
		'name_en',
        'type_id'
    ];

    protected $table = 'animals';
    
    public function attributes()
    {
        return $this->hasMany(AnimalAttributeValue::class, 'animal_id');
    }
    
    public function type()
    {
        return $this->belongsTo(AnimalType::class, 'type_id');
    }
}
