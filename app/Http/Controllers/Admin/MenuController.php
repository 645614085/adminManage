<?php
/**
 * Created by PhpStorm.
 * User: ZZT
 * Date: 2018/2/26
 * Time: 16:11
 */

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Menu;
use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Psy\Command\ListCommand\MethodEnumerator;
use Cache;
class MenuController extends Controller
{

    /**
     * @return $this
     * 菜单列表页
     */
    public function all()
    {
        $menus = Menu::orderBy("pid","ASC")->orderBy("sort", "ASC")->get();
        $tree = [];
        $this->treeShow($menus->toArray(),$tree);
        return view("admin.menu.list")->with("menusTree",$tree);
    }

    /**
     * @param $id
     * @return mixed
     * 修改列表详情页
     */
    public function edit($id)
    {
        $menuTop = Menu::where("pid",0)->get();
        $menus = Menu::where("id",$id)->first();

        return view("admin.menu.detail")->with("menuTop",$menuTop)->with("menus",$menus);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * post更新
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->input('form'),[
            'name'=>'required|max:16',
            'icon_class'=>'required',
            'url'=>'required',
            'sort'=>'required|integer|between:0,256',
            'flag'=>'required|boolean',
            'id'=>'required|integer',
        ]);

        if($validator->fails()){
            return redirect('/admin/menu')->withErrors($validator->errors());
        }

        Menu::where("id",$request->input('form')['id'])->update($request->input('form'));

        return redirect('/admin/menu')->with('message','修改成功！');
    }

    /**
     * @return mixed
     * 新增页面
     */
    public function add()
    {
        $menuTop = Menu::where("pid",0)->get();
        $menus = new Menu();
        return view("admin.menu.detail")->with("menuTop",$menuTop)->with("menus",$menus);
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     * post提交创建的数据
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->input('form'),[
            'name'=>'required|max:16',
            'icon_class'=>'required',
            'url'=>'required',
            'sort'=>'required|integer|between:0,256',
            'flag'=>'required|boolean'
        ]);
        if($validator->fails()){
            return redirect('/admin/menu')->withErrors($validator->errors());
        }

        Menu::firstOrCreate(['name'=>$request->input('form')['name']],$request->input('form'));

        return redirect('/admin/menu')->with('message','创建成功！');
    }

    public function del($id){
        $menu = Menu::find($id);

        if(is_null($menu)){
            abort(404);
        }

        if(Menu::where("pid",$menu->id)->count()>0){
            return redirect('/admin/menu')->withErrors(['菜单子集还存在，请先删除子菜单再进行删除！']);
        }
        $menu->delete();
        $roles = Role::pluck('id');
        foreach ($roles as $role){
            Cache::forget("cloud6Menus".$role);
        }
        return redirect('/admin/menu')->with('message','菜单信息删除成功！');
    }


    /**
     * @param $data
     * @param $tree
     * @param int $pid
     * @param int $deep
     * 菜单树状显示
     */
    public function treeShow($data, &$tree, $pid = 0, $deep = 1)
    {
        foreach ($data as $key => $val) {
            if ($val['pid'] == $pid) {
                $val['deep'] = $deep;
                $tree[] = $val;
                unset($data[$key]);
                $this->treeShow($data, $tree, $val['id'], $deep + 1);
            }
        }
    }
}