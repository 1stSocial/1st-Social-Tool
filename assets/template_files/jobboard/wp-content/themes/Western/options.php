<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Test data
	$test_array = array("1" => "Jobs","2" => "Posts");
	
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';
		
	$options = array();
	
	
	$options[] = array( "name" => "General",
						"type" => "heading");	
						
	$options[] = array( "name" => "Use Image logo?",
						"desc" => "Check if you want to use an image logo.",
						"id" => "w2f_logo",
						"std" => "1",
						"type" => "checkbox");		
		
	$options[] = array( "name" => "Site Logo image",
						"desc" => "Upload your logo image.",
						"id" => "w2f_logopic",
						"std" => get_bloginfo('template_url') ."/images/logo.png",
						"type" => "upload");	
		
	$options[] = array( "name" => "Twitter id",
						"desc" => "Enter your twitter id.",
						"id" => "w2f_twitter",
						"std" => "twitter",
						"type" => "text");		

	$options[] = array( "name" => "Facebook",
						"desc" => "Enter your facebook page url.",
						"id" => "w2f_facebook",
						"std" => "",
						"type" => "text");							
							
	$options[] = array( "name" => "Google plus",
						"desc" => "Enter your Google plus profile link. Use http://gplus.to/",
						"id" => "w2f_google",
						"std" => "",
						"type" => "text");			
		
	$options[] = array( "name" => "Linkedin",
						"desc" => "Enter your Linkedin profile link.",
						"id" => "w2f_linkedin",
						"std" => "",
						"type" => "text");		

	$options[] = array( "name" => "Homepage",
						"type" => "heading");	
						
	$options[] = array(
					'name' => "Homepage content",
					'desc' => "Select the type of post to display on homepage",
					'id' => 'w2f_home',
					'std' => 'one',
					'type' => 'radio',
					'options' => $test_array);							

						
	$options[] = array( "name" => "Banner Settings",
						"type" => "heading");		
						

					
						
						
	$options[] = array( "name" => "Banner 1 Image",
						"desc" => "Enter your 125 x 125 banner image url here..",
						"id" => "w2f_banner1",
						"std" => "http://web2feel.com/images/webhostinghub.png",
						"type" => "text");		
						
	$options[] = array( "name" => "Banner 1 Image alt tag",
						"desc" => "Enter your banner alt tag.",
						"id" => "w2f_alt1",
						"std" => "Cheap reliable web hosting from WebHostingHub.com",
						"type" => "text");		
						
	$options[] = array( "name" => "Banner 1 Url",
						"desc" => "Enter your banner-1 url here.",
						"id" => "w2f_url1",
						"std" => "http://www.webhostinghub.com/",
						"type" => "text");						
						
	$options[] = array( "name" => "Banner 1 link title",
						"desc" => "Enter your banner-1 title here.",
						"id" => "w2f_lab1",
						"std" => "Web Hosting Hub - Cheap reliable web hosting.",
						"type" => "text");						
						


					$options[] = array( "name" => "Banner 2 Image",
										"desc" => "Enter your 125 x 125 banner image url here..",
										"id" => "w2f_banner2",
										"std" => "http://web2feel.com/images/pcnames.png",
										"type" => "text");		

					$options[] = array( "name" => "Banner 2 Image alt tag",
										"desc" => "Enter your banner alt tag.",
										"id" => "w2f_alt2",
										"std" => "Domain name search and availability check by PCNames.com",
										"type" => "text");		

					$options[] = array( "name" => "Banner 2 Url",
										"desc" => "Enter your banner-2 url here.",
										"id" => "w2f_url2",
										"std" => "http://www.pcnames.com/",
										"type" => "text");						

					$options[] = array( "name" => "Banner 2 link title",
										"desc" => "Enter your banner-2 title here.",
										"id" => "w2f_lab2",
										"std" => "PC Names - Domain name search and availability check.",
										"type" => "text");
										
										
																
									$options[] = array( "name" => "Banner 3 Image",
														"desc" => "Enter your 125 x 125 banner image url here..",
														"id" => "w2f_banner3",
														"std" => "http://web2feel.com/images/designcontest.png",
														"type" => "text");		

									$options[] = array( "name" => "Banner 3 Image alt tag",
														"desc" => "Enter your banner alt tag.",
														"id" => "w2f_alt3",
														"std" => "Website and logo design contests at DesignContest.com.",
														"type" => "text");		

									$options[] = array( "name" => "Banner 3 Url",
														"desc" => "Enter your banner-1 url here.",
														"id" => "w2f_url3",
														"std" => "http://www.designcontest.com/",
														"type" => "text");						

									$options[] = array( "name" => "Banner 3 link title",
														"desc" => "Enter your banner-3 title here.",
														"id" => "w2f_lab3",
														"std" => "Design Contest - Logo and website design contests.",
														"type" => "text");
														
														
														
																				
													$options[] = array( "name" => "Banner 4 Image",
																		"desc" => "Enter your 125 x 125 banner image url here..",
																		"id" => "w2f_banner4",
																		"std" => "http://web2feel.com/images/webhostingrating.png",
																		"type" => "text");		

													$options[] = array( "name" => "Banner 4 Image alt tag",
																		"desc" => "Enter your banner alt tag.",
																		"id" => "w2f_alt4",
																		"std" => "Reviews of the best cheap web hosting providers at WebHostingRating.com",
																		"type" => "text");		

													$options[] = array( "name" => "Banner 4 Url",
																		"desc" => "Enter your banner-4 url here.",
																		"id" => "w2f_url4",
																		"std" => "http://webhostingrating.com",
																		"type" => "text");						

													$options[] = array( "name" => "Banner 4 link title",
																		"desc" => "Enter your banner-4 title here.",
																		"id" => "w2f_lab4",
																		"std" => "Web Hosting Rating - Customer reviews of the best web hosts",
																		"type" => "text");						
						
						
						
						
								// 					
								// 					
								// 					
								// 					
								// 					
								// 	
								// $options[] = array( "name" => "Basic Settings",
								// 					"type" => "heading");
								// 						
								// $options[] = array( "name" => "Input Text Mini",
								// 					"desc" => "A mini text input field.",
								// 					"id" => "example_text_mini",
								// 					"std" => "Default",
								// 					"class" => "mini",
								// 					"type" => "text");
								// 							
								// $options[] = array( "name" => "Input Text",
								// 					"desc" => "A text input field.",
								// 					"id" => "example_text",
								// 					"std" => "Default Value",
								// 					"type" => "text");
								// 						
								// $options[] = array( "name" => "Textarea",
								// 					"desc" => "Textarea description.",
								// 					"id" => "example_textarea",
								// 					"std" => "Default Text",
								// 					"type" => "textarea"); 
								// 					
								// $options[] = array( "name" => "Input Select Small",
								// 					"desc" => "Small Select Box.",
								// 					"id" => "example_select",
								// 					"std" => "three",
								// 					"type" => "select",
								// 					"class" => "mini", //mini, tiny, small
								// 					"options" => $test_array);			 
								// 					
								// $options[] = array( "name" => "Input Select Wide",
								// 					"desc" => "A wider select box.",
								// 					"id" => "example_select_wide",
								// 					"std" => "two",
								// 					"type" => "select",
								// 					"options" => $test_array);
								// 					
								// $options[] = array( "name" => "Select a Category",
								// 					"desc" => "Passed an array of categories with cat_ID and cat_name",
								// 					"id" => "example_select_categories",
								// 					"type" => "select",
								// 					"options" => $options_categories);
								// 					
								// $options[] = array( "name" => "Select a Page",
								// 					"desc" => "Passed an pages with ID and post_title",
								// 					"id" => "example_select_pages",
								// 					"type" => "select",
								// 					"options" => $options_pages);
								// 					
								// $options[] = array( "name" => "Input Radio (one)",
								// 					"desc" => "Radio select with default options 'one'.",
								// 					"id" => "example_radio",
								// 					"std" => "one",
								// 					"type" => "radio",
								// 					"options" => $test_array);
								// 						
								// $options[] = array( "name" => "Example Info",
								// 					"desc" => "This is just some example information you can put in the panel.",
								// 					"type" => "info");
								// 										
								// $options[] = array( "name" => "Input Checkbox",
								// 					"desc" => "Example checkbox, defaults to true.",
								// 					"id" => "example_checkbox",
								// 					"std" => "1",
								// 					"type" => "checkbox");
								// 					
								// $options[] = array( "name" => "Advanced Settings",
								// 					"type" => "heading");
								// 					
								// $options[] = array( "name" => "Check to Show a Hidden Text Input",
								// 					"desc" => "Click here and see what happens.",
								// 					"id" => "example_showhidden",
								// 					"type" => "checkbox");
								// 
								// $options[] = array( "name" => "Hidden Text Input",
								// 					"desc" => "This option is hidden unless activated by a checkbox click.",
								// 					"id" => "example_text_hidden",
								// 					"std" => "Hello",
								// 					"class" => "hidden",
								// 					"type" => "text");
								// 					
								// $options[] = array( "name" => "Uploader Test",
								// 					"desc" => "This creates a full size uploader that previews the image.",
								// 					"id" => "example_uploader",
								// 					"type" => "upload");
								// 					
								// 
								// 					
								// $options[] = array( "name" =>  "Example Background",
								// 					"desc" => "Change the background CSS.",
								// 					"id" => "example_background",
								// 					"std" => $background_defaults, 
								// 					"type" => "background");
								// 							
								// $options[] = array( "name" => "Multicheck",
								// 					"desc" => "Multicheck description.",
								// 					"id" => "example_multicheck",
								// 					"std" => $multicheck_defaults, // These items get checked by default
								// 					"type" => "multicheck",
								// 					"options" => $multicheck_array);
								// 						
								// $options[] = array( "name" => "Colorpicker",
								// 					"desc" => "No color selected by default.",
								// 					"id" => "example_colorpicker",
								// 					"std" => "",
								// 					"type" => "color");
								// 					
								// $options[] = array( "name" => "Typography",
								// 					"desc" => "Example typography.",
								// 					"id" => "example_typography",
								// 					"std" => array('size' => '12px','face' => 'verdana','style' => 'bold italic','color' => '#123456'),
								// 					"type" => "typography");			
	return $options;
}