<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>云六资源网后台管理系统</title>
    <link rel="stylesheet" href="{{ asset('/js/admin/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css') }}" >
    <link rel="stylesheet" href="{{ asset('/css/admin/font-icons/entypo/css/entypo.css') }}">
    <link rel="stylesheet" href="{{asset('/css/admin/app.css')}}"/>
    <link rel="stylesheet" href="{{ asset('/css/admin/core.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/admin/forms.css') }}" >
    <link rel="stylesheet" href="{{ asset('/css/admin/custom.css') }}">
    <link rel="Shortcut Icon" href="{{asset('/images/ico.ico')}}">
    @yield('page_css')
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
</head>
<body class="page-body">
<div class="page-container @if(isset($_COOKIE['sidebar_status']) && $_COOKIE['sidebar_status'] == 'hide') sidebar-collapsed @endif">
    <div class="sidebar-menu">
        <header class="logo-env">
            <!-- logo -->
            <div class="logo">
                <a href="{{url('admin')}}">
                    <h1>C6</h1>
                </a>
            </div>
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon with-animation">
                    <i class="entypo-menu"></i>
                </a>
            </div>

            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation">
                    <i class="entypo-menu"></i>
                </a>
            </div>
        </header>
        <ul id="main-menu" class="">
            <li>
                <a href="{{ url('/admin') }}">
                    <i class="entypo-home"></i>
                    <span>控制面板</span>
                </a>
            </li>
            @foreach($menus as $menu)
                @if($menu['pid'] == 0)
                    <li>
                        <a href="{{url('')}}">
                            <i class="{{$menu->icon_class}}"></i>
                            <span>{{$menu['name']}}</span>
                        </a>
                        <ul>
                            @foreach($menus as $m)
                                @if($m['pid'] == $menu['id'])
                                    <li>
                                        @if($m['param'] == 1)
                                            <a href="{{url($m['url'],$m['id'])}}">
                                                <i class="{{$m['icon']}}"></i>
                                                <span>{{$m['name']}}</span>
                                            </a>
                                        @else
                                            <a href="{{url($m['url'])}}">
                                                <i class="{{$m->icon_class}}"></i>
                                                <span>{{$m['name']}}</span>
                                            </a>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach

        </ul>
    </div>
    <div class="main-content container">
        <div class="row">
            <!-- Profile Info and Notifications -->
            <div class="col-md-6 col-sm-8 clearfix">
                <ul class="user-info pull-left pull-none-xsm">

                    <!-- Profile Info -->
                    <li class="profile-info dropdown">
                        <!-- add class "pull-right" if you want to place this from right -->
                        @yield('page_title')
                        <ul class="dropdown-menu">
                            <!-- Reverse Caret -->
                            <li class="caret"></li>
                            <!-- Profile sub-links -->
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Raw Links -->
            @include('admin.top')
        </div>
        <hr />
    @include('admin.msg')
    @yield('content')
    <!-- Footer -->
        @section('modal')
            <div class="modal fade" id="modal" tabindex="-1"  aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content" style="z-index: 999; display: none;">
                    </div>
                </div>
            </div>
            <script src="{{ asset('/js/admin/modal.js') }}"></script>
        @show
        <footer class="main">
            &copy; {{date('Y')}} <strong>{{env('APP_NAME')}}</strong>
            Powered by
            <a href="http://www.timelink.cn" target="_blank">关于我们</a>
        </footer>
    </div>
</div>
<script src="{{ asset('/js/admin/gsap/main-gsap.js') }}"></script>
<script src="{{ asset('/js/admin/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/admin/joinable.js') }}"></script>
<script src="{{ asset('/js/admin/resizeable.js') }}"></script>
<script src="{{ asset('/js/admin/api.js') }}"></script>
<script src="{{ asset('/js/admin/cookies.min.js') }}"></script>
<script src="{{ asset('/js/admin/admin-common.js') }}"></script>
@yield('page_js')
<script type="text/javascript">
    $('.tips').delay(1500).slideUp(300);
    $(document).ready(function(){
        var currentAction = $('#main-menu a[href="{{URL::current()}}"]:last');
        var parentUl = currentAction.parent().parent('ul');
        var parentRoot = parentUl.parent('li.root-level');
        parentRoot.addClass('active opened').siblings().removeClass('active').removeClass('opened');
        if (parentRoot.hasClass('has-sub') || $('.page-container.sidebar-collapsed').length) {
            parentUl.slideDown(300);
        }
    });
</script>
</body>
</html>