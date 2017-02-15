<div class="header">
    <div class="wrapper">
        <div class="left">
            <h1> {{Auth::user()->name}}</h1>
            <h2> Welcome {{AppHelper::getConfigValues('site-admin')}} (Username:{{Auth::user()->username}})  </h2>
            <div class="plate">
                <a style="font: 11px/15px Arial,Helvetica,sans-serif;padding: 0;" href="{{url('/')}}" target="_blank" class="visitsite">Visit Site</a> |
                <a style="font: 11px/15px Arial,Helvetica,sans-serif;padding: 0;" href="{{url('cms/dashboard')}}" class="dashboard">Dashboard</a> |

                <a style="font: 11px/15px Arial,Helvetica,sans-serif;padding: 0;" href="login.php?p_id=admin_users" class="adminuser">User Profile</a> |
                {{--<a style="font: 11px/15px Arial,Helvetica,sans-serif;padding: 0;" href="login.php?p_id=change_password" class="changepassword">Change Password</a> | */?>--}}
                <a style="font: 11px/15px Arial,Helvetica,sans-serif;padding: 0;" href="{{route('cms.logout')}}" class="logout">Logout</a>
            </div>
        </div>
        <div class="right"></div>
        <div class="clearboth"></div>
        <div class="nav">
            <ul class="sf-menu">
                @foreach($menus as $key => $value)
                     <li><a href="{{route($key)}}">{{$value}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>