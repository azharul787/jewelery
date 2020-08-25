<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function loaner(){
        return $this->belongsTo('App\Model\Loaner');
    }
}
