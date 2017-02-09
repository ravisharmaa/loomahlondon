$(function() {
	$(window).load(function() {
		$('.preloader-logo').fadeIn(500, function(){
			$('.preloader').delay(700).fadeOut(200,function(){
				$('.preloader-logo').fadeOut(200);
			});
		});
	});	

	$(window).scroll(function() {
		if ($(this).scrollTop() > 1){  
			$('.header').addClass("fixed");
		}
		else{
			$('.header').removeClass("fixed");
		}
	});

	$('#menu-toggle').click(function() {
		$(this).toggleClass('active');
		findBodyClass = $(this).hasClass('active')
		$('#overlay').toggleClass('open');
		$("li").toggleClass("navopen");
		if(findBodyClass){
			$('body').css('position', 'fixed');
		}
		else{
			$('body').css({'position': 'static'});
		}
	});

	// $('#menu-toggle').click(function() {
	// 	$(this).toggleClass('active');
	// 	findBodyClass = $(this).hasClass('active')
	// 	$('#overlay').toggleClass('open');
	// 	// if(findBodyClass){
	// 	// 	$('body').css('position', 'fixed');
	// 	// 	// alert('now');
	// 	// }
	// 	// else{
	// 	// 	$('body').css({'position': 'static'});
	// 	// }
	// 	$("li").toggleClass("navopen");
	// });
	$('.mp-nav li > a').on('click touchend', function(e) {
		var el = $(this);
		var link = el.attr('href');
		window.location = link;
	});
	
	$(window).load(function() {
		new WOW().init();
	});
});