<?php
add_action('init', 'tutorial_register');

function tutorial_register() {

	$labels = array(
		'name' => _x('Tutorial', 'post type general name'),
		'singular_name' => _x('Tutorial', 'post type singular name'),
		'add_new' => _x('Add New', 'tutorial'),
		'add_new_item' => __('Add New Tutorial'),
		'edit_item' => __('Edit Tutorial'),
		'new_item' => __('New Tutorial'),
		'view_item' => __('View Tutorial'),
		'search_items' => __('Search Tutorial'),
		'not_found' =>  __('Nothing found'),
		'not_found_in_trash' => __('Nothing found in Trash'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'menu_icon' => null,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title','editor','thumbnail','custom-fields')
	  ); 

	register_post_type( 'tutorial' , $args );
}



function add_topic_taxonomies() {

	register_taxonomy('topic', 'tutorial', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Topic', 'taxonomy general name' ),
			'singular_name' => _x( 'Topic', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Topics' ),
			'all_items' => __( 'All Topics' ),
			'parent_item' => __( 'Parent Topic' ),
			'parent_item_colon' => __( 'Parent Topic:' ),
			'edit_item' => __( 'Edit Topic' ),
			'update_item' => __( 'Update Topic' ),
			'add_new_item' => __( 'Add New Topic' ),
			'new_item_name' => __( 'New Topic Name' ),
			'menu_name' => __( 'Topics' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'topic', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'add_topic_taxonomies', 0 );

?>