<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Menu;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 角色列表页
     */
    public function all(){
        $roles = Role::get();
        $admins = Admin::get();
        return view('admin.role.list')->with("roles",$roles)->with("admins",$admins);
    }

    /**
     * @param $id
     * @return mixed
     * 修改角色信息
     */
    public function edit($id){
        $role = Role::where("id",intval($id))->first();
        if (is_null($role)){
            abort(404);
        }
        return view('admin.role.edit')->with('role',$role);
    }

    /**
     * @param Request $request
     * post传值，修改角色权限
     */
    public function update(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|alpha_dash',
            'remark' => 'required|alpha_dash',
            'id' => 'required|integer'
        ]);

        if($validator->fails()){
            return redirect('/admin/role')->withErrors($validator->errors());
        }

        Role::where("id",$request->id)->update($request->except('_token'));

        return redirect('admin/role')->with("message",'角色基本信息修改成功！');
    }


    public function add(){
        return view('admin.role.add');
    }

    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|alpha_dash|unique:roles,name',
            'remark' => 'required|alpha_dash',
        ]);
        if($validator->fails()){
            return redirect('/admin/role')->withErrors($validator->errors());
        }

        Role::create($request->except('_token'));

        return redirect('admin/role')->with("message",'角色信息创建成功！');
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * post 传值，修改角色权限
     */
    public function permission(Request $request){
       $permission = $request->input('permission');
        Role::where("id",$request->id)->update(['menus'=>implode(',',$permission)]);

        //清除缓存
        Cache::forget("cloud6Menus".$request->id);
        return redirect('admin/role/detail/'.$request->id)->with('message',"权限修改完成！");
    }

    /**
     * @param $id
     * @return mixed
     * 展示用户权限
     */
    public function detail($id){
        $role = Role::where("id",$id)->first();
        $role->menus = array_filter(explode(',',$role->menus));
        if(is_null($role)){
            abort(404);
        }

        $menus = Menu::get();
        $menus = $menus->toArray();
        $tree = $this->treeArr($menus);

        return view('admin.role.permission')->with('menuTree',$tree)->with("role",$role);
    }


    public function del($id){
        $users = Admin::where("role_id",$id)->count();
        if($users>0){
            return redirect('/admin/role')->withErrors(['用户已经使用该角色，不能删除该角色！']);
        }
        $role = Role::find($id);
        if(is_null($role)){
            return redirect('/admin/role')->withErrors(['角色不存在！']);
        }

        $role->delete();
        //清除缓存
        Cache::forget("cloud6Menus".$id);

        return redirect('/admin/role')->with('message','角色删除成功！');
    }


    public function treeArr(&$data,$pid = 0){//微信菜单树
        $tree = array();
        foreach ($data as $key=>$val){
            if($pid == $val['pid']){
                $temp = $val;
                unset($data[$key]);
                $temp['sub'] = $this->treeArr($data,$val['id']);
                if(empty($temp['sub']))unset($temp['sub_button']);
                $tree[] = $temp;
            }
            reset($data);
        }
        return $tree;
    }
}
