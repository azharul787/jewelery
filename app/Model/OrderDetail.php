<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Model\Product');
    }
    public function purchase()
    {
        return $this->belongsTo('App\Model\Purchase');
    }
    public function sale()
    {
        return $this->hasMany('App\Model\SaleDetail');
    }
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
    public function type()
    {
        return $this->belongsTo('App\Model\Type');
    }
    public function caret()
    {
        return $this->belongsTo('App\Model\Caret');
    }
}
