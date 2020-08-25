<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function scopePending($query){
        return $query->where('status','Pending');
    }
    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
    public function customer()
    {
        return $this->belongsTo('App\Model\Customer');
    }
    public function saleDetail()
    {
        return $this->hasMany('App\Model\SaleDetail');
    }
    
    public function Brand()
    {
        return $this->belongsTo('App\Model\Brand');
    }
    public function details()
    {
        return $this->hasMany('App\Model\OrderDetail');
    }
}
