<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
   // use HasApiTokens, Notifiable;
    use HasRoles;

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    // model relation section
   /* public function branches(){
        return $this->belongsToMany('App\Model\Branch')->withTimestamps();
    }*/
    
    // scope define
  /*  public function scopeBranch($query){
        return $query->where();
    }*/

    /*public function deposit(){
        return $this->hasMany('App\Model\Deposit');
    } 
    public function savin(){
        return $this->hasMany('App\Model\Saving');
    }
    public function installment(){
        return $this->hasMany('App\Model\Installment');
    }
    public function member(){
        return $this->hasMany('App\Model\Member');
    }
    public function customer(){
        return $this->hasMany('App\Model\Customer');
    }*/
}
