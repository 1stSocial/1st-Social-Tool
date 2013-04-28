<?php
function theme_guide(){
add_theme_page( 'Theme guide','Theme documentation','edit_themes', 'theme-documentation', 'w2f_theme_guide');
}
add_action('admin_menu', 'theme_guide');

function w2f_theme_guide(){
		echo '<div class="wrap">
		<div id="icon-options-general" class="icon32"><br></div>
		<h2>Theme Documentation</h2>
		
		<div class="metabox-holder">
		<div class="postbox-container" style="width:70%;">
		
		
		
				<div class="postbox"> <!-- postbox begin -->
						<h3 class="hndle"> <span> Theme License </span> </h3>
						
						<div class="inside">
						<p>	The PHP code of the theme is licensed under the GPL license as is WordPress itself. You can read it here: http://codex.wordpress.org/GPL. 
  							All other parts of the theme including, but not limited to the CSS code, images, and design are licensed for free personal usage.  </p>
  								<p> You are requested to retain the credit banners on the template. </p>
  								<p> You are allowed to use the theme on multiple installations, and to edit the template for your personal use. </p>
  								<p> You are NOT allowed to edit the theme or change its form with the intention to resell or redistribute it. </p>  
  								<p> You are NOT allowed to use the theme as a part of a template repository for any paid CMS service. </p>
							
						</div>
				</div> <!-- postbox end -->
				
				
				<div class="postbox"> <!-- postbox begin -->
						<h3 class="hndle"> <span> About the theme </span> </h3>
						
						<div class="inside">
						<p>	Western is a free wordpress theme to run a powerful tutorial site. This theme employs wordpress features like, custom post types, custom taxonomies, and metaboxes to power up the tutorial site.   </p>
  								<p> The theme is also fitted with an option panel to adjust various options and settings.. </p>
  						
						</div>
				</div> <!-- postbox end -->
				
				
				<div class="postbox"> <!-- postbox begin -->
						<h3 class="hndle"> <span> Create a Tutorial post </span> </h3>
						
						<div class="inside">
						<p> Creating tutorials are similar to creating posts. You can enter the title of your tutorial and enter the tutorial in the post editor. You can select a taxonomy called "topic" . They work just like Categories for posts. In addition you will have different metaboxes to enter different details about the tutorial such as The program, difficulty level, estimated time , Demo link, tutorial source files etc.  </p>
  						
						</div>
				</div> <!-- postbox end -->
		
		</div>
		</div>
		
		
		
		</div>';
}

 ?>