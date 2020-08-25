<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function customer(){
        return $this->belongsTo('App\Model\Customer');
    }
    public function purchaseDetail(){
        return $this->belongsTo('App\Model\PurchaseDetail'); 
    }
    public function saleDetail(){
        return $this->hasMany('App\Model\SaleDetail'); 
    }
    public function category(){ 
            return $this->belongsTo('App\Model\Category');
    }
    public function brand(){ 
         return $this->belongsTo('App\Model\Brand');
    }
    public function account(){
        return $this->hasMany('App\Model\Account');
    }
}
