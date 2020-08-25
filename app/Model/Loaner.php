<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Loaner extends Model
{
    public function loan(){
        return $this->hasMany('App\Model\Loan');
    }
}
