<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //

    protected $fillable = ['name','remark','menus'];


    public function admins(){
        return $this->hasMany('App\Admin','role_id','id');
    }
}
