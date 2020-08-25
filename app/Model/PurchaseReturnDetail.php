<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturnDetail extends Model
{
    public function purchaseR()
    {
        return $this->belongsTo('App\Model\PurchaseReturn');
    }
    public function sale()
    {
        return $this->hasMany('App\Model\SaleDetail');
    }
    public function product(){
        return $this->belongsTo('App\Model\Product');
    }
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
    public function brand()
    {
        return $this->belongsTo('App\Model\Brand');
    }
    public function unit()
    {
        return $this->belongsTo('App\Model\Unit');
    }
    public function warehouse()
    {
        return $this->belongsTo('App\Model\Warehouse');
    }
}
