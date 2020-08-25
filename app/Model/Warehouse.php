<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public function scopeActive($query){
        return $query->where('status','Active');
    }
}
