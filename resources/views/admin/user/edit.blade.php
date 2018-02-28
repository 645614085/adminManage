<form name="settingCreate" method="post"  action="{{url('/admin/user/update')}}">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
        <h4 class="modal-title" id="myModalLabel">新增</h4>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label for="parent_id">角色</label>
            <select name="role_id" class="form-control">
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" @if($user->role_id == $role->id) selected @endif>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">用户名称</label>
            <input type="text" name="name" class="form-control"  placeholder="用户名称" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="name">密码</label>
            <input type="text" name="password" class="form-control"  placeholder="用户密码" >
        </div>
        <div class="form-group">
            <label for="name">确认密码</label>
            <input type="text" name="password_confirmation" class="form-control"  placeholder="确认密码" >
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span>关闭</button>
        <input id="submit_btn" type="submit" class="btn btn-primary" value="保存" />
    </div>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="hidden" name="id" value="{{ $user->id }}" />
</form>