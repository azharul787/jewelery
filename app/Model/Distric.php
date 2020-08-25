<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Distric extends Model
{
    public function upozila(){
        return $this->hasMany('App\Model\Upozila');
    }
    public function customer(){
        return $this->hasMany('App\Model\Customer');
    }
}
