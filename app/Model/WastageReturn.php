<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WastageReturn extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Model\Supplier','supplier_id');
    }
    public function product()
    {
        return $this->belongsTo('App\Model\Product','product_id');
    }
    public function Brand()
    {
        return $this->belongsTo('App\Model\Brand');
    }
    public function wdetails()
    {
        return $this->hasMany('App\Model\WastageReturnDetail','wastage_return_id');
    }
}
