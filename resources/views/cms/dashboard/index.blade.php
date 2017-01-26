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
        {!! AppHelper::renderHtmlForDashboard(['maintitle','home','cms.login']) !!}
    </div>
    </div>
    <div class="mpleft">
        {!! AppHelper::renderHtmlForDashboard(['maintitle','about','cms.login']) !!}
    </div>
    </div>
    <div class="mpright">
        {!! AppHelper::renderHtmlForDashboard(['maintitle','about','cms.login']) !!}
    </div>
    </div>
    <div class="spacer20"></div>
    <h1>Products</h1>
    <div class="spacer20"></div>
    <div class="mpleft">
        <div class="maintitle" style="padding-left: 10px;"><b>Textiles</b></div>
        {!! Lang::get('helptext.HELP_TEXT_PRODUCT',['product'=>'textiles']) !!}
            <br>
            <a href="login.php?p_id=manage_textiles&id=1" class="dashboard_btn">Click Here</a> </div>
    </div>

    <div class="mpleft">
        <div class="maintitle" style="padding-left: 10px;"><b>Wallpapers</b></div>
        {!! Lang::get('helptext.HELP_TEXT_PRODUCT',['product'=>'wallpaper']) !!}
            <br>
            <a href="login.php?p_id=manage_wallpapers&id=2" class="dashboard_btn">Click Here</a> </div>
    </div>
    <div class="mpright">
        <div class="maintitle" style="padding-left: 10px;"><b>Decorative Pieces</b></div>
        {!! Lang::get('helptext.HELP_TEXT_PRODUCT',['product'=>'decorative piece']) !!}
            <br>
            <a href="login.php?p_id=manage_decorative_pieces&id=3" class="dashboard_btn">Click Here</a> </div>
    </div>

    <div class="spacer20"></div>
    <h1>The Edit</h1>
    <div class="spacer20"></div>
    <div class="mpleft">
        <div class="maintitle" style="padding-left: 10px;"><b>All News</b></div>
        {!! Lang::get('helptext.HELP_TEXT_PAGE',['page'=>'news']) !!}
            <br>
            <a href="login.php?p_id=manage_blogs" class="dashboard_btn">Click Here</a> </div>
    </div>
    <div class="mpleft">
        <div class="maintitle" style="padding-left: 10px;"><b>Resources</b></div>
        {!! Lang::get('helptext.HELP_TEXT_PAGE',['page'=>'resources']) !!}
            <br>
            <a href="login.php?p_id=manage_resources" class="dashboard_btn">Click Here</a> </div>
    </div>

    <div class="mpright">
        <div class="maintitle" style="padding-left: 10px;"><b>Instagram</b></div>
        {!! Lang::get('helptext.HELP_TEXT_PAGE',['page'=>'instagram']) !!}
            <br>
            <a href="login.php?p_id=manage_instagram" class="dashboard_btn">Click Here</a> </div>
    </div>
    <div class="spacer20"></div>
    <div class="mpleft">
        <div class="maintitle" style="padding-left: 10px;"><b>Gallery</b></div>
        {!! Lang::get('helptext.HELP_TEXT_PAGE',['page'=>'gallery']) !!}
            <br>
            <a href="login.php?p_id=manage_gallery" class="dashboard_btn">Click Here</a> </div>
    </div>
    <div class="spacer20"></div>
    <h1>Terms & conditions and Sales Order</h1>
    <div class="spacer20"></div>
    <div class="mpleft">
        <div class="maintitle" style="padding-left: 10px;"><b>Terms & conditions</b></div>
        {!! Lang::get('helptext.HELP_TEXT_PAGE',['page'=>'terms & conditions']) !!}
            <br>
            <a href="login.php?p_id=manage_legal&page=1" class="dashboard_btn">Click Here</a> </div>
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
        <div class="maincont" style="padding: 10px; text-align: left;">Change website Status. <br>
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