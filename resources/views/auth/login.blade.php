<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{env('APP_NAME')}}|登陆</title>
    <link rel="stylesheet" href="{{asset('/css/admin/font-icons/entypo/css/entypo.css')}}">
    <link rel="stylesheet" href="{{asset('/css/admin/app.css')}}">
    <link rel="stylesheet" href="{{asset('/css/admin/core.css')}}" >
    <link rel="stylesheet" href="{{asset('/css/admin/forms.css')}}">
    <link rel="stylesheet" href="{{asset('/css/admin/custom.css')}}">
    <script src="{{asset('/js/jquery.min.js')}}"></script>
    <script type="text/javascript">var baseurl = "{{ url('/') }}";</script>
</head>
<body class="page-body login-page login-form-fall">
<div class="login-container">
    <div class="login-header login-caret">
        <div class="login-content">
            <a href="{{ url('/admin') }}" target="_blank" class="logo">
                <h1>{{env('APP_NAME')}}</h1>
            </a>
            <!-- progress bar indicator -->
            <div class="login-progressbar-indicator">
                <h3>0%</h3>
                <span>登录中...</span>
            </div>
        </div>
    </div>
    <div class="login-progressbar">
        <div></div>
    </div>
    <div class="login-form">
        <div class="login-content">
            <div class="form-login-error">
                <h3>登录失败</h3>
                <p>用户名或密码错误</p>
            </div>
            <form method="post"  role="form" id="form_login">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"> <i class="entypo-user"></i></div>
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                        <input type="text" class="form-control" name="name" id="name" placeholder="用户名" autocomplete="off" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon"> <i class="entypo-key"></i></div>
                        <input type="password" class="form-control" name="password" id="password" placeholder="密码" autocomplete="off" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-addon">记住密码</div>
                        <input type="checkbox" style="float:left" name="remember" id="remember"/>
                        <a href="{{url('/password/email')}}" class="link" style="float: right;padding-right: 20px">忘记密码?</a>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-login">
                        登录
                        <i class="entypo-login"></i>
                    </button>
                </div>


            </form>
            <div class="login-bottom-links">
                <hr />
                <a href="http://www.timelink.cn" target="_blank">关于我们</a>
                -
                <a href="http://wpa.qq.com/msgrd?v=3&uin=923382771&site=qq&menu=yes" target="_blank">联系作者</a>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/js/admin/gsap/main-gsap.js')}}"></script>
<script src="{{asset('/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/jquery.validate.min.js')}}" ></script>
<script src="{{asset('/js/admin/admin_login.js')}}" ></script>
</body>
</html>