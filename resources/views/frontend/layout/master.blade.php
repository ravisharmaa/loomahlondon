<!DOCTYPE html>
<html lang="en">
<head>
    @include($header)
</head>
@yield('extra-css')
<body class="{{Request::is('/')?'mp-ho-nav':''}}">
    <div class="preloader"></div>
    <i class="preloader-logo" style="display:none;"></i>

    @include($nav)

    @yield('home-section')

        <div class="container-fluid">
            @yield('content')
    </div>

    <div class="clearfix"></div>
    </div>
    @include($footer)

    @yield('extra-scripts')
</body>
</html>