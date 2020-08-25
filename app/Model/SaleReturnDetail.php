<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SaleReturnDetail extends Model
{
    public function saleDetail(){
	    return $this->belongsTo('App\Model\SaleDetail','sale_detail_id');
	}
    public function return()
	    {
	        return $this->belongsTo('App\Model\SaleReturn');
		}
	public function returnDetail()
	    {
	        return $this->belongsTo('App\Model\SaleReturnDetail','sale_return_id');
		}
	public function product()
	    {
	        return $this->belongsTo('App\Model\Product');
	    }
	public function category()
	    {
	        return $this->belongsTo('App\Model\Category');
	    }

	public function brand()
	    {
	        return $this->belongsTo('App\Model\Brand');
	    }
	public function unit()
	    {
	        return $this->belongsTo('App\Model\Unit');
	    }
	public function customer()
        {
            return $this->belongsTo('App\Model\Customer');
        }
    public function warehouse()
    {
        return $this->belongsTo('App\Model\Warehouse');
    }
}
