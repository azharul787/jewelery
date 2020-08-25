<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    public function purchase(){
	    return $this->belongsTo('App\Model\Purchase');
	}
	public function purchaseDetail(){
	    return $this->belongsTo('App\Model\PurchaseDetail');
	}
	public function product(){
	    return $this->belongsTo('App\Model\Product');
	}
    public function sale(){
	    return $this->belongsTo('App\Model\Sale');
	}
	public function category(){
	    return $this->belongsTo('App\Model\Category');
	}
	public function brand(){
	    return $this->belongsTo('App\Model\Brand');
	}
	public function unit(){
	    return $this->belongsTo('App\Model\Unit');
	}
	public function customer(){
        return $this->belongsTo('App\Model\Customer');
    }
	public function warehouse(){
        return $this->belongsTo('App\Model\Warehouse');
    }
}
