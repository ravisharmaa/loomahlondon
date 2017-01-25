<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    @include($header)
    @yield('extra-styles')
        <body style="background:#f3f3f3;">
            @include($navbar)
        <div class="container" style="margin-bottom:0;">
            @yield('main-content')
        </div>
        @yield('extra-scripts')

        </body>
</html>