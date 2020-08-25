<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SaleReturn extends Model
{
    public function customer(){
        return $this->belongsTo('App\Model\Customer');
    }
    public function saleDetail(){
        return $this->hasMany('App\Model\SaleDetail','sale_detail_id'); 
    }
    public function returnDetail(){
        return $this->hasMany('App\Model\SaleReturnDetail','sale_return_id'); 
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
