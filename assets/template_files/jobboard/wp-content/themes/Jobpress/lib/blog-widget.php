<?php
/**
 * Plugin Name: Blog Widget
 * Plugin URI: http://web2feel.com
 * Description: A widget that displays a mini blog section.
 * Version: 0.1
 * Author: Jinsona ( Widget framework courtesy - Justin Tadlock )
 * Author URI: http://web2feel.com , http://justintadlock.com
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 *
 * textdomain() used - web2feel
 *
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'w2f_blog_widgets' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function w2f_blog_widgets() {
	register_widget( 'W2F_Blog_Widget' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class W2F_Blog_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function W2F_Blog_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'w2f_blog_widget', 'description' => __('An widget to display a mini blog section.', 'web2feel') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'w2f_blog_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'w2f_blog_widget', __('W2F Blog Widget', 'web2feel'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$count = $instance['count'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;
?>


			<div class="blog-widget">
                            
                <ul>
                	<?php 
                    $query = new WP_Query();
                    $query->query('posts_per_page='.$count.'&caller_get_posts=1');
                    ?>
                    <?php if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                <li class="clearfix">
                        
                    <div class="post-thumb">
                       	<?php
							if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink() ?>"><img class="widthumb" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php get_image_url(); ?>&amp;h=60&amp;w=60&amp;zc=1" alt=""/></a>
						<?php } else { ?>
							<a href="<?php the_permalink() ?>"><img class="widthumb" src="<?php bloginfo('stylesheet_directory'); ?>/timthumb.php?src=<?php bloginfo('template_directory'); ?>/images/dummy.png &amp;h=60&amp;w=60&amp;zc=1" alt="" /></a>
						<?php } ?> <!-- Thumbnail -->
					</div>
                        
                    <div class="widget-post">
                        <h4 class="widtitle"><?php echo short_title('...', 4); ?></h4>
						<?php wpe_excerpt('wpe_excerptlength_widget', ''); ?>    
						<div class="clear"></div>
                    </div>
                    
                </li>
                    <?php endwhile; endif; ?>
                    
                    <?php wp_reset_query(); ?>

                </ul>
                
            </div><!--blog_widget-->
			
			
<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['count'] = strip_tags( $new_instance['count'] );

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('From the blog', 'web2feel'), 'count' => 3 );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'web2feel'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:95%;" />
		</p>

		<!-- Your Name: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'count' ); ?>"><?php _e('Number of posts:', 'web2feel'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" value="<?php echo $instance['count']; ?>" style="width:95%;" />
		</p>

	

	<?php
	}
}

?>