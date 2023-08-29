<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    //relaciones
    public function detects(){
        return $this->hasMany('App\Models\Detect');
    }
}
