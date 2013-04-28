<?php 

/* Jobs post type*/

function post_type_jobs() {
register_post_type(
                    'job', 
                    array( 'public' => true,
					 		'publicly_queryable' => true,
							'has_archive' => true, 
							'hierarchical' => false,
							'menu_icon' => get_stylesheet_directory_uri() . '/images/job.png',
                    		'labels'=>array(
    									'name' => _x('Job', 'post type general name'),
    									'singular_name' => _x('Job', 'post type singular name'),
    									'add_new' => _x('Add New', 'Job'),
    									'add_new_item' => __('Add New Job'),
    									'edit_item' => __('Edit Job'),
    									'new_item' => __('New Job'),
    									'view_item' => __('View Jobs'),
    									'search_items' => __('Search Jobs'),
    									'not_found' =>  __('No Jobs found'),
    									'not_found_in_trash' => __('No Jobs found in Trash'), 
    									'parent_item_colon' => ''
  										),							 
                            'show_ui' => true,
							'menu_position'=>5,
							'query_var' => true,
							'rewrite' => true,
							'rewrite' => array( 'slug' => 'item', 'with_front' => FALSE,),
							'register_meta_box_cb' => 'mytheme_add_box',
							'supports' => array(
							 			'title',
										'thumbnail',
										'custom-fields',
										'comments',
										'editor'
										)
							) 
					);
				} 
add_action('init', 'post_type_jobs');

/* Movie genre taxonomy */

function create_job_type_taxonomy() 
{
$labels = array(
	  						  'name' => _x( 'Job types', 'taxonomy general name' ),
    						  'singular_name' => _x( 'Job type', 'taxonomy singular name' ),
    						  'search_items' =>  __( 'Search Job types' ),
   							  'all_items' => __( 'All Job types' ),
    						  'parent_item' => __( 'Parent Job type' ),
   					   		  'parent_item_colon' => __( 'Parent Job type:' ),
   							  'edit_item' => __( 'Edit Job type' ), 
  							  'update_item' => __( 'Update Job type' ),
  							  'add_new_item' => __( 'Add New Job type' ),
  							  'new_item_name' => __( 'New Job type Name' ),
); 	
register_taxonomy('job_type',array('job'), array(
    'hierarchical' => true,
    'labels' => $labels,
      'show_ui' => 'radio',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'job_type' ),
  ));
}

add_action( 'init', 'create_job_type_taxonomy', 0 );

/* ADD custom terms */

function add_job_term_fulltime() {
if(!is_term('Full-time', 'job_type')){
  wp_insert_term('Full-time', 'job_type');
}
}
add_action( 'init', 'add_job_term_fulltime' );

function add_job_term_parttime() {
if(!is_term('Part-time', 'job_type')){
  wp_insert_term('Part-time', 'job_type');
}
}
add_action( 'init', 'add_job_term_parttime' );

function add_job_term_contract() {
if(!is_term('Contract', 'job_type')){
  wp_insert_term('Contract', 'job_type');
}
}
add_action( 'init', 'add_job_term_contract' );


function add_job_term_freelance() {
if(!is_term('Freelance', 'job_type')){
  wp_insert_term('Freelance', 'job_type');
}
}
add_action( 'init', 'add_job_term_freelance' );

function add_job_term_internship() {
if(!is_term('Internship', 'job_type')){
  wp_insert_term('Internship', 'job_type');
}
}
add_action( 'init', 'add_job_term_internship' );

?>