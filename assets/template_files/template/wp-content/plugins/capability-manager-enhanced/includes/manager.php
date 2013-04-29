<?php
/**
 * Capability Manager.
 * Plugin to create and manage roles and capabilities.
 *
 * @version		$Rev: 199485 $
 * @author		Jordi Canals
 * @copyright   Copyright (C) 2009, 2010 Jordi Canals; Copyright (C) 2012-2013 Kevin Behrens
 * @license		GNU General Public License version 2
 * @link		http://agapetry.net
 *

	Copyright 2009, 2010 Jordi Canals <devel@jcanals.cat>
	Modifications Copyright 2012-2013 Kevin Behrens <kevin@agapetry.net>

	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	version 2 as published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

include_once ( AK_CLASSES . '/abstract/plugin.php' );

add_action( 'init', 'cme_update_pp_usage' );  // update early so resulting post type cap changes are applied for this request's UI construction

function cme_update_pp_usage() {
	if ( defined( 'PP_ACTIVE' ) && current_user_can( 'pp_manage_settings' ) ) {
		static $updated;
		if ( ! empty($updated) ) { return true; }
	
		if ( ! empty( $_REQUEST['update_filtered_types']) ) {
			// update Press Permit "Filtered Post Types".  This determines whether type-specific capability definitions are forced
			$options = array( 'enabled_post_types', 'enabled_taxonomies' );
			
			foreach( $options as $option_basename ) {
				if ( ! isset( $_POST["{$option_basename}-options"] ) )
					continue;
			
				$unselected = $value = array();
			
				foreach( $_POST["{$option_basename}-options"] as $key ) {
					if ( empty( $_POST["{$option_basename}-$key"] ) )
						$unselected[$key] = true;
					else
						$value[$key] = true;
				}

				if ( $current = pp_get_option( $option_basename ) ) {
					if ( $current = array_diff_key( $current, $unselected ) )
						$value = array_merge( $value, $current );	// retain setting for any types which were previously enabled for filtering but are currently not registered
				}

				$value = stripslashes_deep($value);
				pp_update_option( $option_basename, $value );
				
				$updated = true;
			}
			
			if ( pp_wp_ver( '3.5' ) ) {
				pp_update_option( 'define_create_posts_cap', $_REQUEST['pp_define_create_posts_cap'] );
			}
		}
		
		if ( ! empty( $_REQUEST['SaveRole']) ) {
			if ( ! empty( $_REQUEST['role'] ) ) {
				$pp_only = (array) pp_get_option( 'supplemental_role_defs' );
				
				if ( empty($_REQUEST['pp_only_role']) )
					$pp_only = array_diff( $pp_only, array($_REQUEST['role']) );
				else
					$pp_only[]= $_REQUEST['role'];

				pp_update_option( 'supplemental_role_defs', $pp_only );
			}
		}
		
		if ( $updated ) {
			pp_refresh_options();
		}
		
		return $updated;
	}
}


/**
 * Class cmanCapsManager.
 * Sets the main environment for all Capability Manager components.
 *
 * @author		Jordi Canals, Kevin Behrens
 * @link		http://agapetry.net
 */
class CapabilityManager extends akPluginAbstract
{
	/**
	 * Array with all capabilities to be managed. (Depends on user caps).
	 * The array keys are the capability, the value is its screen name.
	 * @var array
	 */
	private $capabilities = array();

	/**
	 * Array with roles that can be managed. (Depends on user roles).
	 * The array keys are the role name, the value is its translated name.
	 * @var array
	 */
	private $roles = array();

	/**
	 * Current role we are managing
	 * @var string
	 */
	private $current;

	/**
	 * Maximum level current manager can assign to a user.
	 * @var int
	 */
	private $max_level;

	private $log_db_role_objects = array();
	
	private $message;
	
	/**
	 * Creates some filters at module load time.
	 *
	 * @see akModuleAbstract#moduleLoad()
	 *
	 * @return void
	 */
    protected function moduleLoad ()
    {
        // Only roles that a user can administer can be assigned to others.
        add_filter('editable_roles', array($this, 'filterEditRoles'));

        // Users with roles that cannot be managed, are not allowed to be edited.
        add_filter('map_meta_cap', array(&$this, 'filterUserEdit'), 10, 4);
		
		// ensure storage, retrieval of db-stored customizations to bbPress dynamic roles
		global $wpdb;
		$role_key = $wpdb->prefix . 'user_roles';
		add_filter( 'option_' . $role_key, array( &$this, 'log_db_roles' ), 0 );
		add_filter( 'option_' . $role_key, array( &$this, 'reinstate_db_roles' ), 50 );
		
		add_filter( 'plugins_loaded', array( &$this, 'processRoleUpdate' ) );
    }
	
	function log_db_roles( $passthru_roles ) {
		global $wp_roles;

		$this->log_db_role_objects = $wp_roles->role_objects;

		return $passthru_roles;
	}
	
	// note: this is only applied when accessing the cme role edit form
	function reinstate_db_roles( $passthru_roles = array() ) {
		global $wp_roles;

		if ( $this->log_db_role_objects ) {
			$intersect = array_intersect_key( $wp_roles->role_objects, $this->log_db_role_objects );
			foreach( array_keys( $intersect ) as $key ) {
				if ( ! empty( $this->log_db_role_objects[$key]->capabilities ) )
					$wp_roles->role_objects[$key]->capabilities = $this->log_db_role_objects[$key]->capabilities;
			}
		}
		
		return $passthru_roles;
	}
	
	/**
	 * Sets default settings values.
	 *
	 * @return void
	 */
	protected function defaultOptions ()
	{
		$this->generateSysNames();

		return array(
			'form-rows' => 5,
			'syscaps'   => $this->capabilities
		);
	}

	/**
	 * Activates the plugin and sets the new capability 'Manage Capabilities'
	 *
	 * @return void
	 */
	protected function pluginActivate ()
	{
		$this->setAdminCapability();
	}

	/**
	 * Updates Capability Manager to a new version
	 *
	 * @return void
	 */
	protected function pluginUpdate ( $version )
	{
		$backup = get_option($this->ID . '_backup');
		if ( false === $backup ) {		// No previous backup found. Save it!
			global $wpdb;
			$roles = get_option($wpdb->prefix . 'user_roles');
			update_option($this->ID . '_backup', $roles);
		}
	}

	/**
	 * Adds admin panel menus. (At plugins loading time. This is before plugins_loaded).
	 * User needs to have 'manage_capabilities' to access this menus.
	 * This is set as an action in the parent class constructor.
	 *
	 * @hook action admin_menu
	 * @return void
	 */
	public function adminMenus ()
	{
		// First we check if user is administrator and can 'manage_capabilities'.
		if ( current_user_can('administrator') && ! current_user_can('manage_capabilities') ) {
			$this->setAdminCapability();
		}

		if ( defined( 'PP_ACTIVE' ) ) { // Press Permit integrates into Permissions menu
			add_action( 'pp_permissions_menu', array( &$this, 'pp_menu' ) );
		} else {
			add_users_page( __('Capability Manager', $this->ID),  __('Capabilities', $this->ID), 'manage_capabilities', $this->ID, array($this, 'generalManager'));
		}

		add_management_page(__('Capability Manager', $this->ID),  __('Capability Manager', $this->ID), 'manage_capabilities', $this->ID . '-tool', array($this, 'backupTool'));
	}

	public function pp_menu() {
		$menu_caption = ( defined('WPLANG') && WPLANG ) ? __('Capabilities', $this->ID) : __('Role Capabilities', $this->ID);
		add_submenu_page( $GLOBALS['pp_admin']->get_menu('options'), __('Capability Manager', $this->ID),  $menu_caption, 'manage_capabilities', $this->ID, array($this, 'generalManager') );
	}
	
	/**
	 * Sets the 'manage_capabilities' cap to the administrator role.
	 *
	 * @return void
	 */
	private function setAdminCapability ()
	{
		$admin = get_role('administrator');
		$admin->add_cap('manage_capabilities');
	}

	/**
	 * Filters roles that can be shown in roles list.
	 * This is mainly used to prevent an user admin to create other users with
	 * higher capabilities.
	 *
	 * @hook 'editable_roles' filter.
	 *
	 * @param $roles List of roles to check.
	 * @return array Restircted roles list
	 */
	function filterEditRoles ( $roles )
	{
	    $this->generateNames();
        $valid = array_keys($this->roles);

        foreach ( $roles as $role => $caps ) {
            if ( ! in_array($role, $valid) ) {
                unset($roles[$role]);
            }
        }

        return $roles;
	}

	/**
	 * Checks if a user can be edited or not by current administrator.
	 * Returns array('do_not_allow') if user cannot be edited.
	 *
	 * @hook 'map_meta_cap' filter
	 *
	 * @param array $caps Current user capabilities
	 * @param string $cap Capability to check
	 * @param int $user_id Current user ID
	 * @param array $args For our purpose, we receive edited user id at $args[0]
	 * @return array Allowed capabilities.
	 */
	function filterUserEdit ( $caps, $cap, $user_id, $args )
	{
	    if ( ( 'edit_user' != $cap ) || ( ! isset($args[0]) ) || $user_id == (int) $args[0] ) {
	        return $caps;
	    }

	    $this->generateNames();
	    $valid = array_keys($this->roles);

        $user = new WP_User( (int) $args[0] );
        foreach ( $user->roles as $role ) {
		    if ( ! in_array($role, $valid) ) {
		        $caps = array('do_not_allow');
		        break;
            }
		}

		return $caps;
	}

	function processRoleUpdate() {
		$this->current = get_option('default_role');	// By default we manage the default role.
		
		if ( 'POST' == $_SERVER['REQUEST_METHOD'] && ( ! empty($_REQUEST['SaveRole']) || ! empty($_REQUEST['AddCap']) ) ) {
			if ( ! current_user_can('manage_capabilities') && ! current_user_can('administrator') ) {
				// TODO: Implement exceptions.
				wp_die('<strong>' .__('What do you think you\'re doing?!?', $this->ID) . '</strong>');
			}

			//$this->current = get_option('default_role');	// By default we manage the default role.

			check_admin_referer('capsman-general-manager');
			$this->processAdminGeneral();
		}
	}
	
	/**
	 * Manages global settings admin.
	 *
	 * @hook add_submenu_page
	 * @return void
	 */
	function generalManager () {
		if ( ! current_user_can('manage_capabilities') && ! current_user_can('administrator') ) {
            // TODO: Implement exceptions.
		    wp_die('<strong>' .__('What do you think you\'re doing?!?', $this->ID) . '</strong>');
		}

		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
			if ( empty($_REQUEST['SaveRole']) && empty($_REQUEST['AddCap']) ) {
				check_admin_referer('capsman-general-manager');
				$this->processAdminGeneral();
			} elseif ( ! empty($_REQUEST['SaveRole']) ) {
				ak_admin_notify( $this->message, $this->ID );  // moved update operation to earlier action to avoid UI refresh issues.  But outputting notification there breaks styling.
			} elseif ( ! empty($_REQUEST['AddCap']) ) {
				ak_admin_notify( $this->message, $this->ID );
			}
		}

		$this->generateNames();
		$roles = array_keys($this->roles);

		if ( isset($_GET['action']) && 'delete' == $_GET['action']) {
			check_admin_referer('delete-role_' . $_GET['role']);
			$this->adminDeleteRole();
		}

		if ( ! in_array($this->current, $roles) ) {    // Current role has been deleted.
			$this->current = array_shift($roles);
		}

		include ( AK_CMAN_LIB . '/admin.php' );
	}

	/**
	 * Manages backup, restore and resset roles and capabilities
	 *
	 * @hook add_management_page
	 * @return void
	 */
	function backupTool ()
	{
		if ( ! current_user_can('manage_capabilities') && ! current_user_can('administrator') ) {
		    // TODO: Implement exceptions.
			wp_die('<strong>' .__('What do you think you\'re doing?!?', $this->ID) . '</strong>');
		}

		if ( 'POST' == $_SERVER['REQUEST_METHOD'] ) {
			check_admin_referer('capsman-backup-tool');
			$this->processBackupTool();
		}

		if ( isset($_GET['action']) && 'reset-defaults' == $_GET['action']) {
			check_admin_referer('capsman-reset-defaults');
			$this->backupToolReset();
		}

		include ( AK_CMAN_LIB . '/backup.php' );
	}

	/**
	 * Processes and saves the changes in the general capabilities form.
	 *
	 * @return void
	 */
	private function processAdminGeneral ()
	{
		global $wp_roles;

		if (! isset($_POST['action']) || 'update' != $_POST['action'] ) {
		    // TODO: Implement exceptions. This must be a fatal error.
			ak_admin_error(__('Bad form Received', $this->ID));
			return;
		}

		$post = stripslashes_deep($_POST);
		if ( empty ($post['caps']) ) {
		    $post['caps'] = array();
		}

		$this->current = $post['current'];
		
		// Select a new role.
		if ( ! empty($post['LoadRole']) ) {
			$this->current = $post['role'];

		// Create a new role.
		} elseif ( ! empty($post['CreateRole']) ) {
			if ( $newrole = $this->createRole($post['create-name']) ) {
				ak_admin_notify(__('New role created.', $this->ID));
				$this->current = $newrole;
			} else {
				if ( empty($post['create-name']) && ( ! defined('WPLANG') || ! WPLANG ) )
					ak_admin_error(__('Error: No role name specified.', $this->ID));
				else
					ak_admin_error(__('Error: Failed creating the new role.', $this->ID));
			}

		// Copy current role to a new one.
		} elseif ( ! empty($post['CopyRole']) ) {
			$current = get_role($post['current']);
			if ( $newrole = $this->createRole($post['copy-name'], $current->capabilities) ) {
				ak_admin_notify(__('New role created.', $this->ID));
				$this->current = $newrole;
			} else {
				if ( empty($post['copy-name']) && ( ! defined('WPLANG') || ! WPLANG ) )
					ak_admin_error(__('Error: No role name specified.', $this->ID));
				else
					ak_admin_error(__('Error: Failed creating the new role.', $this->ID));
			}

		// Save role changes. Already saved at start with self::saveRoleCapabilities().
		} elseif ( ! empty($post['SaveRole']) ) {
			if ( MULTISITE ) {
				global $wp_roles;
				if ( method_exists( $wp_roles, 'reinit' ) )
					$wp_roles->reinit();
			}
			
			$this->saveRoleCapabilities($post['current'], $post['caps'], $post['level']);
			
			if ( defined( 'PP_ACTIVE' ) ) {  // log customized role caps for subsequent restoration
				if ( function_exists( 'bbp_get_version' ) && version_compare( bbp_get_version(), '2.2', '<' ) ) {
					// for bbPress < 2.2, need to log customization of roles following bbPress activation
					$plugins = get_option('active_plugins');
					foreach( $plugins as $key => $plugin ) {
						if ( false === strpos($plugin, 'bbpress.php' ) )
							unset( $plugins[$key] );  // reduce storage size
					}
				} else {
					$plugins = array();	// back compat
				}
				
				if ( ! $customized_roles = get_option( 'pp_customized_roles' ) )
					$customized_roles = array();

				$customized_roles[$post['role']] = (object) array( 'caps' => $post['caps'], 'plugins' => $plugins );
				update_option( 'pp_customized_roles', $customized_roles );
				
				global $wpdb;
				$wpdb->query( "UPDATE $wpdb->options SET autoload = 'no' WHERE option_name = 'pp_customized_roles'" );
			}
		// Create New Capability and adds it to current role.
		} elseif ( ! empty($post['AddCap']) ) {
			if ( MULTISITE ) {
				global $wp_roles;
				if ( method_exists( $wp_roles, 'reinit' ) )
					$wp_roles->reinit();
			}
			
			$role = get_role($post['current']);
			$role->name = $post['current'];		// bbPress workaround

			if ( $newname = $this->createNewName($post['capability-name']) ) {
				$role->add_cap($newname['name']);
				$this->message = __('New capability added to role.');
				
				if ( ! $customized_roles = get_option( 'pp_customized_roles' ) )
					$customized_roles = array();

				$customized_roles[$post['role']] = (object) array( 'caps' => array_merge( $role->capabilities, array( $newname['name'] => 1 ) ), 'plugins' => $plugins );
				update_option( 'pp_customized_roles', $customized_roles );
				
				global $wpdb;
				$wpdb->query( "UPDATE $wpdb->options SET autoload = 'no' WHERE option_name = 'pp_customized_roles'" );
			} else {
				$this->message = __('Incorrect capability name.');
			}
			
		} elseif ( ! empty($post['update_filtered_types']) ) {
			if ( cme_update_pp_usage() ) {
				ak_admin_notify(__('Capability settings saved.', $this->ID));
			} else {
				ak_admin_error(__('Error saving capability settings.', $this->ID));
			}
		} else {
		    // TODO: Implement exceptions. This must be a fatal error.
		    ak_admin_error(__('Bad form received.', $this->ID));
		}

		if ( ! empty($newrole) && defined('PP_ACTIVE') ) {
			if ( ( ! empty($post['CreateRole']) && ! empty( $_REQUEST['new_role_pp_only'] ) ) || ( ! empty($post['CopyRole']) && ! empty( $_REQUEST['copy_role_pp_only'] ) ) ) {
				$pp_only = (array) pp_get_option( 'supplemental_role_defs' );
				$pp_only[]= $newrole;
				pp_update_option( 'supplemental_role_defs', $pp_only );
				pp_refresh_options();
			}
		}
	}

	/**
	 * Processes backups and restores.
	 *
	 * @return void
	 */
	private function processBackupTool ()
	{
		if ( isset($_POST['Perform']) ) {
			global $wpdb;
			$wp_roles = $wpdb->prefix . 'user_roles';
			$cm_roles = $this->ID . '_backup';

			switch ( $_POST['action'] ) {
				case 'backup':
					$roles = get_option($wp_roles);
					update_option($cm_roles, $roles);
					ak_admin_notify(__('New backup saved.', $this->ID));
					break;
				case 'restore':
					$roles = get_option($cm_roles);
					if ( $roles ) {
						update_option($wp_roles, $roles);
						ak_admin_notify(__('Roles and Capabilities restored from last backup.', $this->ID));
					} else {
						ak_admin_error(__('Restore failed. No backup found.', $this->ID));
					}
					break;
			}
		}
	}

	/**
	 * Deletes a role.
	 * The role comes from the $_GET['role'] var and the nonce has already been checked.
	 * Default WordPress role cannot be deleted and if trying to do it, throws an error.
	 * Users with the deleted role, are moved to the WordPress default role.
	 *
	 * @return void
	 */
	private function adminDeleteRole ()
	{
		global $wpdb;

		$this->current = $_GET['role'];
		$default = get_option('default_role');
		if (  $default == $this->current ) {
			ak_admin_error(sprintf(__('Cannot delete default role. You <a href="%s">have to change it first</a>.', $this->ID), 'options-general.php'));
			return;
		}

		$query = "SELECT ID FROM {$wpdb->usermeta} INNER JOIN {$wpdb->users} "
			. "ON {$wpdb->usermeta}.user_id = {$wpdb->users}.ID "
			. "WHERE meta_key='{$wpdb->prefix}capabilities' AND meta_value LIKE '%{$this->current}%';";

		$users = $wpdb->get_results($query);
		$count = count($users);

		foreach ( $users as $u ) {
			$user = new WP_User($u->ID);
			if ( $user->has_cap($this->current) ) {		// Check again the user has the deleting role
				$user->set_role($default);
			}
		}

		remove_role($this->current);
		unset($this->roles[$this->current]);

		if ( $customized_roles = get_option( 'pp_customized_roles' ) ) {
			if ( isset( $customized_roles[$this->current] ) ) {
				unset( $customized_roles[$this->current] );
				update_option( 'pp_customized_roles', $customized_roles );
			}
		}
		
		ak_admin_notify(sprintf(__('Role has been deleted. %1$d users moved to default role %2$s.', $this->ID), $count, $this->roles[$default]));
		$this->current = $default;
	}

	/**
	 * Resets roles to WordPress defaults.
	 *
	 * @return void
	 */
	private function backupToolReset ()
	{
		require_once(ABSPATH . 'wp-admin/includes/schema.php');

		if ( ! function_exists('populate_roles') ) {
			ak_admin_error(__('Needed function to create default roles not found!', $this->ID));
			return;
		}

		$roles = array_keys($this->roles);
		foreach ( $roles as $role) {
			remove_role($role);
		}

		populate_roles();
		$this->setAdminCapability();

		$msg = __('Roles and Capabilities reset to WordPress defaults', $this->ID);
		
		if ( function_exists( 'pp_populate_roles' ) ) {
			pp_populate_roles();
		} else {
			// force PP to repopulate roles
			if ( $pp_ver = get_option( 'pp_version', true ) ) {
				$pp_ver['version'] = ( preg_match( "/dev|alpha|beta|rc/i", $pp_ver['version'] ) ) ? '0.1-beta' : 0.1;
			} else {
				$pp_ver = array( 'version' => '0.1', 'db_version' => '1.0' );
			}

			update_option( 'pp_version', $pp_ver );
			delete_option( 'ppperm_added_role_caps_10beta' );
		}
		
		ak_admin_notify($msg);
	}

	/**
	 * Callback function to create names.
	 * Replaces underscores by spaces and uppercases the first letter.
	 *
	 * @access private
	 * @param string $cap Capability name.
	 * @return string	The generated name.
	 */
	function _capNamesCB ( $cap )
	{
		$cap = str_replace('_', ' ', $cap);
		//$cap = ucfirst($cap);

		return $cap;
	}

	/**
	 * Generates an array with the system capability names.
	 * The key is the capability and the value the created screen name.
	 *
	 * @uses self::_capNamesCB()
	 * @return void
	 */
	private function generateSysNames ()
	{
		$this->max_level = 10;
		$this->roles = ak_get_roles(true);
		$caps = array();

		foreach ( array_keys($this->roles) as $role ) {
			$role_caps = get_role($role);
			$caps = array_merge( $caps, $role_caps->capabilities );  // user reported PHP 5.3.3 error without array cast
		}

		$keys = array_keys($caps);
		$names = array_map(array($this, '_capNamesCB'), $keys);
		$this->capabilities = array_combine($keys, $names);

		$sys_caps = $this->getOption('syscaps');
		if ( is_array($sys_caps) ) {
			$this->capabilities = array_merge($sys_caps, $this->capabilities);
		}

		asort($this->capabilities);
	}

	/**
	 * Generates an array with the user capability names.
	 * If user has 'administrator' role, system roles are generated.
	 * The key is the capability and the value the created screen name.
	 * A user cannot manage more capabilities that has himself (Except for administrators).
	 *
	 * @uses self::_capNamesCB()
	 * @return void
	 */
	private function generateNames ()
	{
		if ( current_user_can('administrator') ) {
			$this->generateSysNames();
		} else {
		    global $user_ID;
		    $user = new WP_User($user_ID);
		    $this->max_level = ak_caps2level($user->allcaps);

		    $keys = array_keys($user->allcaps);
    		$names = array_map(array($this, '_capNamesCB'), $keys);
	    	$this->capabilities = array_combine($keys, $names);

		    $roles = ak_get_roles(true);
    		unset($roles['administrator']);

	    	foreach ( $user->roles as $role ) {			// Unset the roles from capability list.
		    	unset ( $this->capabilities[$role] );
			    unset ( $roles[$role]);					// User cannot manage his roles.
    		}
	    	asort($this->capabilities);

		    foreach ( array_keys($roles) as $role ) {
			    $r = get_role($role);
    			$level = ak_caps2level($r->capabilities);

	    		if ( $level > $this->max_level ) {
		    		unset($roles[$role]);
			    }
    		}

	    	$this->roles = $roles;
		}
	}

	/**
	 * Creates a new role/capability name from user input name.
	 * Name rules are:
	 * 		- 2-40 charachers lenght.
	 * 		- Only letters, digits, spaces and underscores.
	 * 		- Must to start with a letter.
	 *
	 * @param string $name	Name from user input.
	 * @return array|false An array with the name and display_name, or false if not valid $name.
	 */
	private function createNewName( $name ) {
		// Allow max 40 characters, letters, digits and spaces
		$name = trim(substr($name, 0, 40));
		$pattern = '/^[a-zA-Z][a-zA-Z0-9 _]+$/';

		if ( preg_match($pattern, $name) ) {
			$roles = ak_get_roles();

			$name = strtolower($name);
			$name = str_replace(' ', '_', $name);
			if ( in_array($name, $roles) || array_key_exists($name, $this->capabilities) ) {
				return false;	// Already a role or capability with this name.
			}

			$display = explode('_', $name);
			$display = array_map('ucfirst', $display);
			$display = implode(' ', $display);

			return compact('name', 'display');
		} else {
			return false;
		}
	}

	/**
	 * Creates a new role.
	 *
	 * @param string $name	Role name to create.
	 * @param array $caps	Role capabilities.
	 * @return string|false	Returns the name of the new role created or false if failed.
	 */
	private function createRole( $name, $caps = array() ) {
		if ( ! is_array($caps) )
			$caps = array();

		$role = $this->createNewName($name);
		if ( ! is_array($role) ) {
			return false;
		}

		$new_role = add_role($role['name'], $role['display'], $caps);
		if ( is_object($new_role) ) {
			return $role['name'];
		} else {
			return false;
		}
	}

	 /**
	  * Saves capability changes to roles.
	  *
	  * @param string $role_name Role name to change its capabilities
	  * @param array $caps New capabilities for the role.
	  * @return void
	  */
	private function saveRoleCapabilities( $role_name, $caps, $level ) {
		$this->generateNames();
		$role = get_role($role_name);
		
		// workaround to ensure db storage of customizations to bbp dynamic roles
		$role->name = $role_name;
		
		$stored_role_caps = ( ! empty($role->capabilities) && is_array($role->capabilities) ) ? array_intersect( $role->capabilities, array(true, 1) ) : array();
		
		$old_caps = array_intersect_key( $stored_role_caps, $this->capabilities);
		$new_caps = ( is_array($caps) ) ? array_map('intval', $caps) : array();
		$new_caps = array_merge($new_caps, ak_level2caps($level));

		// Find caps to add and remove
		$add_caps = array_diff_key($new_caps, $old_caps);
		$del_caps = array_diff_key($old_caps, $new_caps);

		if ( ! $is_administrator = current_user_can('administrator') ) {
			unset($add_caps['manage_capabilities']);
			unset($del_caps['manage_capabilities']);
		}

		if ( 'administrator' == $role_name && isset($del_caps['manage_capabilities']) ) {
			unset($del_caps['manage_capabilities']);
			ak_admin_error(__('You cannot remove Manage Capabilities from Administrators', $this->ID));
		}
		// Add new capabilities to role
		foreach ( $add_caps as $cap => $grant ) {
			if ( $is_administrator || current_user_can($cap) )
				$role->add_cap($cap);
		}

		// Remove capabilities from role
		foreach ( $del_caps as $cap => $grant) {
			if ( $is_administrator || current_user_can($cap) )
				$role->remove_cap($cap);
		}
	}

	protected function pluginDeactivate() {}
    protected function pluginsLoaded() {}
    protected function registerWidgets() {}
    public function wpInit() {}
}
