<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public function product()
    {
        return $this->hasMany('App\Model\Product');
    }
    public function account()
    {
        return $this->hasMany('App\Model\SupplierAccount');
    }
}
