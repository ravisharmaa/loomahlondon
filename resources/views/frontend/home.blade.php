@extends($master)
@section('extra-css')
@endsection
@section('home-section')
    <section class="wrap parallax">
        <ul id="cbp-bislideshow" class="cbp-bislideshow">
            <li>
                <img src="{{asset($test_image_url.'home/hand-spun-wool.jpg')}}" alt="Hand Spun Wool"
                     title="Hand Spun Wool"/>
                <div class="mp-ban-caption">
                    <h2 class="wow fadeInDown">Suppliers of</h2>
                    <h1 class="wow fadeInDown">Contemporary Rugs</h1>
                    <h2 class="wow fadeInDown">Manufactured with traditional Tibetan artisans</h2>
                </div>
            </li>
            <li>
                <img src="{{asset($test_image_url.'home/rug-loom.jpg')}}" alt="Rug Loom" title="Rug Loom"/>
                <div class="mp-ban-caption">
                    <h2 class="wow fadeInDown">Suppliers of</h2>
                    <h1 class="wow fadeInDown">Contemporary Rugs</h1>
                    <h2 class="wow fadeInDown">Manufactured with traditional Tibetan artisans</h2>
                </div>
            </li>
            <li>
                <img src="{{asset($test_image_url.'home/hand-dyed.jpg')}}" alt="Hand Dyed" title="Hand Dyed"/>
                <div class="mp-ban-caption">
                    <h2 class="wow fadeInDown">Suppliers of</h2>
                    <h1 class="wow fadeInDown">Contemporary Rugs</h1>
                    <h2 class="wow fadeInDown">Manufactured with traditional Tibetan artisans</h2>
                </div>
            </li>
            <li><img src="{{asset($test_image_url.'home/shearing-and-finishing.jpg')}}" alt="Shearing and Finishing"
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
@endsection

@section('content')
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
                    <a href="rug-designs.php">
                        <img src="{{asset($test_image_url.'home/rug-designs.jpg')}}" alt="Rug Designs"
                             title="Rug Designs" class="img-full">
                        <h4>Rug Designs</h4>
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="mp-fe-prod textLoad wow fadeIn" data-wow-delay="0s">
                    <a href="bespoke-rug-service.php">
                        <img src="{{asset($test_image_url.'home/bespoke-rug-design-service.jpg')}}"
                             alt="Bespoke Rug Service" title="Bespoke Rug Service" class="img-full">
                        <h4>Bespoke Rug Service</h4>
                    </a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-4">
                <div class="mp-fe-prod textLoad wow fadeIn" data-wow-delay="3s">
                    <a href="about-us.php">
                        <img src="{{asset($test_image_url.'home/about-us.jpg')}}" alt="About Us" title="About Us"
                             class="img-full">
                        <h4>About Us</h4>
                    </a>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
@endsection

@section('extra-scripts')

@endsection

