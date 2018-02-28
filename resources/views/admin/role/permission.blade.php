@extends('admin.layout')
@section('page_title')
    <h1 class="text-info">权限设置</h1>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 row form-group">
        <form action="{{ url('admin/role/permission') }}" method="post">
            <input name="_token" type="hidden" value="{{ csrf_token() }}" />
            <input name="id" value="{{ $role->id }}" type="hidden" />
            <div class="control-group">
                <label for="name" class="control-label"><h3>角色名：<span class="text-danger">{{$role->name}}</span></h3></label>
            </div>
            <div class="row">
                <div class="span12" style="padding-left:10px;">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <span class="panel-title">访问权限</span>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                @foreach($menuTree as $menu)
                                    <div class="list-group col-md-3">
                                        <label class="list-group-item bg-info">
                                            <input @if(in_array($menu['id'],$role->menus)) checked @endif type="checkbox" class="menu_id" id="menu_{{ $menu['id'] }}" name="permission[]" value="{{ $menu['id'] }}" /> {{ $menu['name'] }}
                                        </label>
                                            @foreach($menu['sub'] as $subMenu)
                                                <label class="list-group-item pad-x-40">
                                                    <input @if(in_array($subMenu['id'],$role->menus)) checked @endif type="checkbox"
                                                           id="menu_info_{{ $subMenu['id'] }}"
                                                           name="permission[]"
                                                           value="{{ $subMenu['id'] }}"
                                                           class="menu_info menu_{{ $subMenu['pid'] }}" fid="menu_{{ $subMenu['pid'] }}"
                                                    />{{ $subMenu['name'] }}
                                                </label>
                                            @endforeach
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr/>
                        <div class="pager">
                            <input type="submit" class="btn btn-info btn-lg" value="设置权限"/>
                            <a href="javascript:;" onclick="window.history.back()" class="btn btn-info btn-lg" >返回用户组</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@section('page_js')
<script src="{{ asset('/js/admin/checkbox.js') }}"></script>
@stop
@stop