
@extends($master)
@section('extra-css')
@endsection
@section('home-section')
    <div class="mp-wrapper">
@endsection
    @section('content')
            <div class="mp-section">
                <div class="mp-coll-bg">
                    <div class="row">
                        <div class="col-md-2 hidden-xs hidden-sm">
                            <div class="aside">
                                <h4 class="mp-color">Colourway(s)</h4>
                                <ul>
                                    @foreach($data['colourway'] as $c)
                                    <li><a href="coral-light-grey.php">
                                            <img data-original="{{asset('images/colourways/th/'.$c->colourway_th_image)}}" src="img/sqload.png" alt="" class="img-full load">
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                <!-- aside end-->
                            </div>
                            <!-- col-md-2 end-->
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-10">
                            <div class="mp-detail-img">
                                <div class="mp-breadcrumb">
                                    <ul class="pull-left">
                                        <li><a href="rug-designs.php">Back to Index</a></li>
                                    </ul>
                                    <ul class="pull-right">
                                        <li><a href="#">Previous</a></li>
                                        <li><a href="#">Next</a></li>
                                    </ul>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-7">
                                        <div class="mp-detail">
                                            <h2>{{isset($data['product']->product_name)   ? $data['product']->product_name:''}}</h2>
                                            <h3>{{isset($data['product']->colourway_name) ? $data['product']->colourway_name:''}}</h3>
                                            <p>
                                                {{isset($data['product']->product_desc) ? $data['product']->product_desc:''}}
                                            </p>
                                            <h5>Details</h5>
                                            <dl class="clearfix">
                                                <dt>Knot Count:</dt>
                                                <dd>{{isset($data['product']->product_knotcnt) ? $data['product']->product_knotcnt:''}}</dd>
                                                <div class="clearfix"></div>
                                                <dt>Size:</dt>
                                                <dd>{{isset($data['product']->product_size) ? $data['product']->product_size:''}} </dd>
                                            </dl>
                                            <button type="button" name="Enquire now" class="enq-pop fancybox.ajax btn mp-enquire" href="enquire-now.php">
                                                <span>Enquire</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-5">
                                        <div class="mp-zoom-img flexslider">
                                            <ul class="slides">
                                                <li>
                                                    <a class="img-pop" href="{{asset('images/colourways/lg/'.$data['product']->colourway_lg_image)}}">
                                                        <img src="{{asset('images/rug-designs/'.$data['product']->product_image)}}" class="img-full" alt="Coral" title="Coral" />
                                                    </a>
                                                </li>
                                            <!-- <li>
													<a class="img-pop" href="images/products/lg/coral-lg-01-01.jpg">
														<img src="images/products/lg/coral-lg-01-01.jpg" class="img-full" alt="Coral" />
													</a>
												</li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <!-- detail-row end-->
                                </div>
                            </div>
                        </div>

                        <!-- small device -->
                        <div class="col-xs-12 col-sm-12 visible-xs visible-sm">
                            <div class="aside">
                                <h4 class="mp-color">Colourway(s)</h4>
                                <ul class="clearfix">
                                    <li><a href="coral-light-grey.php">
                                            <img data-original="images/products/th/coral-02-th.jpg" src="img/sqload.png" alt="" class="img-full load">
                                        </a></li>
                                    <li><a href="#">
                                            <img data-original="images/products/th/coral-03-th.jpg" src="img/sqload.png" alt="" class="img-full load">
                                        </a></li>
                                    <li><a href="#">
                                            <img data-original="images/products/th/coral-04-th.jpg" src="img/sqload.png" alt="" class="img-full load">
                                        </a></li>
                                    <li><a href="#">
                                            <img data-original="images/products/th/coral-05-th.jpg" src="img/sqload.png" alt="" class="img-full load">
                                        </a></li>
                                    <li><a href="#">
                                            <img data-original="images/products/th/coral-06-th.jpg" src="img/sqload.png" alt="" class="img-full load">
                                        </a></li>
                                    <li><a href="#">
                                            <img data-original="images/products/th/coral-07-th.jpg" src="img/sqload.png" alt="" class="img-full load">
                                        </a></li>
                                </ul>
                                <!-- aside end-->
                            </div>
                            <!-- col-md-2 end-->
                        </div>
                        <!-- row end -->
                    </div>
                    <div class="clearfix"></div>
                    <!-- mp-coll-bg end-->
                </div>
                <div class="clearfix"></div>
                <!-- mp-section end -->
            </div>
    @endsection
@section('extra-scripts')
            <script>
                $(function() {
                    $(".img-pop").fancybox({
                        autoCenter	: true,
                        closeClick	: true,
                        closeEffect	: 'fade',
                        maxHeight	: '90%',
                        openEffect	: 'fade',
                        openSpeed   : 'slow',
                        nextEffect	: 'fade',
                        prevEffect	: 'fade',
                        padding		:  0,
                        scrolling	: 'hidden',
                        helpers: {
                            overlay: {
                                locked: true,
                                closeClick: false
                            }
                        }
                    });
                    $(".enq-pop").fancybox({
                        maxWidth	: 600,
                        padding		: 0,
                        width		: '100%',
                        autoSize	: false,
                        openEffect: 'fade',
                        'transitionIn' : 'fade',
                        'transitionOut' : 'fade',
                        scrolling   : 'hidden',
                        helpers: {
                            overlay : {
                                locked: true,
                                closeClick: false
                            }
                        }
                    });
                    $('.flexslider').flexslider({
                        animation: "slide",
                        start: function(slider){
                            //$('body').removeClass('loading');
                        }
                    });
                });

            </script>

            <script>
                $("document").ready(function(){
                    $(".colourway_data").click(function(e){
                        e.preventDefault();
                        var $this  =     $(this);
                        var id     =     $this.attr('data-id');
                        var url    =    '{{asset('/')}}';

                        $.ajax({
                            method: "GET",
                            url : ' {{url('get-colourway-data')}}'+'/'+ id,
                            error:function (request) {
                                console.log(request.responseText);
                            },
                            success:function (data) {
                                var newData = jQuery.parseJSON(data);
                                if(newData.data[0].colourway_name){
                                    $("#colourway_name").html('<h3>'+ newData.data[0].colourway_name + '</h3>' );
                                    $("#image_data").attr('href',url +'images/colourway/lg/'+ newData.data[0].colourway_lg_image);
                                    $("#main_image").attr('src', url+'images/colourway/lg/'+newData.data[0].colourway_lg_image)

                                }

                            }

                        })
                    });
                });

            </script>
@endsection