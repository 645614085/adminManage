@extends('admin.layout')
@section('page_title')
    <h1 class="text-info">菜单设置</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6">
        <table class="table table-bordered">
            <caption>
                <span class="pull-left">用户管理</span>
              

                <a type="button"  data-toggle="modal" data-target="#modal"  data-keyboard="false" href="{{ url('/admin/user/add') }}"  class="btn btn-success pull-right">创建用户</a>
            </caption>
            <thead>
            <tr>
                <th>用户ID</th>
                <th>用户名</th>
                <th>角色名称</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{ $admin->id }}</td>
                    <td>{{ $admin->name }}</td>
                    <td>{{ $admin->roles()->first()->name }}</td>
                    <td>
                        <a type="button"  data-toggle="modal" data-target="#modal"  data-keyboard="false"  href="{{ url('/admin/user/edit',$admin->id) }}" class="btn btn-success">编辑</a>
                        <a href="{{ url('/admin/user/del',$admin->id) }}" class="btn btn-danger">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-bordered">
            <caption>
                <span class="pull-left">角色管理</span>
                <a type="button"  data-toggle="modal" data-target="#modal"  data-keyboard="false"  href="{{ url('admin/role/add') }}" class="btn btn-success pull-right">创建角色</a>
            </caption>
            <thead>
            <tr>
                <th>角色ID</th>
                <th>角色名</th>
                <th>角色标识</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->remark }}</td>
                    <td>
                        <a href="{{ url('/admin/role/detail',$role->id) }}" class="btn btn-success">授权</a>
                        <a type="button"  data-toggle="modal" data-target="#modal"  data-keyboard="false"  href="{{ url('/admin/role/edit',$role->id) }}" class="btn btn-info">编辑</a>
                        <a href="{{ url('/admin/role/del',$role->id) }}" class="btn btn-danger">删除</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@stop