<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    public function union(){
        return $this->belongsTo('App\Model\Union');
    }
    public function student(){
        return $this->hasMany('App\Model\Student');
    }
}
