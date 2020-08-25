<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
    public function saleDetail()
     {
        return $this->hasMany('App\Model\SaleDetail');
     }
}
