<?php get_header(); ?>

<div id="content" >

<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<div class="post" id="post-<?php the_ID(); ?>">
<div class="title">
<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
</div>
<div class="postmeta">
<?php  if( has_term( 'full-time', 'job_type', $post->ID ) ) { ?>
<span class="violspan typemet">Full time</span>
<?php } else if ( has_term( 'contract', 'job_type', $post->ID ) ){ ?>
<span class="greenspan typemet">Contract</span>
<?php } else if ( has_term( 'part-time', 'job_type', $post->ID ) ){ ?>
<span class="redspan typemet">Part time</span>
<?php } else if ( has_term( 'internship', 'job_type', $post->ID ) ){ ?>
<span class="orspan typemet">Internship</span>
<?php } else if ( has_term( 'freelance', 'job_type', $post->ID ) ){ ?>
<span class="bluspan typemet">Freelance</span>
<?php } ?>


<span class="location"><?php $loc=get_post_meta($post->ID, 'wtf_comlocate', true); echo $loc; ?> </span>
<span class="date"><?php the_time('M - j'); ?></span>
</div>

<div class="entry">
	<?php the_content('Read the rest of this entry &raquo;'); ?>
	<div class="clear"></div>
	<?php wp_link_pages(array('before' => '<p><strong>Pages: </strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

<div class="combox clearfix">
<?php if ( has_post_thumbnail() ) { ?>
	<a href="<?php the_permalink() ?>"><img class="boximg" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=60&amp;w=60&amp;zc=1" alt=""/></a>
<?php } else { ?>
	<a href="<?php the_permalink() ?>"><img class="boximg" src="<?php bloginfo('template_directory'); ?>/images/dummy.jpg" alt="" /></a>
<?php } ?>

<div class="combadge">
<h3><?php $comname=get_post_meta($post->ID, 'wtf_comname', true); echo $comname; ?></h3>
<span><?php $comdes=get_post_meta($post->ID, 'wtf_comdescript', true); echo $comdes; ?></span>
</div>
<a class="applyjob" href="mailto:<?php $comail=get_post_meta($post->ID, 'wtf_comail', true); echo $comail; ?>?Subject= Application for job listing - <?php the_title(); ?> "> Apply Now</a>
</div>

</div>

</div>
<?php endwhile; else: ?>
		<h1 class="title">Not Found</h1>
		<p>I'm Sorry,  you are looking for something that is not here. Try a different search.</p>
<?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>