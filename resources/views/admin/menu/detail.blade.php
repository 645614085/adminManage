<form name="settingCreate" method="post" @if($menus->id) action="{{ url('/admin/menu/update') }}" @else action="{{url('/admin/menu/create')}}" @endif>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">新增</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="parent_id">父级菜单</label>
            <select name="form[pid]" class="form-control">
                <option value="0">请选择...</option>
                @foreach($menuTop as $menu)
                    <option value="{{ $menu->id }}" @if($menus->pid or 0 === $menu->id) selected @endif>{{ $menu->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">菜单名称</label>
            <input type="text" name="form[name]" class="form-control"  placeholder="菜单名称" value="{{ $menus->name or '' }}">
        </div>
        <div class="form-group">
            <label for="name">菜单图标</label>
            <input type="text" name="form[icon_class]" class="form-control"  placeholder="菜单图标" value="{{ $menus->icon_class or '' }}">
        </div>
        <div class="form-group">
            <label for="name">菜单地址</label>
            <input type="text" name="form[url]" class="form-control"  placeholder="菜单地址" value="{{ $menus->url or '' }}">
        </div>
        <div class="form-group">
            <label for="name">菜单排序</label>
            <input type="text" name="form[sort]" class="form-control"  placeholder="菜单排序" value="{{ $menus->sort or '' }}">
        </div>
        <div class="form-group">
            <label for="content">状态标志</label>
            <input type="radio" name="form[flag]" value="0" @if($menus->flag or 0 === 0) checked @endif /><label>启用</label>
            <input type="radio" name="form[flag]" value="1" @if($menus->flag or 0 === 1 ) checked @endif /><label>禁用</label>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>关闭</button>
        <input id="submit_btn" type="submit" class="btn btn-primary" value="保存" />
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    @if($menus->id)
    <input type="hidden" name="form[id]" value="{{ $menus->id }}" />
    @endif
</form>