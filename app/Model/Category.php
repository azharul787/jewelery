<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function product()
    {
        return $this->hasMany('App\Model\Product');
    }
    public function brand()
    {
        return $this->hasMany('App\Model\Brand');
    }
    public function purchase()
    {
        return $this->hasMany('App\Model\Purchase');
    }
    public function sale()
    {
        return $this->hasMany('App\Model\Sale');
    }
    public function saleDetail()
    {
        return $this->hasMany('App\Model\SaleDetail');
    }
    public function purchaseDetail()
    {
        return $this->hasMany('App\Model\PurchaseDetail');
    }
}
