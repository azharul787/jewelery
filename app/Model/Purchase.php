<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Model\Supplier');
    }
    public function saleDetail()
    {
        return $this->hasMany('App\Model\SaleDetail');
    }
    public function brand()
    {
        return $this->belongsTo('App\Model\Brand');
    }
    public function details()
    {
        return $this->hasMany('App\Model\PurchaseDetail');
    }
    public function account(){
        return $this->hasMany('App\Model\Account');
    }
}
