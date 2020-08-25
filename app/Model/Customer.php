<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function sale()
    {
        return $this->hasMany('App\Model\Sale');
    }
    public function account()
    {
        return $this->hasMany('App\Model\CustomerAccount');
    }
    public function saleDetail()
    {
        return $this->hasMany('App\Model\SaleDetail');
    }
    public function distric()
    {
        return $this->belongsTo('App\Model\Distric');
    }
    public function upozila()
    {
        return $this->belongsTo('App\Model\Upozila');
    }
    public function union()
    {
        return $this->belongsTo('App\Model\Union');
    }

}
