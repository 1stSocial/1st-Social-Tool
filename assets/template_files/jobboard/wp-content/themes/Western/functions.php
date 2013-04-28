<?php
require_once('class-tgm-plugin-activation.php');
include ( 'getplugins.php' );
include ( 'cpt.php' );
include ( 'guide.php' );
include ( 'metabox.php' );

/* SIDEBARS */
if ( function_exists('register_sidebar') )

	register_sidebar(array(
	'name' => 'Sidebar',
    'before_widget' => '<li class="sidebox %2$s">',
    'after_widget' => '</li>',
	'before_title' => '<h3 class="sidetitl">',
    'after_title' => '</h3>',
	
    ));

	register_sidebar(array(
	'name' => 'Footer',
	'before_widget' => '<li class="botwid %2$s">',
	'after_widget' => '</li>',
	'before_title' => '<h3 class="bothead">',
	'after_title' => '</h3>',
	));		

// Show posts of 'post', 'page' and 'movie' post types on home page
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

function add_my_post_types_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'page', 'movie' ) );
	return $query;
}

// Feed link

add_theme_support( 'automatic-feed-links' );

// Content Width

if ( ! isset( $content_width ) ) $content_width = 700;

/* CUSTOM MENUS */	

register_nav_menus( array(
		'primary' => __( 'Primary Navigation', '' ),
	) );

function fallbackmenu(){ ?>
			<div id="submenu">
				<ul><li> Go to Adminpanel > Appearance > Menus to create your menu. You should have WP 3.0+ version for custom menus to work.</li></ul>
			</div>
<?php }	


/* FEATURED THUMBNAILS */

if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'tuts_index', 250, 200, true );
	add_image_size( 'story_feature', 150, 100, true );
	add_image_size( 'video_feature', 150, 200, true );
	add_image_size( 'review_thumb', 120, 80, true );
	add_image_size( 'post_image', 660, 350, true );
}




/* PAGE NAVIGATION */

function getpagenavi(){
	?>
	<div id="navigation" class="clearfix">
	<?php if(function_exists('wp_pagenavi')) : ?>
	<?php wp_pagenavi() ?>
	<?php else : ?>
	        <div class="alignleft"><?php next_posts_link(__('&laquo; Older Entries','web2feeel')) ?></div>
	        <div class="alignright"><?php previous_posts_link(__('Newer Entries &raquo;','web2feel')) ?></div>
	        <div class="clear"></div>
	<?php endif; ?>

	</div>

	<?php
	}
	
	
	

// ADDS POST TYPES TO RSS FEED
function myfeed_request($qv) {
	if (isset($qv['feed']))
		$qv['post_type'] = get_post_types();
	return $qv;
}
add_filter('request', 'myfeed_request');


//FLUSH REWRITE RULES

	function custom_flush_rewrite_rules() {
		global $pagenow, $wp_rewrite;
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
			$wp_rewrite->flush_rules();
	}

	add_action( 'load-themes.php', 'custom_flush_rewrite_rules' );
	
	/* WP 3.4 custom query pagination fix */

function my_query_for_homepage( $query ) {
if( $query->is_main_query() && $query->is_home() ) {
$query->set( 'post_type', array( 'tutorial','post' ) );
}
}
add_action( 'pre_get_posts', 'my_query_for_homepage' ); 	
	
	

?>