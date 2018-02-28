<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminUserController extends Controller
{
    //
    public function all(){

    }

    /**
     * @return mixed
     * 添加
     */
    public function add(){
        $roles = Role::get();
        return view('admin.user.create')->with('roles',$roles);
    }


    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * 用户创建
     */
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'role_id'=>'required|integer',
            'name' => 'required|alpha_dash|unique:admins,name',
            'password' => 'required|confirmed|min:6',
            'password_confirmation'=>'required'
        ]);

        if($validator->fails()){
            return redirect('/admin/role/')->withErrors($validator->errors());
        }


        Admin::create(['name'=>$request->name,'password'=>bcrypt($request->password),'role_id'=>$request->role_id]);

        return redirect('/admin/role/')->with('message',"用户创建成功！");
    }

    /**
     * @param $id
     * @return mixed
     * 修改用户展示页面
     */
    public function edit($id){
        $user = Admin::find($id);
        $roles = Role::get();
        return view('admin.user.edit')->with('user',$user)->with('roles',$roles);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * 用户展示页面
     */
    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|integer',
            'role_id'=>'required|integer',
            'name' => 'required|alpha_dash',
        ]);
        if($validator->fails()){
            return redirect('/admin/role/')->withErrors($validator->errors());
        }

        $user = ['role_id'=>$request->role_id,'name'=>$request->name];
        if(!empty($request->input('password'))){
            if($request->input('password')!==$request->input('password_confirmation')){
                return redirect('/admin/role/')->withErrors(['两次输入的密码不匹配！']);
            }
            $user['password'] = bcrypt($request->password);
        }

        Admin::where('id',$request->id)->update($user);

        return redirect('/admin/role/')->with('message',"用户信息修改成功！");

    }

    public function del($id){
       $user =  Admin::find($id);
        if(is_null($user)){
            abort(404);
        }
       $user->delete();
        return redirect('/admin/role')->with('message','用户删除成功！');
    }

}
