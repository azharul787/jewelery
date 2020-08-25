<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    public function upozila(){
        return $this->belongsTo('App\Model\Upozila');
    }
    public function village(){
        return $this->hasMany('App\Model\Village');
    }
    public function customer(){
        return $this->hasMany('App\Model\Customer');
    }
}
