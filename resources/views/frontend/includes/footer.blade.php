<div class="footer">
    <div class="container wow fadeInUp">
        <p>
            Marcus Paul Rugs is a trading name of Npal Ltd.<br>
            Registered Office: Unit 1B Theaklen House, Theaklen Drive, St Leonards on Sea,<br> East Sussex TN38 9AZ, United Kingdom
            Registered in England and Wales.<br class="visible-xs visible-sm"> Company No.: 08087700<br>
            VAT No.: 204 5530 45<br><br>
            Tel: +44 (0)1424 403000 &nbsp;<br class="visible-xs"> Email: <a href="mailto:orders@marcuspaulrugs.com">orders@marcuspaulrugs.com</a>
        </p>
    </div>
</div>
<script src="{{asset($front_js.'jquery-1.11.1.min.js')}}"></script>
<script src="{{asset($front_js.'modernizr.custom.js')}}"></script>
<script src="{{asset($front_js.'jquery.imagesloaded.min.js')}}"></script>
<script src="{{asset($front_js.'cbpBGSlideshow.min.js')}}"></script>
<script src="{{asset($front_js.'touchSwipe.js')}}"></script>
<script src="{{asset($front_js.'plugin.js')}}"></script>
<script src="{{asset($front_js.'custom.js')}}"></script>
<script>
    $(function() {
        $(".load").lazyload({
            effect : "fadeIn"
        });
    });
</script>
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
    });
</script>

