jQuery(document).ready(function($) {

	var $Form = $(".waum_form");

	$('.handlediv' , $Form).live( 'click', function() {
		$(this).parent().toggleClass('closed');
	});

});
