       <?php
session_start();
$myroot='';
include($myroot.'config/config.php');
$page='rug-designs';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
	<title>Marcus Paul</title>
	<meta name="description" content="Marcus Paul" />
	<meta name="keywords" content="Marcus Paul" />
	<?php include('includes/header.php') ?>

</head>
<body>
	<div class="preloader"></div>
	<i class="preloader-logo" style="display:none;"></i>

	<?php include('includes/nav.php') ?>

	<div class="mp-wrapper">
		<div class="mp-section">
			<div class="mp-coll-bg">
				<div class="row">
					<div class="col-md-2 hidden-xs hidden-sm">
						<div class="aside">
							<h4 class="mp-color">Colourway(s)</h4>
							<ul>
								<li><a href="#">
									<img data-original="images/products/th/coral-02-th.jpg" src="img/sqload.png" alt="" class="img-full load">
									<!-- <p>Light Grey/Taupe</p> -->
								</a></li>
								<li><a href="#">
									<img data-original="images/products/th/coral-03-th.jpg" src="img/sqload.png" alt="" class="img-full load">
									<!-- <p>Light Grey / Taupe</p> -->
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
										<h2>Coral</h2>

										<h3>Light Grey/Taupe</h3>

										<p>
											Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa 
										</p>

										<h5>Details</h5>

										<dl class="clearfix">
											<dt>Knot Count:</dt>
											<dd>100</dd>
											<div class="clearfix"></div>
											<dt>Size:</dt>
											<dd>200 x 300 cms</dd>
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
												<a class="img-pop" href="images/products/md/coral-02.jpg">
													<img src="images/products/md/coral-02.jpg" class="img-full" alt="Coral" />
												</a>
											</li>
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
								<li><a href="#">
									<img data-original="images/products/th/coral-02-th.jpg" src="img/sqload.png" alt="" class="img-full load">
									<!-- <p>Light Grey/Taupe</p> -->
								</a></li>
								<li><a href="#">
									<img data-original="images/products/th/coral-03-th.jpg" src="img/sqload.png" alt="" class="img-full load">
									<!-- <p>Light Grey / Taupe</p> -->
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
		<!-- mp-wrapper end -->
	</div>

	<?php include('includes/footer.php') ?>

	<?php include('includes/script.php') ?>
	
	<script>
		$(function() {
			$(".load").lazyload({
				effect : "fadeIn"
			});

			$(".img-pop").fancybox({
				openEffect	: 'fade',
				closeEffect	: 'fade',
				padding: 0,
				scrolling: 'no',
				openSpeed   : 'slow',
				closeClick : true,
				prevEffect: 'fade',
				nextEffect: 'fade',
				scrolling   : 'hidden',
				helpers: {
					overlay: {
						locked: true,
						closeClick: false
					}
				}
			});
			$(".enq-pop").fancybox({
				maxWidth	: 600,
				fitToView	: false,
				padding: 0,
				width		: '100%',
				// height		: '70%',
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none',
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
</body>
</html>