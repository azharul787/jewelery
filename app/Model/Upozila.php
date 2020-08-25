<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Upozila extends Model
{
    public function distric(){
        return $this->belongsTo('App\Model\Distric');
    }
    public function union(){
        return $this->hasMany('App\Model\Union');
    }
    public function customer(){
        return $this->hasMany('App\Model\Customer');
    }
}
