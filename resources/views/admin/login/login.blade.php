<!doctype html>
<html>
<head>
    <meta charset="UTF-8"/>
    <title>后台管理</title>
	<link rel="stylesheet" type="text/css" href="/css/admin/admin_login.css"/>
</head>
<body>
<div class="admin_login_wrap">
    <h4>后台管理</h4>
    <div class="adming_login_border">
        <div class="admin_input">

                    @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                @endif

        <form action="{{route('dologin')}}" method="post">
		{{csrf_field() }}
                <ul class="admin_items">
                    <li>
                        <label for="user">用户名：</label>
                        <input type="text" name="username" value="" id="user" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <label for="pwd">密码：</label>
                        <input type="password" name="password" value="" id="pwd" size="40" class="admin_input_style" />
                    </li>
                    <li>
                        <input type="submit"  value="登录" class="btn btn-primary" />
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>
</body>
</html>