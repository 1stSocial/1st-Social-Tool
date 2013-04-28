<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'WTF_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box
	'id' => 'tutorial_info',

	// Meta box title - Will appear at the drag and drop handle bar
	'title' => 'Tutorial info',

	// Post types, accept custom post types as well - DEFAULT is array('post'); (optional)
	'pages' => array( 'tutorial' ),

	// Where the meta box appear: normal (default), advanced, side; optional
	'context' => 'normal',

	// Order of meta box: high (default), low; optional
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		
		// TEXT
		array(
			// Field name - Will be used as label
			'name'		=> 'Program',
			'id'		=> $prefix . 'program',
			'desc'		=> 'Name of the program about which the tutorial is',
			'clone'		=> false,
			'type'		=> 'text',
		),
		
		array(
			// Field name - Will be used as label
			'name'		=> 'Difficulty',
			'id'		=> $prefix . 'difficulty',
			'desc'		=> 'Level of difficulty',
			'clone'		=> false,
			'type'		=> 'text',
		),
		
		array(
			// Field name - Will be used as label
			'name'		=> 'Estimated time ',
			'id'		=> $prefix . 'time',
			'desc'		=> 'Estimated time of completion',
			'clone'		=> false,
			'type'		=> 'text',
		),
				
		array(
			// Field name - Will be used as label
			'name'		=> 'Demo',
			'id'		=> $prefix . 'demo',
			'desc'		=> 'Demo of the tutorial',
			'clone'		=> false,
			'type'		=> 'text',
		),
		
		array(
			'name'	=> 'Source file',
			'desc'	=> 'Enter the source file url for the tutorial',
			'id'	=> $prefix . 'source',
			'clone'	=> false,
			'type'	=> 'text',
		)
						
	)
);


/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );