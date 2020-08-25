<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public function expensetype(){
        return $this->belongsTo('App\Model\Expensetype');
    }
    public function branch(){
        return $this->belongsTo('App\Model\Branch');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function ledger(){
        return $this->hasMany('App\Model\Ledger');
    }
}
