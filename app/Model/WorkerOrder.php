<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WorkerOrder extends Model
{
    public function worker(){
        return $this->belongsTo("App\Model\Worker");
    }
    public function details(){
        return $this->hasMany("App\Model\WorkerOrderDetail",'worker_order_id');
    }


}
