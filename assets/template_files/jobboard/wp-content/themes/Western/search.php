<?php get_header(); ?>

<div id="left">
  
	<h2 class="pagetitle">Search for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e('&ldquo;'); echo $key; _e('&rdquo;'); _e(' returned '); echo $count . ' '; _e('results'); wp_reset_query(); ?></h2>

 	<?php if (have_posts()) : ?>

	<?php $query = query_posts("$query_string . '&posts_per_page=-1&post_type=tutorial'"); ?>
	
	<h3 class="subhead">Tutorials</h3>
	
		<?php if ( $query ) : ?>
		<?php while (have_posts()) : the_post(); ?>
			
		<div class="post">
		    <div class="title">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
			<div class="postmeta"> 	
				<span class="user">Posted by <?php the_author_posts_link(); ?></span>  
				<span class="clock"><?php the_time('l, n F Y'); ?></span>  
				<span class="tags"><?php echo get_the_term_list( $post->ID, 'topic', '', ', ', '' ); ?> </span>
			</div>
			</div>
			<div class="entry">
				<?php the_excerpt(); ?>
				<a class="readmore" href="<?php the_permalink() ?>">View tutorial </a>
				<div class="clear"></div>
			</div>
		</div>
		
		<?php endwhile; ?>
		<?php else : ?>
		<div class="title">
			<h2>No tutorials found.</h2>
		</div>
			
		<?php endif; ?>
<?php
//Reset Query
wp_reset_query();
?>

	<?php $query = query_posts("$query_string . '&posts_per_page=-1&post_type=post'"); ?>
	
	<h3 class="subhead">Articles</h3>
	
		<?php if ( $query ) : ?>
	
		 	<?php while (have_posts()) : the_post(); ?>
		
		 <div class="post">
		
		     <div class="title">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
		 	<div class="postmeta"> 	
				<span class="user">Posted by <?php the_author_posts_link(); ?></span>  
				<span class="clock"><?php the_time('l, n F Y'); ?></span>  
				<span class="tags"><?php the_category(', '); ?></span>
			</div>
			</div>
			<div class="entry">
				<?php the_excerpt(); ?>
				<a class="readmore" href="<?php the_permalink() ?>">Read More </a>
				<div class="clear"></div>
			</div><!-- !entry -->
			
		</div><!-- !post -->
		
		<?php endwhile; ?>
		
		<?php else : ?>
		
		<div class="title">
			<h2>No posts found.</h2>
		</div>
			
			
		<?php endif; ?>

	<?php else : ?>

		<p>Sorry, your search didn't return any results.</p>

	<?php endif; ?>

  </div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>