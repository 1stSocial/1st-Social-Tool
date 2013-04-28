<?php get_header(); ?>

<div id="content" >
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
		
<div class="post" id="post-<?php the_ID(); ?>">
	<div class="title">
		<h2>Success!</h2>
	</div>
	
	<div class="entry">
	<p>Thank you. Your listing is posted for review. It will appear on the Job board as soon as it is approved by the reviewer.  </p>
	<div class="clear"></div>
	</div>
</div>

<?php endwhile; endif; ?>
</div>		

<?php get_sidebar(); ?>
<?php get_footer(); ?>