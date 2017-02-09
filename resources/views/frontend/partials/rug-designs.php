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
	<meta name="description" content="Description"/>
	<meta name="keywords" content="Marcus Paul" />
	<?php include('includes/header.php') ?>
</head>
<body>
	<div class="preloader"></div>
	<i class="preloader-logo" style="display:none;"></i>

	<?php include('includes/nav.php') ?>
	<div class="mp-wrapper">
		<div class="container-fluid">
			<div class="mp-section">
				<div class="mp-all-img mp-coll-bg">
					<!-- <h1>Collections</h1> -->
					<div class="row mp-gu-1">
						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
							<figure class="mp-coll-cont relative">
								<img data-original="<?php echo SITE_URL; ?>images/products/md/coral-01.jpg" src="<?php echo SITE_URL; ?>img/load.png" class="img-full load relative" alt="Coral" title="Coral"/>
								<a href="<?php echo SITE_URL; ?>rug-design-detail.php">
									<figcaption class="absolute cover">
										<h3>Coral</h3>
									</figcaption>	
								</a>		
							</figure>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
							<figure class="mp-coll-cont relative">
								<img data-original="<?php echo SITE_URL; ?>images/products/md/design-no-01.jpg" src="<?php echo SITE_URL; ?>img/load.png" class="img-full load relative" alt="Design No M1" title="Design No M1"/>
								<a href="#">
									<figcaption class="absolute cover">
										<h3>Design No M1</h3>
									</figcaption>	
								</a>		
							</figure>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
							<figure class="mp-coll-cont relative">
								<img data-original="<?php echo SITE_URL; ?>images/products/md/design-no-02.jpg" src="<?php echo SITE_URL; ?>img/load.png" class="img-full load relative" alt="Design No M2" title="Design No M2"/>
								<a href="#">
									<figcaption class="absolute cover">
										<h3>Design No M2</h3>
									</figcaption>	
								</a>		
							</figure>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
							<figure class="mp-coll-cont relative">
								<img data-original="<?php echo SITE_URL; ?>images/products/md/design-no-03.jpg" src="<?php echo SITE_URL; ?>img/load.png" class="img-full load relative" alt="Design No M3" title="Design No M3"/>
								<a href="#">
									<figcaption class="absolute cover">
										<h3>Design No M3</h3>
									</figcaption>	
								</a>		
							</figure>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
							<figure class="mp-coll-cont relative">
								<img data-original="<?php echo SITE_URL; ?>images/products/md/rugs02.jpg" src="<?php echo SITE_URL; ?>img/load.png" class="img-full load relative" alt="Design No M4" title="Design No M4"/>
								<a href="#">
									<figcaption class="absolute cover">
										<h3>Design No M4</h3>
									</figcaption>	
								</a>		
							</figure>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
							<figure class="mp-coll-cont relative">
								<img data-original="<?php echo SITE_URL; ?>images/products/md/rugs03.jpg" src="<?php echo SITE_URL; ?>img/load.png" class="img-full load relative" alt="Design No M5" title="Design No M5"/>
								<a href="#">
									<figcaption class="absolute cover">
										<h3>Design No M5</h3>
									</figcaption>	
								</a>		
							</figure>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
							<figure class="mp-coll-cont relative">
								<img data-original="<?php echo SITE_URL; ?>images/products/md/ikat-zig-zag.jpg" src="<?php echo SITE_URL; ?>img/load.png" class="img-full load relative" alt="Ikat Zig Zag" title="Ikat Zig Zag"/>
								<a href="#">
									<figcaption class="absolute cover">
										<h3>Ikat Zig Zag</h3>
									</figcaption>	
								</a>		
							</figure>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
							<figure class="mp-coll-cont relative">
								<img data-original="<?php echo SITE_URL; ?>images/products/md/mustang.jpg" src="<?php echo SITE_URL; ?>img/load.png" class="img-full load relative" alt="Mustang" title="Mustang"/>
								<a href="#">
									<figcaption class="absolute cover">
										<h3>Mustang</h3>
									</figcaption>	
								</a>		
							</figure>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
							<figure class="mp-coll-cont relative">
								<img data-original="<?php echo SITE_URL; ?>images/products/md/stripe-scrunch-01.jpg" src="<?php echo SITE_URL; ?>img/load.png" class="img-full load relative" alt="Stripe Scrunch" title="Stripe Scrunch"/>
								<a href="#">
									<figcaption class="absolute cover">
										<h3>Stripe Scrunch</h3>
									</figcaption>	
								</a>		
							</figure>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
							<figure class="mp-coll-cont relative">
								<img data-original="<?php echo SITE_URL; ?>images/products/md/water-colour-01.jpg" src="<?php echo SITE_URL; ?>img/load.png" class="img-full load relative" alt="Water Colour" title="Water Colour"/>
								<a href="#">
									<figcaption class="absolute cover">
										<h3>Water Colour</h3>
									</figcaption>	
								</a>		
							</figure>
						</div>

						<div class="col-xs-6 col-sm-3 col-md-3 col-lg-5m">
							<figure class="mp-coll-cont relative">
								<img data-original="<?php echo SITE_URL; ?>images/products/md/white-ikat-01.jpg" src="<?php echo SITE_URL; ?>img/load.png" class="img-full load relative" alt="White Ikat" title="White Ikat"/>
								<a href="#">
									<figcaption class="absolute cover">
										<h3>White Ikat</h3>
									</figcaption>	
								</a>		
							</figure>
						</div>

					</div>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<?php include('includes/footer.php') ?>
<?php include('includes/script.php') ?>

</body>
</html>