<?php
/*
	Template Name: Blog
*/
?>
<?php get_header(); ?>
<div id="content">

<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('paged='.$paged);
?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>	
		
<div class="post" id="post-<?php the_ID(); ?>">
<div class="title">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
</div>
<div class="postmeta">
	<span class="author">Posted by <?php the_author(); ?> </span> <span class="date">  <?php the_time('M - j - Y'); ?></span> <span class="comm"><?php comments_popup_link('0 Comment', '1 Comment', '% Comments'); ?></span>
</div>
<div class="entry">

<?php if ( has_post_thumbnail() ) { ?>
	<img class="postimg" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=150&amp;w=200&amp;zc=1" alt="" />
<?php } else { ?>
	<img class="postimg" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php bloginfo('template_directory'); ?>/images/dummy.jpg&amp;h=150&amp;w=200&amp;zc=1" alt="" />
<?php } ?>

<?php wpe_excerpt('wpe_excerptlength_archive', ''); ?>

<div class="clear"></div>
</div>


<div class="singleinfo">
<span class="category">Categories: <?php the_category(', '); ?> </span>
</div>

</div>
<?php endwhile; ?>

<?php getpagenavi(); ?>

<?php $wp_query = null; $wp_query = $temp;?>

</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>