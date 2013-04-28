<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />


<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />


<?php 
 wp_enqueue_script('jquery');
 wp_enqueue_script('effects', get_stylesheet_directory_uri() .'/js/effects.js');
 wp_enqueue_script('superfish', get_stylesheet_directory_uri() .'/js/superfish.js');
?>

<?php wp_get_archives('type=monthly&format=link'); ?>
<?php //comments_popup_script(); // off by default ?>


<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); wp_head(); ?>

</head>
<body>


<div id="masthead"><!-- masthead begin -->
<div id="top"> 

<div id="blogname">	
		<?php $mylogo = get_option('job_logo'); ?>
		<h1 class="logo"><a href="<?php bloginfo('siteurl');?>/" title="<?php bloginfo('name');?>"><img src="<?php echo $mylogo ?>" alt="<?php bloginfo('name');?>"/></a></h1>
	<h2><?php bloginfo( 'description' ); ?></h2>
</div>
<div class="topad">
<?php $ad1 = get_option('job_topad'); echo stripslashes($ad1); ?>
</div>
</div>
	
<div id="botmenu">
	<?php wp_nav_menu( array( 'container_id' => 'submenu', 'theme_location' => 'primary','menu_class'=>'sfmenu','fallback_cb'=> 'fallbackmenu' ) ); ?>
</div>
</div><!--end masthead-->

<div id="wrapper">  <!-- wrapper begin -->
<div id="casing">