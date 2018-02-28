<form name="settingCreate" method="post"  action="{{url('/admin/role/update')}}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">新增</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="name">角色名称</label>
            <input type="text" name="name" class="form-control"  placeholder="用户名称" value="{{ $role->name}}" >
        </div>
        <div class="form-group">
            <label for="name">角色简介</label>
            <input type="text" name="remark" class="form-control"  placeholder="角色简介" value="{{ $role->remark }}" >
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>关闭</button>
        <input id="submit_btn" type="submit" class="btn btn-primary" value="保存" />
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="id" value="{{ $role->id }}" />
</form>