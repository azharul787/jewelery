<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PurchaseReturn extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Model\Supplier','supplier_id');
    }
    public function saleDetail()
    {
        return $this->hasMany('App\Model\SaleDetail');
    }
    public function Brand()
    {
        return $this->belongsTo('App\Model\Brand');
    }
    public function Rdetails()
    {
        return $this->hasMany('App\Model\PurchaseReturnDetail','purchase_return_id');
    }
   
}
