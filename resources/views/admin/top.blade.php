<div class="col-md-6 col-sm-4 clearfix hidden-xs">
    <ul class="list-inline links-list pull-right">
        <li>
            <a href="#" data-toggle="chat" data-animate="1" data-collapse-sidebar="1">
                <i class="entypo-chat"></i>
                {{Session::get('user_name')}}
                <span class="badge badge-success chat-notifications-badge is-hidden">0</span>
            </a>
        </li>

        <li><a href="{{url('/')}}" target="_blank">主页 <i class="entypo-home right"></i></a> </li>
        <li>
            <a href="{{url('/admin/logout')}}">
                注销登录
                <i class="entypo-logout right"></i>
            </a>
        </li>
    </ul>
</div>
