<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    //
    use Notifiable;

    protected $fillable = [ 'name','password','role_id'];

    protected $hidden = ['password','remember_token'];


    public function roles(){
       return $this->belongsTo('App\Role','role_id','id');
    }

}
