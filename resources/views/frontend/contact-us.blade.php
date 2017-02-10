@extends($master)

@section('extra-css')

@endsection
@section('home-section')
@endsection
@section('content')
    <div class="mp-section">
        <div class="mp-coll-bg mp-con-detail">
            <h1>Contact Us</h1>
            <div class="mp-in-page">
                <p>To send an enquiry, please complete the form below and click submit.</p>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="form-body le-ri-padding">
                            {{Form ::open(['route'=> $base_route.'.send-mail','method'=>'POST','class'=>'form-horizontal'])}}
                                @include('frontend.partials._forms._contactform', ['submitBtn'=>'Submit'])
                            {{Form::close()}}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6">
                        <div class="mp-cont-info">
                            <img src="{{asset('assets/frontend/img/mp-lc.png')}}" height="58" alt="">
                            <h2>Marcus Paul Rugs is a trading <br class="hidden-xs hidden-sm">name of Npal Ltd.</h2>
                            <p>Registered Office: Unit 1B Theaklen House,<br class="hidden-xs hidden-sm"> Theaklen Drive, St Leonards on Sea,<br class="hidden-xs hidden-sm"> East Sussex TN38 9AZ, United Kingdom
                                Registered in England and Wales.<br class="visible-xs visible-sm"> Company No.: 08087700<br>
                                VAT No.: 204 5530 45<br><br>
                                Tel: +44 (0)1424 403000 &nbsp;<br> Email: <a href="mailto:orders@marcuspaulrugs.com">orders@marcuspaulrugs.com</a>
                            </p>
                            <p>
                                <span>Distributed by Tim Page Carpets</span>
                                Design Centre Chelsea Harbour<br>
                                Lots Road, London, SW10 0XE<br><br>
                                Tel: +44 (0)20 7259 7282<br>
                                Email: <a href="mailto:sales@timpagecarpets.com" target="_blank">sales@timpagecarpets.com</a><br>
                                <a href="http://www.timpagecarpets.com/" target="_blank">www.timpagecarpets.com</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection
@section('extra-scripts')
    <script>
        $(function() {
            $(".load").lazyload({
                effect : "fadeIn"
            });
        });
    </script>
@endsection