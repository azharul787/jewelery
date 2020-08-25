<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function supplier(){
        return $this->belongsTo('App\Model\Supplier');
    }
    public function purchaseDetail(){
        return $this->belongsTo('App\Model\PurchaseDetail');
    }
    public function category(){
        return $this->belongsTo('App\Model\Category');
    }
    public function brand(){
        return $this->belongsTo('App\Model\Brand');
    }
    public function unit(){
        return $this->belongsTo('App\Model\Unit');
    }
    public function type(){
        return $this->belongsTo('App\Model\Type');
    }
    public function caret(){
        return $this->belongsTo('App\Model\Caret');
    }
}
