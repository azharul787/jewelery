<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expensetype extends Model
{
    public function expense(){
        return $this->hasMany('App\Model\Expense');
    }
}
