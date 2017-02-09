<?php
session_start();
$myroot='';
include($myroot.'config/config.php');
$page='about-us';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8;"/>
	<title>Marcus Paul</title>
	<meta name="description" content="Description" CONTENT="Marcus Paul"/>
	<meta name="keywords" content="Marcus Paul" />
	<?php include('includes/header.php') ?>
</head>
<body>
	<div class="preloader"></div>
	<i class="preloader-logo" style="display:none;"></i>

	<?php include('includes/nav.php') ?>
	<div class="mp-wrapper mp-btm-mar">
		<div class="container-fluid">
			<div class="mp-section">
				<div class="mp-coll-bg mp-bes-rug">
				<h1 class="wow fadeInUp" data-wow-delay="1.5s">About Us</h1>
					<div class="row mp-gu-6">
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="mp-fe-prod wow fadeIn" data-wow-delay="1s">
								<img src="images/section/01.jpg" alt="Tibetan" title="Tibetan" class="img-full">
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="mp-fe-prod wow fadeIn" data-wow-delay="1.5s">
								<img src="images/section/02.jpg" alt="Hand Spun Wool" title="Hand Spun Wool" class="img-full">
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="mp-fe-prod wow fadeIn" data-wow-delay="2s">
								<img src="images/section/03.jpg" alt="Hand Dyed" title="Hand Dyed" class="img-full">
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="mp-fe-prod wow fadeIn" data-wow-delay="2.5s">
								<img src="images/section/04.jpg" alt="Rug" title="Rug" class="img-full">
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="mp-fe-prod wow fadeIn" data-wow-delay="3s">
								<img src="images/section/05.jpg" alt="Rug Washing" title="Rug Washing" class="img-full">
							</div>
						</div>
						<div class="col-xs-6 col-sm-4 col-md-4">
							<div class="mp-fe-prod wow fadeIn" data-wow-delay="3.5s">
								<img src="images/section/06.jpg" alt="Rug" title="Rug" class="img-full">
							</div>
						</div>
						<div class="clearfix"></div>
					</div>
					<div class="mp-text-wrap wow fadeInUpT" data-wow-delay="3.5s">
						<p>Marcus Paul Hand Woven Rugs work with a small number of carefully selected high standard tibetan rug artisans that produce contemporary rug designs using traditional hand knot weaving methods.</p>

						<p>We have a small selection of designs that are readily available to order in any size that we can additionally produce in any colour. In the UK samples of our designs are available to see in the <a href="http://www.timpagecarpets.com/" target="_blank" class="mp-hov-link">Tim Page Carpets</a> showroom on the ground floor of the Design Centre Chelsea Harbour in London.</p>

						<p>The artisans that we work with are good weave accredited, providing reassurance that the working conditions and salaries paid to all related employees meet appropriate standards.
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>

	<?php include('includes/footer.php') ?>
	<?php include('includes/script.php') ?>

	<!-- <script>
		$(function() {
			var t=2;
			$('.mp-fe-prod, .mp-text-wrap').each(function(){
				$(this).attr('data-wow-delay',(t+=0.5)+"s");
			});
		});
	</script> -->
</body>
</html>