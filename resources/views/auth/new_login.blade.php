<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Content Management System | </title>
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link href="{{asset('assets/backend/css/mystyle.css')}}" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="wrapper">
    <div class="headerlogin"></div>
    <form action="{{url('/cms')}}" method="post">
        {{ csrf_field() }}
        <div class="login">
            <h1 class="login-logo">ADMIN WEBSITE</h1>
            <div class="label_login" style="color:#900;" >
                @if(Session::has('message'))
                    {!! Session::get('message') !!}
                @endif
            </div>
            <div class="label_login">Username: </div>
            <div class="label_login" style="color:#900;" >
                @if($errors->has('username'))
                    <strong>{{$errors->first('username')}}</strong>
                @endif
            </div>
            <div class="txtfield_login"><input class="txtfield_input" style="padding:2px 5px; border: 1px solid #ab9b94;" type="text" name="username" value="" /></div>
            <div class="label_login">Password: </div>
            <div class="label_login" style="color:#900;" >
                @if($errors->has('password'))
                    <strong>{{$errors->first('password')}}</strong>
                @endif
            </div>
            <div class="txtfield_login">
                <input class="txtfield_input" style="padding:2px 5px;border: 1px solid #ab9b94;" type="password" name="password" value="" /></div>
                <div class="txtfield_login">
                {!! Captcha::img('inverse')!!} <br/>
                    <div class="label_login">Security Check:</div>
                    <div class="label_login" style="color:#900;" >
                    @if($errors->has('captcha'))
                        <strong>{{$errors->first('captcha')}}</strong>
                    @endif
                    </div>
                    <input class="txtfield_input" style="padding:2px 5px;border: 1px solid #ab9b94;" type="text" name="captcha" value="" />
                </div>
                <div class="btnfields"><input class="btnfield_input" type="submit" name="submitted" value="Login" style="border: 1px solid #ab9b94;" /> <a href="#" style="text-decoration:none;">Forgot Password?</a></div>
        </div>

    </form><br />
</div>
</body>

</html>
