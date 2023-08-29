<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    //relaciones
    public function assignments(){
        return $this->hasMany('App\Models\Assignment');
    }
}
