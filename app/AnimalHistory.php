<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnimalHistory extends Model
{
    //
    protected $table = 'animal_history';
    protected $fillable = [
        'image',
        'detail',
        'animal_id',
        'history_types_id'
    ];


    
    public function animal() {
        return $this->belongsTo(Animal::class, 'animal_id');  
    }

    public function history_type() {
        return $this->belongsTo(HistoryType::class, 'history_types_id');  
    }


}
