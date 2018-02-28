<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Input;

class LoginController extends Controller
{
    //

    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    public function __construct()
    {
       // $this->middleware('guest.admin',['except'=>'logout']);
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 显示后台登陆
     */
    public function getLogin(Request $request){
        if($request->session()->has('adminUser')){
            return redirect('/admin/');
        }
        return view('auth.login');
    }

    public function postLogin(){
        $name = Input::get('name');

        $credentials = ['name'=>$name,'password'=>Input::get('password')];

        if(Auth::guard('admin')->attempt($credentials,Input::get('remember'))){
            session(['adminUser'=>Auth::guard('admin')->user()]);//保存用户信息至session中
            return response()->json([
                'login_status' => 'success',
                'redirect_url' => '/admin',
            ]);
        }

    }


    public function logout(Request $request){
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }


    /**
     * @return mixed
     * 使用admin guard
     */
    protected function guard(){
        return auth()->guard('admin');
    }




    /**
     * @return string
     * 重写验证时使用的用户名字段
     */
    public function username(){
        return 'name';
    }


    
}
