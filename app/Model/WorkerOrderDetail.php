<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WorkerOrderDetail extends Model
{
    public function product(){
        return $this->belongsTo('App\Model\Product','product_id');
    }
    public function category(){
        return $this->belongsTo('App\Model\Category');
    }
    public function type(){
        return $this->belongsTo('App\Model\Type');
    }
    public function unit(){
        return $this->belongsTo('App\Model\Unit');
    }
    public function caret(){
        return $this->belongsTo('App\Model\Caret');
    }
}
