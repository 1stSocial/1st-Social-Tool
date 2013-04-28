jQuery(document).ready(function() {

/* Banner class */

	jQuery('.squarebanner ul li:nth-child(even)').addClass('rbanner');

 	jQuery('ul.siderevs li:last,ul.sidetops li:last').css('border', 'none');



/* Navigation */
	jQuery('#subnav ul.sfmenu').superfish({ 
		delay:       500,								// 0.1 second delay on mouseout 
		animation:   {opacity:'show',height:'show'},	// fade-in and slide-down animation 
		dropShadows: true								// disable drop shadows 
	});	

/* Slider */	
	
	 jQuery('.flexslider').flexslider({
		controlNav: false,
	 	directionNav:true,
		animation: "fade",              //String: Select your animation type, "fade" or "slide"
		slideshow: true                //Boolean: Animate slider automatically
	 	});
	
// Carousel	
	
	 jQuery('#carousel').carouFredSel({
		prev: '#prev2',
		next: '#next2',
		auto: {
			pauseOnHover: 'resume',
			onPauseStart: function( percentage, duration ) {
				 jQuery(this).trigger( 'configuration', ['width', function( value ) { 
						 jQuery('#timer1').stop().animate({
							width: value
							}, {
								duration: duration,
								easing: 'linear'
								});
							}]);
						},
						onPauseEnd: function( percentage, duration ) {
							 jQuery('#timer1').stop().width( 0 );
							},
						onPausePause: function( percentage, duration ) {
							 jQuery('#timer1').stop();
							}
						}
					});
	
});

