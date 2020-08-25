<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function product()
        {
            return $this->hasMany('App\Model\Product');
        }
    public function category()
        {
            return $this->belongsTo('App\Model\Category');
        }
    public function sale()
        {
            return $this->hasMany('App\Model\Sale');
        }
    public function purchase()
        {
            return $this->hasMany('App\Model\Purchase');
        }
    public function purchaseDetail()
        {
            return $this->hasMany('App\Model\PurchaseDetail');
        }
}
