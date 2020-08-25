<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SupplierAccount extends Model
{
    public function supplier(){
        return $this->belongsTo('App\Model\Supplier');
    }
    public function purchase(){
        return $this->belongsTo('App\Model\Purchase');
    }
}
