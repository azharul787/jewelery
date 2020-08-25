<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CustomerAccount extends Model
{
    public function customer(){
        return $this->belongsTo('App\Model\Customer');
    }
    public function sale(){
        return $this->belongsTo('App\Model\Sale');
    }
}
