<?php get_header(); ?>

<div id="left">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		
		<div class="post" id="post-<?php the_ID(); ?>">
			<div class="title">
				<h1><?php the_title(); ?></h1>
				<div class="postmeta"> 	
					<span class="user">Posted by <?php the_author_posts_link(); ?></span>  
					<span class="clock"><?php the_time('l, n F Y'); ?></span>  

<span class="tags">

 <?php echo get_the_term_list( $post->ID, 'industries', '', ', ', '' ); ?> 

</span>


<span class="tags">

 <?php echo get_the_term_list( $post->ID, 'locations', '', ', ', '' ); ?> 

</span>


<span class="tags">

 <?php echo get_the_term_list( $post->ID, 'work-types', '', ', ', '' ); ?> 

</span>

				</div>
			</div>
		
			<div class="entry">
					<?php the_post_thumbnail( 'post_image', array('class' => 'postim') ); ?>
					<?php the_content('Read the rest of this entry &raquo;'); ?>


<?php
  $custom_fields = get_post_custom($post_id);//Current post id
  $my_custom_field = $custom_fields['wpcf-appurl'];//key name
  foreach ( $my_custom_field as $key => $value )
  echo "<a class='readmore' target='_blank' href='" . $value . "'>Apply Now</a>";
?>



					<div class="clear"></div>
					<?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			</div>
		</div>
		
	<?php comments_template(); ?>
	<?php endwhile; endif; ?>	
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>