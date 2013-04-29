<?php
/*
Plugin Name: Capability Manager Enhanced
Plugin URI: http://presspermit.com/capability-manager
Description: Manage WordPress role definitions. Organizes available capabilities by post type, status and source.
Version: 1.4.9
Author: Jordi Canals, Kevin Behrens
Author URI: http://agapetry.net
 */
 
/**
 * Capability Manager. Main Plugin File.
 * Plugin to create and manage Roles and Capabilities.
 *
 * @author		Jordi Canals, Kevin Behrens
 * @copyright   Copyright (C) 2009, 2010 Jordi Canals; modifications Copyright (C) 2012-2013 Kevin Behrens
 * @license		GNU General Public License version 3
 * @link		http://agapetry.net
 *

	Copyright 2009, 2010 Jordi Canals <devel@jcanals.cat>
	Modifications Copyright 2012-2013, Kevin Behrens <kevin@agapetry.net>
	
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	version 3 as published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details <http://www.gnu.org/licenses/>.
 */

if ( ! defined( 'CAPSMAN_VERSION' ) ) {
	define( 'CAPSMAN_VERSION', '1.4.9' );
	define( 'CAPSMAN_ENH_VERSION', '1.4.9' );
}

if ( cme_is_plugin_active( 'capsman.php' ) ) {
	$message = __( '<strong>Error:</strong> Capability Manager Extended cannot function because another copy of Capability Manager is active.', 'capsman' );
	add_action('admin_notices', create_function('', 'echo \'<div id="message" class="error fade" style="color: black">' . $message . '</div>\';'));
	return;
} else {
	define ( 'AK_CMAN_PATH', dirname(__FILE__) );
	define ( 'AK_CMAN_LIB', AK_CMAN_PATH . '/includes' );

	/**
	 * Sets an admin warning regarding required PHP version.
	 *
	 * @hook action 'admin_notices'
	 * @return void
	 */
	function _cman_php_warning() {
		$data = get_plugin_data(__FILE__);
		load_plugin_textdomain('capsman', false, basename(dirname(__FILE__)) .'/lang');

		echo '<div class="error"><p><strong>' . __('Warning:', 'capsman') . '</strong> '
			. sprintf(__('The active plugin %s is not compatible with your PHP version.', 'capsman') .'</p><p>',
				'&laquo;' . $data['Name'] . ' ' . $data['Version'] . '&raquo;')
			. sprintf(__('%s is required for this plugin.', 'capsman'), 'PHP-5 ')
			. '</p></div>';
	}

	// ============================================ START PROCEDURE ==========

	// Check required PHP version.
	if ( version_compare(PHP_VERSION, '5.0.0', '<') ) {
		// Send an armin warning
		add_action('admin_notices', '_cman_php_warning');
	} else {
		if ( is_admin() && ( isset($_REQUEST['page']) && in_array( $_REQUEST['page'], array( 'capsman', 'capsman-tool' ) ) || ( ! empty($_SERVER['SCRIPT_NAME']) && strpos( $_SERVER['SCRIPT_NAME'], 'p-admin/plugins.php' ) && ! empty($_REQUEST['action'] ) ) || ( isset($_GET['action']) && 'reset-defaults' == $_GET['action']) ) ) {
			// Run the plugin
			include_once ( AK_CMAN_PATH . '/framework/loader.php' );
			include ( AK_CMAN_LIB . '/manager.php' );
			ak_create_object('capsman', new CapabilityManager(__FILE__, 'capsman'));
		} else {
			load_plugin_textdomain('capsman', false, basename(dirname(__FILE__)) .'/lang');
			add_action( 'admin_menu', 'cme_submenus' );
		}
	}
}

add_action( 'plugins_loaded', '_cme_act_pp_active', 1 );

function _cme_act_pp_active() {
	if ( defined('PP_VERSION') || defined('PPC_VERSION') )
		define( 'PP_ACTIVE', true );
}

// perf enchancement: display submenu links without loading framework and plugin code
function cme_submenus() {
	if ( defined('PP_ACTIVE') ) {   // Press Permit integrates into Permissions menu
		add_action( 'pp_permissions_menu', '_cme_pp_menu' );
	} else {
		$menu_caption = ( defined('WPLANG') && WPLANG ) ? __('Capabilities', 'capsman') : __('Role Capabilities', 'capsman');
		add_users_page( __('Capability Manager', 'capsman'),  $menu_caption, 'manage_capabilities', 'capsman', 'cme_fakefunc');
	}
		
	add_management_page(__('Capability Manager', 'capsman'),  __('Capability Manager', 'capsman'), 'manage_capabilities', 'capsman' . '-tool', 'cme_fakefunc');
}

function _cme_pp_menu() {
	add_submenu_page( $GLOBALS['pp_admin']->get_menu('options'), __('Capability Manager', 'capsman'),  __('Role Capabilities', 'capsman'), 'manage_capabilities', 'capsman', 'cme_fakefunc' );
}

function cme_is_plugin_active($check_plugin_file) {
	if ( ! $check_plugin_file )
		return false;

	$plugins = get_option('active_plugins');

	foreach ( $plugins as $plugin_file ) {
		if ( false !== strpos($plugin_file, $check_plugin_file) )
			return $plugin_file;
	}
}