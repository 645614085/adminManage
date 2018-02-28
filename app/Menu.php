<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cache;

use App\Role;

class Menu extends Model
{
    //
    protected $fillable = ['name','icon_class','url','pid','flag','sort'];



    public static function getMenusByRoleId($roleId=1){
        if(Cache::has("cloud6Menus".$roleId)){
            $menusObj = Cache::get("cloud6Menus".$roleId);
            return $menusObj;
        }

        $menuIds = Role::where("id",$roleId)->first();
        $menuIds = array_filter(explode(",",$menuIds->menus));
        $menusObj = self::whereIn("id",$menuIds)->orderBy("sort","DESC")->get();
        if($menusObj){
            Cache::forever("cloud6Menus".$roleId,$menusObj);
            return $menusObj;
        }

        return false;
    }
}
