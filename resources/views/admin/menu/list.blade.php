@extends('admin.layout')
@section('page_title')
    <h1 class="text-info">菜单设置</h1>
@endsection

@section('content')

        <div class="row">
            <div class="row col-md-12 center-block">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">菜单列表</h3>
                    </div>
                    <div class="panel-body">
                        <a type="button" class="btn btn-success"
                           data-toggle="modal"
                           data-target="#modal"

                           data-keyboard="false" id="add_menu"
                           href="/admin/menu/add"
                        >
                            添加主菜单
                        </a>
                        <hr/>
                        <table class="table table-striped table-bordered" id="table">
                            <thead>
                                <tr>
                                    <td>排序号</td>
                                    <td>菜单名</td>
                                    <td>地址</td>
                                    <td>图标</td>
                                    <td>是否启用</td>
                                    <td>操作</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!count($menusTree))
                                    <tr>
                                        <td colspan="6">暂无数据</td>
                                    </tr>
                                @else

                                    @foreach($menusTree as $menu)
                                        <tr data-id="{{ $menu['id'] }}">
                                            <td><span>{{ $menu['sort'] }}</span></td>
                                            <td><span>@for($i=1;$i<$menu['deep'];$i++) <strong>--|</strong> @endfor{{ $menu['name'] }} </span></td>
                                            <td><span>{{ $menu['url'] }}</span></td>
                                            <td><span>{{ $menu['icon_class'] }}</span></td>
                                            <td><span>{{ $menu['flag'] }}</span></td>
                                            <td>
                                                <a class="btn btn-danger"
                                                   href="{{ url('/admin/menu/del',$menu['id']) }}"
                                                   onclick="return confirm('确认要删除此条数据吗？');">
                                                    删除</a>
                                                <a type="button" class="btn btn-success"
                                                   data-toggle="modal"
                                                   data-target="#modal"

                                                   data-keyboard="false" id="add_menu" href="{{ url('/admin/menu/edit',$menu['id']) }}">
                                                    编辑
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

@endsection