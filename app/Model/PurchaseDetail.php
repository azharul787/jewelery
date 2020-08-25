<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    public function purchase()
    {
        return $this->belongsTo('App\Model\Purchase');
    }
    public function sale(){
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
    public function type()
    {
        return $this->belongsTo('App\Model\Type');
    }
    public function unit()
    {
        return $this->belongsTo('App\Model\Unit');
    }
    public function warehouse(){
        return $this->belongsTo('App\Model\Warehouse');
    }
    public function purchaseReturn(){
        return $this->hasMany('App\Model\PurchaseReturnDetail','purchase_detail_id');
    }
}
