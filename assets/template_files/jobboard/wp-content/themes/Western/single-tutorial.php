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
					<span class="tags"><?php echo get_the_term_list( $post->ID, 'topic', '', ', ', '' ); ?> </span>
				</div>
			</div>
		
			<div class="entry">
				<div class="tutinfo clearfix">
					<ul class="tutmeta">
						<?php $infopro= get_post_meta( get_the_ID(), 'WTF_program', true ); ?>
						<?php if($infopro !== '') { ?>
						<li> <b>Program:</b> <?php echo $infopro; ?> </li>
						<?php } ?>
						<?php $infotime= get_post_meta( get_the_ID(), 'WTF_time', true ); ?>
						<?php if($infopro !== '') { ?>
						<li> <b> Estimated time:</b> <?php echo $infotime; ?>  </li>
						<?php } ?>
						<?php $infodiff= get_post_meta( get_the_ID(), 'WTF_difficulty', true ); ?>
						<?php if($infodiff !== '') { ?>
						<li> <b>Difficulty:</b> <?php echo  $infodiff; ?>  </li>
						<?php } ?>	
					</ul>
					
					<ul class="tutdata">
						<?php $infodemo= get_post_meta( get_the_ID(), 'WTF_demo', true ); ?>
						<?php if($infodemo !== '') { ?>
						<li> <a href="<?php echo $infodemo; ?>"> Demo</a></li>
						<?php } ?>	
						<?php $infosource= get_post_meta( get_the_ID(), 'WTF_source', true ); ?>
						<?php if($infosource !== '') { ?>
						<li><a href=" <?php echo $infosource; ?>"> Source files </a></li>
						<?php } ?>	
					</ul>
					
				</div>
					<?php the_content('Read the rest of this entry &raquo;'); ?>
					<div class="clear"></div>
					<?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
				
			
			</div>
		</div>
		
		<div id="authorarea" class="clearfix">
			
			<?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), '64' ); }?>
				<div class="authorinfo">
					<h3>About <?php the_author_posts_link(); ?></h3>
					<p><?php the_author_meta('description') ?></p>
				</div>
		</div>
		
	<?php comments_template(); ?>
	
	<?php endwhile; endif; ?>	
</div>


<?php get_sidebar(); ?>
<?php get_footer(); ?>