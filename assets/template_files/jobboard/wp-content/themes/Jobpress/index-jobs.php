<?php
/*
	Template Name: Jobs
*/
?>
<?php get_header(); ?>

<div id="content">
<div class="taxbar">
<?php 

$taxonomy     = 'job_type';
$orderby      = 'name'; 
$show_count   = 0;      // 1 for yes, 0 for no
$pad_counts   = 0;      // 1 for yes, 0 for no
$hierarchical = 1;      // 1 for yes, 0 for no
$title        = '';

$args = array(
  'taxonomy'     => $taxonomy,
  'orderby'      => $orderby,
  'show_count'   => $show_count,
  'pad_counts'   => $pad_counts,
  'hierarchical' => $hierarchical,
  'title_li'     => $title
);
?>

<ul>
<?php wp_list_categories( $args ); ?>
</ul>
</div>

<?php $count = 0; ?>
<?php
$temp = $wp_query;
$wp_query= null;
$wp_query = new WP_Query();
$wp_query->query('post_type=job'.'&paged='.$paged);
?>
<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>	

<div class="box clearfix <?php if (++$count % 2 == 0) { echo "altbox"; } ?>" id="post-<?php the_ID(); ?>">

<div class="btitle">
	<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php echo short_title('...', 7);  ?></a></h2>
	<p><?php $comdes=get_post_meta($post->ID, 'wtf_comdescript', true); echo $comdes; ?></p>
	
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
</div>
<div class="jlocation"> <?php $loc=get_post_meta($post->ID, 'wtf_comlocate', true); echo $loc; ?></div>
<div class="jpostime"><?php the_time('M  j'); ?></div>

</div>

<?php endwhile; ?>
<div class="clear"></div>
<?php getpagenavi(); ?>
<?php $wp_query = null; $wp_query = $temp;?>
</div>
<?php get_sidebar(); ?>

<?php get_footer(); ?>