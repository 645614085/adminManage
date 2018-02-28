<?php

namespace App\Http\Middleware;

use App\Admin;
use App\Menu;
use Closure;
use Illuminate\Support\Facades\Auth;

class MenuMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd(Auth::guard('admin')->user()->roles()->first());
        //dd($request->session()->get('adminUser')->roles()->first());

        $user = $request->session()->get('adminUser');
        $menus = Menu::getMenusByRoleId($user->role_id);
        //dd(array_column($menus->toArray(),'url'));
        view()->share('menus',$menus);
        return $next($request);
    }


}
