<!DOCTYPE html>
<html lang="en">
<head>@include($header)</head>
<body class="mp-ho-nav">
    <div class="preloader"></div>
    <i class="preloader-logo" style="display:none;"></i>
        @section('nav-bar')
            @include($nav)
        @stop
<section class="wrap parallax">
    <ul id="cbp-bislideshow" class="cbp-bislideshow">
        <li>
            <img src="{{asset($test_images_url.'home/hand-spun-wool.jpg')}}" alt="Hand Spun Wool"
                 title="Hand Spun Wool"/>
            <div class="mp-ban-caption">
                <h2 class="wow fadeInDown">Suppliers of</h2>
                <h1 class="wow fadeInDown">Contemporary Rugs</h1>
                <h2 class="wow fadeInDown">Manufactured with traditional Tibetan artisans</h2>
            </div>
        </li>
        <li>
            <img src="{{asset($test_images_url.'home/rug-loom.jpg')}}" alt="Rug Loom" title="Rug Loom"/>
            <div class="mp-ban-caption">
                <h2 class="wow fadeInDown">Suppliers of</h2>
                <h1 class="wow fadeInDown">Contemporary Rugs</h1>
                <h2 class="wow fadeInDown">Manufactured with traditional Tibetan artisans</h2>
            </div>
        </li>
        <li>
            <img src="{{asset($test_images_url.'home/hand-dyed.jpg')}}" alt="Hand Dyed" title="Hand Dyed"/>
            <div class="mp-ban-caption">
                <h2 class="wow fadeInDown">Suppliers of</h2>
                <h1 class="wow fadeInDown">Contemporary Rugs</h1>
                <h2 class="wow fadeInDown">Manufactured with traditional Tibetan artisans</h2>
            </div>
        </li>
        <li><img src="{{asset($test_images_url.'home/shearing-and-finishing.jpg')}}" alt="Shearing and Finishing"
                 title="Shearing and Finishing"/>
            <div class="mp-ban-caption">
                <h2 class="wow fadeInDown">Suppliers of</h2>
                <h1 class="wow fadeInDown">Contemporary Rugs</h1>
                <h2 class="wow fadeInDown">Manufactured with traditional Tibetan artisans</h2>
            </div>
        </li>
    </ul>
    <div class="swipe-target"></div>
</section>
<div class="clearfix"></div>
<div class="mp-home-wrapper">

    <div class="container-fluid">
        <div class="mp-section">
            <div class="row mp-gu-6">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <h3 class="textLoad wow fadeInDown" data-wow-delay="1.5s">Marcus Paul Hand Woven Rugs design and
                        produce contemporary rugs and work with a small number of carefully selected, high standard
                        traditional Tibetan rug artisans.</h3>
                </div>
                <div class="clearfix"></div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="mp-fe-prod textLoad wow fadeIn" data-wow-delay="2s">
                        <a href="<?php echo SITE_URL; ?>rug-designs.php">
                            <img src="<?php echo SITE_URL; ?>images/home/rug-designs.jpg" alt="Rug Designs"
                                 title="Rug Designs" class="img-full">
                            <h4>Rug Designs</h4>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="mp-fe-prod textLoad wow fadeIn" data-wow-delay="0s">
                        <a href="<?php echo SITE_URL; ?>bespoke-rug-service.php">
                            <img src="<?php echo SITE_URL; ?>images/home/bespoke-rug-design-service.jpg"
                                 alt="Bespoke Rug Service" title="Bespoke Rug Service" class="img-full">
                            <h4>Bespoke Rug Service</h4>
                        </a>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="mp-fe-prod textLoad wow fadeIn" data-wow-delay="3s">
                        <a href="<?php echo SITE_URL; ?>about-us.php">
                            <img src="<?php echo SITE_URL; ?>images/home/about-us.jpg" alt="About Us" title="About Us"
                                 class="img-full">
                            <h4>About Us</h4>
                        </a>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>

<?php include('includes/footer.php') ?>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>
<script src="js/jquery.imagesloaded.min.js"></script>
<script src="js/cbpBGSlideshow.min.js"></script>
<script src="js/touchSwipe.js"></script>
<script src="js/plugin.js"></script>

<script>
    $(function () {
        cbpBGSlideshow.init();
        var screenHeight = 0;
        screenHeight = $(window).height();
        $(window).on('resize', function () {
            screenHeight = $(window).height();
            $('.wrap').css({'height': screenHeight - 210});
        });
        $('.wrap').css({'height': screenHeight - 210});
        $('#cbp-bislideshow').addClass('parallaxScroll');
        windowWidth = $(window).width();
        if (windowWidth > 1024) {
            var scrp = 0;
            var header = $('.parallax');
            var parallaxScroll = $('.parallaxScroll');
            $(window).scroll(function () {
                scrollTop = $(window).scrollTop();
                if ($(header).length) {
                    var offset = header.offset().top;
                }
                var height = header.outerHeight();
                $(parallaxScroll).css({'top': scrollTop * 0.8});
            });
        }
        var isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
        var isChrome = !!window.chrome && !isOpera;
        if (!!window.chrome) {
            jQuery.scrollSpeed(80, 800);
        }
        // $('.cbp-bislideshow').bind('touchmove', function(event) {
        // 	event.preventDefault();
        // }, false);

        // $(".swipe-target").touchwipe({

        // 	wipeLeft: function() {
        // 		navigate.cbp-biprev('');
        // 	},
        // 	wipeRight: function() {
        // 		navigate.cbp-binext('');
        // 	},
        // 	min_move_x: 20,
        // 	preventDefaultEvents: true,
        // 	//alert(abc);
        // })

    });
</script>
<script src="js/custom.js"></script>
</body>
</html>