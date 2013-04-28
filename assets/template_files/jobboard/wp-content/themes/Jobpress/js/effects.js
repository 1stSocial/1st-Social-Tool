jQuery(document).ready(function() {

jQuery('.squarebanner ul li:nth-child(even)').addClass('rbanner');


/* Navigation */
jQuery('#submenu ul.sfmenu').superfish({ 
		delay:       500,								// 0.1 second delay on mouseout 
		animation:   {height:'show'}				
	});	
	
	

		jQuery(".tab_content_login").hide();
		jQuery("ul.tabs_login li:first").addClass("active_login").show();
		jQuery(".tab_content_login:first").show();
		jQuery("ul.tabs_login li").click(function() {
			jQuery("ul.tabs_login li").removeClass("active_login");
			jQuery(this).addClass("active_login");
			jQuery(".tab_content_login").hide();
			var activeTab = jQuery(this).find("a").attr("href");
			if (jQuery.browser.msie) {jQuery(activeTab).show();}
			else {jQuery(activeTab).show();}
			return false;
		});

	

});