<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    public function bank(){
        return $this->belongsTo('App\Model\Bank');
    }
}
