@extends('cms.layout.master')
@section('extra-styles')
@endsection
@section('main-content')
    <h1>Dashboard</h1>
    <div class="clearboth"></div>
    <div class="dashboard_paragraph">
        <p>Dear {{Auth::user()->username}},</p>
        <p>Welcome to <b></b> website content management system.</p>
        <p>Do not forget to <a href="{{url('cms/logout')}}" class="mylink1">logout</a> when you have finished using the system.</p>
        <p style="margin-top:10px;">Please click the required area that you wish to manage below:</p>
    </div>

    <div class="mpleft">
        {!! AppHelper::renderHtmlForDashboard(['home','cms.home']) !!}
    </div>
    </div>

    <div class="mpleft">
        {!! AppHelper::renderHtmlForDashboard(['Rug Designs','cms.login']) !!}
    </div>
    </div>

    <div class="mpright">
        {!! AppHelper::renderHtmlForDashboard(['Bespoke Rug Service','cms.login']) !!}
    </div>
    </div>
    <div class="spacer20"></div>


    <div class="spacer20"></div>

    <div class="mpleft">
        {!! AppHelper::renderHtmlForDashboard(['About Us','cms.login']) !!}
    </div>
    </div>

    <div class="mpleft">
        {!! AppHelper::renderHtmlForDashboard(['Contact Us','cms.login']) !!}
    </div>
    </div>

    {{--<div class="mpright">--}}
    {{--{!! AppHelper::renderHtmlForDashboard(['decorative pieces','cms.login']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="spacer20"></div>--}}

    {{--<h1>The Edit</h1>--}}
    {{--<div class="spacer20"></div>--}}
    {{--<div class="mpleft">--}}
    {{--{!! AppHelper::renderHtmlForDashboard(['all news','cms.login']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="mpleft">--}}
    {{--{!! AppHelper::renderHtmlForDashboard(['resources','cms.login']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<div class="mpright">--}}
    {{--{!! AppHelper::renderHtmlForDashboard(['instagram','cms.login']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="spacer20"></div>--}}
    {{--<div class="mpleft">--}}
    {{--{!! AppHelper::renderHtmlForDashboard(['gallery','cms.login']) !!}--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="spacer20"></div>
    <h1>Terms & conditions and Sales Order</h1>
    <div class="spacer20"></div>
    <div class="mpleft">
        {!! AppHelper::renderHtmlForDashboard(['terms & conditions','cms.login']) !!}
    </div>
    </div>
    <div class="mpleft">
        <div class="maintitle" style="padding-left: 10px;"><b>Orders</b></div>
        <div class="maincont" style="padding: 10px; text-align: left;">View sales orders. <br>
            <br>
            <a href="login.php?p_id=manage_sales" class="dashboard_btn">Click Here</a> </div>
    </div>
    <div class="spacer20"></div>
    <h1>Website Status</h1>
    <div class="spacer20"></div>
    <div class="mpleft">
        <div class="maintitle" style="padding-left: 10px;"><b>Website Status</b></div>
        <div class="maincont" style="padding: 10px; text-align: left;">Change Website Status. <br>
            <br>
            <a href="ajax/change_website_status.php" class="dashboard_btn change_status fancybox.ajax">Click Here</a> </div>
    </div>
    <script>
        $(function(){
            $('.change_status').fancybox();
        });
    </script>
    <div class="clearboth"></div>
@endsection
@section('extra-scripts')
@endsection