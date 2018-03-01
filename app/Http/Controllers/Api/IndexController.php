<?php
/**
 * Created by PhpStorm.
 * User: ZZT
 * Date: 2018/3/1
 * Time: 10:11
 */

namespace App\Http\Controllers\Api;


use App\Admin;

class IndexController extends BaseController
{
    public function index(){
      // return  $this->message('success');
      
        return $this->success(9527);
       // User::get();
    }
}