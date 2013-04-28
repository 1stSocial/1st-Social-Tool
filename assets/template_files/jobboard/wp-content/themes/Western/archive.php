<?php get_header(); ?>

<div id="left">

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
	
	<div class="post" id="post-<?php the_ID(); ?>">
		<div class="title">
			<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
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
				<?php the_post_thumbnail( 'tuts_index', array('class' => 'postimg') ); ?>
				<?php the_excerpt(); ?> 
				<a class="readmore" href="<?php the_permalink() ?>">Read More </a>
				<div class="clear"></div>
			
		</div>
	</div>

<?php endwhile; ?>

<?php getpagenavi(); ?>

<?php else : ?>

	<h1 class="title">Not Found</h1>
	<p>Sorry, but you are looking for something that isn't here.</p>

<?php endif; ?>

</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>