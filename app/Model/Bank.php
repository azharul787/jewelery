<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    public function transaction(){
        return $this->hasaMany('App\Model\BankTransaction');
    }
}
