<?php
/**
 * General Admin for Capability Manager.
 * Provides admin pages to create and manage roles and capabilities.
 *
 * @version		$Rev: 198515 $
 * @author		Jordi Canals, Kevin Behrens
 * @copyright   Copyright (C) 2009, 2010 Jordi Canals, (C) 2012-2013 Kevin Behrens
 * @license		GNU General Public License version 2
 * @link		http://agapetry.net
 *

	Copyright 2009, 2010 Jordi Canals <devel@jcanals.cat>
	Modifications Copyright 2012-2013, Kevin Behrens <kevin@agapetry.net>
	
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

$roles = $this->roles;
$default = $this->current;

if( defined('PP_ACTIVE') ) {
	global $wpdb;

	if ( defined( 'PPC_VERSION' ) )
		$pp_supplemental_roles = $wpdb->get_col( "SELECT role_name FROM $wpdb->ppc_roles AS r INNER JOIN $wpdb->pp_groups AS g ON g.ID = r.agent_id AND r.agent_type = 'pp_group' WHERE g.metagroup_type = 'wp_role' AND g.metagroup_id = '$default'" );
	else
		$pp_supplemental_roles = $wpdb->get_col( "SELECT role_name FROM $wpdb->pp_roles AS r INNER JOIN $wpdb->pp_groups AS g ON g.ID = r.group_id AND r.group_type = 'pp_group' AND r.scope = 'site' WHERE g.metagroup_type = 'wp_role' AND g.metagroup_id = '$default'" );
	
	$pp_filtered_types = pp_get_enabled_types('post');
	$pp_metagroup_caps = array();
	$pp_cap_caster = pp_init_cap_caster();

	foreach( $pp_supplemental_roles as $_role_name ) {
		$role_specs = explode( ':', $_role_name );
		if ( empty($role_specs[2]) || ! in_array( $role_specs[2], $pp_filtered_types ) )
			continue;

		// add all type-specific caps whose base property cap is included in this pattern role
		// i.e. If 'edit_posts' is in the pattern role, grant $type_obj->cap->edit_posts
		$pp_metagroup_caps = array_merge( $pp_metagroup_caps, array_fill_keys( $pp_cap_caster->get_typecast_caps( $_role_name, 'site' ), true ) );
	}
} else {
	$pp_metagroup_caps = array();
}

?>
<div class="wrap">
	<?php if( defined('PP_ACTIVE') ) :
		pp_icon();
		$style = 'style="height:60px;"';
	?>
	<?php else:
		$style = '';
	?>
	<div id="icon-capsman-admin" class="icon32"></div>
	<?php endif; ?>
	
	<h2 <?php echo $style;?>><?php _e('Roles and Capabilities', $this->ID) ?></h2>
	
	<form method="post" action="admin.php?page=<?php echo $this->ID ?>">
	<?php wp_nonce_field('capsman-general-manager'); ?>
	<fieldset>
	<table id="akmin">
	<tr>
		<td class="content">
		<dl>
			<dt><?php printf(__('Capabilities for %s', $this->ID), $roles[$default]); ?></dt>
			<dd>
				<?php
				if ( defined( 'PP_ACTIVE' ) ) {
					if ( pp_get_option('display_hints') ) {
						echo '<div>';
						_e( 'Use this form to view and modify the capabilities WordPress natively associates with each role.  Note:', $this->ID );
						echo '</div><br />';
						echo '<ul class="ul-disc"><li>';
						
						if ( pp_get_option( 'advanced_options' ) )
							$parenthetical = sprintf( __( 'see %1$sRole Usage%2$s: "Pattern Roles"', 'pp' ), "<a href='" . admin_url('admin.php?page=pp-role-usage') . "'>", '</a>' );
						else
							$parenthetical = sprintf( __( 'activate %1$sAdvanced settings%2$s, see Role Usage', 'pp' ), "<a href='" . admin_url('admin.php?page=pp-settings&pp_tab=advanced') . "'>", '</a>' );

						printf( __( '"Posts" capabilities selected here also define type-specific role assignment for Permit Groups (%s).', $this->ID ), $parenthetical ) ;
						echo '</li><li>';
						printf( __( 'Capabilities for custom statuses can be manually added to a role here (see Conditions > Capability Mapping for applicable names). However, it is usually more convenient to use Permit Groups to assign a supplemental status-specific role.', $this->ID ), "<a href='" . admin_url('?page=pp-role-usage') . "'>", '</a>' ) ;
						echo '</li></ul>';
					}
				} else {
					echo '<div>';
					_e( "Interested in further customizing editing or viewing access? Consider stepping up to <a href='#pp-more'>Press Permit</a>.", $this->ID );
					echo '</div>';
					?>
					<script type="text/javascript">
					/* <![CDATA[ */
					jQuery(document).ready( function($) {
						$('a[href=#pp-more]').click( function() {
							$('#pp_features').show();
							return false;
						});
						$('a[href=#pp-hide]').click( function() {
							$('#pp_features').hide();
							return false;
						});
					});
					/* ]]> */
					</script>
					<?php
					echo '<br /><div style="display:none" id="pp_features"><ul class="ul-disc">';
					echo '<li>';
					_e( "Automatically define type-specific capabilities for your custom post types and taxonomies", $this->ID );
					echo '</li>';
					echo '<li>';
					_e( "Supplemental per-type, per-category or per-page role assignments", $this->ID );
					echo '</li>';
					echo '<li>';
					_e( "Custom Visibility statuses (require read_member_posts, read_premium_posts, etc.)", $this->ID );
					echo '</li>';
					echo '<li>';
					_e( 'Custom Editability "statuses" - set alongside Visibility in Post and Category edit forms', $this->ID );
					echo '</li>';
					echo '<li>';
					_e( "Custom Moderation statuses, enabling access-limited three tier moderation (Pending / Approved / Published)", $this->ID );
					echo '</li>';
					echo '<li>';
					_e( "Grant Participant or Moderator access to specific bbPress forums or topics", $this->ID );
					echo '</li>';
					echo '<li>';
					_e( "Grant supplemental page or category access to all members of a BuddyPress group", $this->ID );
					echo '</li>';
					echo '<li>';
					_e( "WPML integration to mirror permissions to translations", $this->ID );
					echo '</li>';
					echo '<li>';
					_e( "Professional support available", $this->ID );
					echo '</li>';
					echo '</ul><div>';
					echo '<a href="http://presspermit.com">http://presspermit.com</a> &bull; <a href="#pp-hide">hide</a>';
					echo '</div></div>';
				}
				
				if ( MULTISITE ) {
					global $wp_roles;
					if ( method_exists( $wp_roles, 'reinit' ) )
						$wp_roles->reinit();
				}
				
				$capsman = ak_get_object('capsman');
				$capsman->reinstate_db_roles();
				
				$current = get_role($default);
				$rcaps = $current->capabilities;

				// ========= Begin Kevin B mod ===========
				$is_administrator = current_user_can( 'administrator' );
				
				$custom_types = get_post_types( array( '_builtin' => false ), 'names' );
				$custom_tax = get_taxonomies( array( '_builtin' => false ), 'names' );
				
				$defined = array();
				$defined['type'] = get_post_types( array( 'public' => true ), 'object' );
				$defined['taxonomy'] = get_taxonomies( array( 'public' => true ), 'object' );
				
				/*
				if ( ( count($custom_types) || count($custom_tax) ) && ( $is_administrator || current_user_can( 'manage_pp_settings' ) ) ) {
					$cap_properties[''] = array();
					$force_distinct_ui = true;
				}
				*/
				
				$cap_properties['edit']['type'] = array( 'edit_posts' );
				
				foreach( $defined['type'] as $type_obj ) {
					if ( 'attachment' != $type_obj->name ) {
						if ( isset( $type_obj->cap->create_posts ) && ( $type_obj->cap->create_posts != $type_obj->cap->edit_posts ) ) {
							$cap_properties['edit']['type'][]= 'create_posts';
							break;
						}
					}
				}
				
				$cap_properties['edit']['type'][]= 'edit_others_posts';
				$cap_properties['edit']['type'] = array_merge( $cap_properties['edit']['type'], array( 'publish_posts', 'edit_published_posts', 'edit_private_posts' ) );
				
				$cap_properties['edit']['taxonomy'] = array( 'manage_terms' );
				
				if ( ! defined( 'PP_ACTIVE' ) )
					$cap_properties['edit']['taxonomy'] = array_merge( $cap_properties['edit']['taxonomy'], array( 'edit_terms', 'assign_terms' ) );
	
				$cap_properties['delete']['type'] = array( 'delete_posts', 'delete_others_posts' );
				$cap_properties['delete']['type'] = array_merge( $cap_properties['delete']['type'], array( 'delete_published_posts', 'delete_private_posts' ) );
				
				if ( ! defined( 'PP_ACTIVE' ) )
					$cap_properties['delete']['taxonomy'] = array( 'delete_terms' );
				else
					$cap_properties['delete']['taxonomy'] = array();
	
				$cap_properties['read']['type'] = array( 'read_private_posts' );
				$cap_properties['read']['taxonomy'] = array();
	
				$stati = get_post_stati( array( 'internal' => false ) );
	
				//if ( count($stati) > 5 ) {
					$cap_type_names = array(
						'' => __( '&nbsp;', $this->ID ),
						'read' => __( 'Reading', $this->ID ),
						'edit' => __( 'Editing Capabilities', $this->ID ),
						'delete' => __( 'Deletion Capabilities', $this->ID )
					);
	
				//} else {
					
				//}
	
				$cap_tips = array( 
					'read_private' => __( 'can read posts which are currently published with private visibility', $this->ID ),
					'edit' => __( 'has basic editing capability (but may need other capabilities based on post status and ownership)', $this->ID ),
					'edit_others' => __( 'can edit posts which were created by other users', $this->ID ),
					'edit_published' => __( 'can edit posts which are currently published', $this->ID ),
					'edit_private' => __( 'can edit posts which are currently published with private visibility', $this->ID ),
					'publish' => __( 'can make a post publicly visible', $this->ID ),
					'delete' => __( 'has basic deletion capability (but may need other capabilities based on post status and ownership)', $this->ID ),
					'delete_others' => __( 'can delete posts which were created by other users', $this->ID ),
					'delete_published' => __( 'can delete posts which are currently published', $this->ID ),
					'delete_private' => __( 'can delete posts which are currently published with private visibility', $this->ID ),
				);
	
				$default_caps = array( 'read_private_posts', 'edit_posts', 'edit_others_posts', 'edit_published_posts', 'edit_private_posts', 'publish_posts', 'delete_posts', 'delete_others_posts', 'delete_published_posts', 'delete_private_posts',
									   'read_private_pages', 'edit_pages', 'edit_others_pages', 'edit_published_pages', 'edit_private_pages', 'publish_pages', 'delete_pages', 'delete_others_pages', 'delete_published_pages', 'delete_private_pages',
									   'manage_categories'
									   );
				$type_caps = array();
				
				// Press Permit grants attachment capabilities based on user's capabilities for the parent post
				if ( defined( 'PP_ACTIVE' ) || defined('SCOPER_VERSION') )
					unset( $defined['type']['attachment'] );

				echo '<ul class="cme-listhoriz">';
				
				// cap_types: read, edit, deletion
				foreach( array_keys($cap_properties) as $cap_type ) {
					echo '<li>';
					echo '<h3>' . $cap_type_names[$cap_type] . '</h3>';
					echo '<table class="cme-typecaps">';
					
					foreach( array_keys($defined) as $item_type ) {
						if ( ( 'delete' == $cap_type ) && ( 'taxonomy' == $item_type ) )
							continue;
						
						//if ( ! $cap_type ) {

						//} else {
							echo '<th></th>';
						
							if ( ! count( $cap_properties[$cap_type][$item_type] ) )
								continue;
						
							// label cap properties
							foreach( $cap_properties[$cap_type][$item_type] as $prop ) {
								$prop = str_replace( '_posts', '', $prop );
								$prop = str_replace( '_pages', '', $prop );
								$prop = str_replace( '_terms', '', $prop );
								$tip = ( isset( $cap_tips[$prop] ) ) ? "title='{$cap_tips[$prop]}'" : '';
								$prop = str_replace( '_', '<br />', $prop );
								echo "<th $tip>";
								echo ucwords($prop);
								echo '</th>';
							}

							foreach( $defined[$item_type] as $key => $type_obj ) {
								$row = '<tr>';
								
								if ( $cap_type ) {
									if ( empty($force_distinct_ui) && empty( $cap_properties[$cap_type][$item_type] ) )
										continue;
								
									$row .= "<td><a class='cap_type' href='#toggle_type_caps'>" . $type_obj->labels->name . '</a></td>';
								
									$display_row = ! empty($force_distinct_ui);
								
									foreach( $cap_properties[$cap_type][$item_type] as $prop ) {
										$row .= '<td>';
										if ( ! empty($type_obj->cap->$prop) && ( in_array( $type_obj->name, array( 'post', 'page' ) ) 
										|| ! in_array( $type_obj->cap->$prop, $default_caps ) 
										|| ( ( 'manage_categories' == $type_obj->cap->$prop ) && ( 'manage_terms' == $prop ) && ( 'category' == $type_obj->name ) ) ) ) {
											
											// if edit_published or edit_private cap is same as edit_posts cap, don't display a checkbox for it
											if ( ( ! in_array( $prop, array( 'edit_published_posts', 'edit_private_posts', 'create_posts' ) ) || ( $type_obj->cap->$prop != $type_obj->cap->edit_posts ) ) 
											&& ( ! in_array( $prop, array( 'delete_published_posts', 'delete_private_posts' ) ) || ( $type_obj->cap->$prop != $type_obj->cap->delete_posts ) )
											) {
												$cap_name = $type_obj->cap->$prop;
												
												if ( $is_administrator || current_user_can($cap_name) ) {
													if ( ! empty($pp_metagroup_caps[$cap_name]) ) {
														$title_text = sprintf( __( '%s: assigned by Permit Group', 'pp' ), $cap_name );
													} else {
														$title_text = $cap_name;
													}
													
													$disabled = '';
													$checked = checked(1, ! empty($rcaps[$cap_name]), false );
													
													$row .= '<input id=caps[' . $cap_name . '] type="checkbox" title="' . $title_text . '" name="caps[' . $cap_name . ']" value="1" ' . $checked . $disabled . ' />';
													$type_caps [$cap_name] = true;
													$display_row = true;
												}
											}
										}
										$row .= '</td>';
									}
								}
								
								if ( $display_row ) {
									$row .= '</tr>';
									echo $row;
								}
							}
						//} // endif this iteration is for type caps checkbox display
					
					} // end foreach item type
					
					echo '</table>';
					
					echo '</li>';
				}

				echo '</ul>';
				
				// clicking on post type name toggles corresponding checkbox selections
				?>
				<script type="text/javascript">
				/* <![CDATA[ */
				jQuery(document).ready( function($) {
					$('a[href="#toggle_type_caps"]').click( function() {
						var chks = $(this).closest('tr').find('input');
						$(chks).attr( 'checked', ! $(chks).first().attr('checked') );
						return false;
					});
				});
				/* ]]> */
				</script>
				<?php

				$core_caps = array_fill_keys( array( 'switch_themes', 'edit_themes', 'activate_plugins', 'edit_plugins', 'edit_users', 'edit_files', 'manage_options', 'moderate_comments', 
					'manage_links', 'upload_files', 'import', 'unfiltered_html', 'read', 'delete_users', 'create_users', 'unfiltered_upload', 'edit_dashboard',
					'update_plugins', 'delete_plugins', 'install_plugins', 'update_themes', 'install_themes', 
					'update_core', 'list_users', 'remove_users', 'add_users', 'promote_users', 'edit_theme_options', 'delete_themes', 'export' ), true );
					
				ksort( $core_caps );
				
				echo '<p>&nbsp;</p><h3>' . __( 'Other WordPress Core Capabilities', $this->ID ) . '</h3>';
				echo '<table width="100%" class="form-table"><tr>';
				
				
				$checks_per_row = $this->getOption( 'form-rows' );
				$i = 0;

				foreach( array_keys($core_caps) as $cap_name ) {
					if ( ! $is_administrator && ! current_user_can($cap_name) )
						continue;
				
					if ( $i == $checks_per_row ) {
						echo '</tr><tr>';
						$i = 0;
					}

					if ( ! empty($pp_metagroup_caps[$cap_name]) ) {
						$title_text = sprintf( __( '%s: assigned by Permit Group', 'pp' ), $cap_name );
					} else {
						$title_text = $cap_name;
					}
					
					$disabled = '';
					$checked = checked(1, ! empty($rcaps[$cap_name]), false );
					
					$class = ( ! empty($rcaps[$cap_name]) || ! empty($pp_metagroup_caps[$cap_name]) ) ? 'cap_yes' : 'cap_no';
					
					?>
					<td class="<?php echo $class; ?>"><label for="caps[<?php echo $cap_name; ?>]" title="<?php echo $title_text;?>"><input id=caps[<?php echo $cap_name; ?>] type="checkbox" name="caps[<?php echo $cap_name; ?>]" value="1" <?php echo $checked . $disabled;?> />
					<?php
					echo str_replace( '_', ' ', $cap_name );
					echo '</td>';
					$i++;
				}
				
				echo '</table>';
				
				echo '<p>&nbsp;</p><h3>' . __( 'Additional Capabilities', $this->ID ) . '</h3>';
	
				?>
				<table width='100%' class="form-table">
				<tr>
				<?php
				$i = 0; $first_row = true;
				
				foreach ( $this->capabilities as $cap_name => $cap ) :
					if ( isset( $type_caps[$cap_name] ) || isset($core_caps[$cap_name]) )
						continue;
				
					if ( ! $is_administrator && ! current_user_can($cap_name) )
						continue;
				
					// ============ End Kevin B mod ===============
				
					// Levels are not shown.
					if ( preg_match( '/^level_(10|[0-9])$/i', $cap_name ) ) {
						continue;
					}

					if ( $i == $checks_per_row ) {
						echo '</tr><tr>';
						$i = 0; $first_row = false;
					}
					$class = ( ! empty($rcaps[$cap_name]) || ! empty($pp_metagroup_caps[$cap_name]) ) ? 'cap_yes' : 'cap_no';
					
					if ( ! empty($pp_metagroup_caps[$cap_name]) ) {
						$title_text = sprintf( __( '%s: assigned by Permit Group', 'pp' ), $cap_name );
					} else {
						$title_text = $cap_name;
					}
					
					$disabled = '';
					$checked = checked(1, ! empty($rcaps[$cap_name]), false );
					
					if ( 'manage_capabilities' == $cap_name ) {
						if ( ! current_user_can('administrator') ) {
							continue;
						} elseif ( 'administrator' == $default ) {
							$lock_manage_caps_capability = true;
							$disabled = 'disabled="disabled"';
						}
					}
				?>
					<td class="<?php echo $class; ?>"><label for="caps[<?php echo $cap_name; ?>]" title="<?php echo $title_text;?>"><input id=caps[<?php echo $cap_name; ?>] type="checkbox" name="caps[<?php echo $cap_name; ?>]" value="1" <?php echo $checked . $disabled;?> />
					<?php 
					echo $cap;
					?></label></td>
				<?php
					$i++;
				endforeach;

				if ( ! empty($lock_manage_caps_capability) ) {
					echo '<input type="hidden" name="caps[manage_capabilities]" value="1" />';
				}
				
				if ( $i == $checks_per_row ) {
					echo '</tr><tr>';
					$i = 0;
				}

				$level = ak_caps2level($rcaps);
				?>
				<td><?php _e('Level:', $this->ID) ;?><select name="level">
				<?php for ( $l = $this->max_level; $l >= 0; $l-- ) {?>
						<option value="<?php echo $l; ?>" style="text-align:right;"<?php selected($level, $l); ?>>&nbsp;<?php echo $l; ?>&nbsp;</option>
					<?php }
					++$i;

					if ( ! $first_row ) {
						// Now close a wellformed table
						for ( $i; $i < $checks_per_row; $i++ ){
							echo '<td>&nbsp;</td>';
						}
					}
					?>
				</select>

				</tr>
				</table>
				
				<br />
				<?php if ( ! defined('PP_ACTIVE') || pp_get_option('display_hints') ) :?>
				<div class="cme-subtext">
					<?php _e( 'Note: Underscores replace spaces in stored capability name ("edit users" => "edit_users").', 'pp' ); ?>
				</div>
				<?php endif;?>
				</span>
				
			</dd>
		</dl>

		<?php 
		$support_pp_only_roles = defined('PP_ACTIVE') && ( defined('PPC_VERSION') || version_compare( PP_VERSION, '1.0-beta1.4', '>=') );
		?>
		
		<?php if ( $support_pp_only_roles && ! in_array( $default, array( 'subscriber', 'contributor', 'author', 'editor', 'administrator' ) ) ) : ?>
		<div style="float:right">
			<?php
			pp_refresh_options();
			$pp_only = (array) pp_get_option( 'supplemental_role_defs' );
			$checked = ( in_array( $default, $pp_only ) ) ? 'checked="checked"': '';
			?>
			<label for="pp_only_role" title="<?php _e('Make role available for supplemental assignment to Permit Groups only', 'pp');?>"><input type="checkbox" name="pp_only_role" id="pp_only_role" value="1" <?php echo $checked;?>> <?php _e('supplemental assignment only', 'pp'); ?> </label>
		</div>
		<?php endif; ?>
		
		<p class="submit">
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="current" value="<?php echo $default; ?>" />
			<input type="submit" name="SaveRole" value="<?php _e('Save Changes', $this->ID) ?>" class="button-primary" /> &nbsp;
			
			<?php if ( current_user_can('administrator') && 'administrator' != $default ) : ?>
				<a class="ak-delete" title="<?php echo esc_attr(__('Delete this role', $this->ID)) ?>" href="<?php echo wp_nonce_url("admin.php?page={$this->ID}&amp;action=delete&amp;role={$default}", 'delete-role_' . $default); ?>" onclick="if ( confirm('<?php echo esc_js(sprintf(__("You are about to delete the %s role.\n 'Cancel' to stop, 'OK' to delete.", $this->ID), $roles[$default])); ?>') ) { return true;}return false;"><?php _e('Delete Role', $this->ID)?></a>
			<?php endif; ?>
		</p>
		
		<br />
		<?php ak_admin_footer($this->ID, 2009); ?>
		
		</td>
		<td class="sidebar">
			<?php ak_admin_authoring($this->ID); ?>

			<dl>
				<dt><?php defined('WPLANG') && WPLANG ? _e('Select New Role', $this->ID) : _e('Select Role to View / Edit', $this->ID); ?></dt>
				<dd style="text-align:center;">
					<p><select name="role">
					<?php
					foreach ( $roles as $role => $name ) {
						echo '<option value="' . $role .'"'; selected($default, $role); echo '> ' . $name . ' &nbsp;</option>';
					}
					?>
					</select><span style="margin-left:20px"><input type="submit" name="LoadRole" value="<?php defined('WPLANG') && WPLANG ? _e('Change', $this->ID) : _e('Load', $this->ID) ?>" class="button" /></span></p>
				</dd>
			</dl>
			
			<dl>
				<dt><?php _e('Create New Role', $this->ID); ?></dt>
				<dd style="text-align:center;">
					<?php $class = ( $support_pp_only_roles ) ? 'tight-text' : 'regular-text'; ?>
					<p><input type="text" name="create-name"" class="<?php echo $class;?>" placeholder="<?php _e('Name of new role', $this->ID) ?>" />
					
					<?php if( $support_pp_only_roles ) : ?>
					<label for="new_role_pp_only" title="<?php _e('Make role available for supplemental assignment to Permit Groups only', 'pp');?>"> <input type="checkbox" name="new_role_pp_only" id="new_role_pp_only" value="1" checked="checked"> <?php _e('supplemental', 'pp'); ?> </label>
					<?php endif; ?>
					
					<br />
					<input type="submit" name="CreateRole" value="<?php _e('Create', $this->ID) ?>" class="button" />
					</p>
				</dd>
			</dl>

			<dl>
				<dt><?php defined('WPLANG') && WPLANG ? _e('Copy this role to', $this->ID) : printf( __('Copy %s Role', $this->ID), $roles[$default]); ?></dt>
				<dd style="text-align:center;">
					<?php $class = ( $support_pp_only_roles ) ? 'tight-text' : 'regular-text'; ?>
					<p><input type="text" name="copy-name"  class="<?php echo $class;?>" placeholder="<?php _e('Name of copied role', $this->ID) ?>" />
					
					<?php if( $support_pp_only_roles ) : ?>
					<label for="copy_role_pp_only" title="<?php _e('Make role available for supplemental assignment to Permit Groups only', 'pp');?>"> <input type="checkbox" name="copy_role_pp_only" id="copy_role_pp_only" value="1" checked="checked"> <?php _e('supplemental', 'pp'); ?> </label>
					<?php endif; ?>
					
					<br />
					<input type="submit" name="CopyRole" value="<?php _e('Copy', $this->ID) ?>" class="button" />
					</p>
				</dd>
			</dl>

			<dl>
				<dt><?php _e('Add Capability', $this->ID); ?></dt>
				<dd style="text-align:center;">
					<p><input type="text" name="capability-name" class="regular-text" placeholder="<?php _e('capability name', $this->ID) ?>" /><br />
					<input type="submit" name="AddCap" value="<?php _e('Add to role', $this->ID) ?>" class="button" /></p>
				</dd>
			</dl>
			
			<?php if ( defined('PP_ACTIVE') && current_user_can( 'pp_manage_settings' ) ) :?>
			<dl>
				<dt><?php _e('Force Type-Specific Capabilities', $this->ID); ?></dt>
				<dd style="text-align:center;">
					<?php
					$caption = __( 'Force unique capability names for:', 'pp' );
					echo "<p>$caption</p><table style='width:100%'><tr>";
					
					foreach( array_keys($defined) as $item_type ) {	
						echo '<td style="width:50%">';
						$option_name = ( 'taxonomy' == $item_type ) ? 'enabled_taxonomies' : 'enabled_post_types';

						$enabled = pp_get_option( $option_name );

						foreach( $defined[$item_type] as $key => $type_obj ) {
							if ( ! $key )
								continue;

							$id = "$option_name-" . $key;
							?>
							<div style="text-align:left">
							<?php if ( 'nav_menu' == $key ) :?>
								<input name="<?php echo($id);?>" type="hidden" id="<?php echo($id);?>" value="1" />
								<input name="<?php echo("{$option_name}-options[]");?>" type="hidden" value="<?php echo($key)?>" />
							
							<?php else: ?>
								<div class="agp-vspaced_input">
								<label for="<?php echo($id);?>" title="<?php echo($key);?>">
								<input name="<?php echo("{$option_name}-options[]");?>" type="hidden" value="<?php echo($key)?>" />
								<input name="<?php echo($id);?>" type="checkbox" id="<?php echo($id);?>" value="1" <?php checked('1', isset($enabled[$key]) );?> /> <?php echo($type_obj->label);?>
								
								<?php 
								echo ('</label></div>');

							endif;  // displaying checkbox UI
							
							echo '</div>';
						}
						echo '</td>';
					}
					?>
					</tr></table>
					
					<?php if( pp_wp_ver( '3.5' ) ) :
						$define_create_posts_cap = pp_get_option( 'define_create_posts_cap' );
					?>
						<div>
						<label for="pp_define_create_posts_cap">
						<input name="pp_define_create_posts_cap" type="checkbox" id="pp_define_create_posts_cap" value="1" <?php checked('1', $define_create_posts_cap );?> /> <?php _e('Use create_posts capability');?>
						</label>
						</div>
					<?php endif; ?>
					
					<div class="cme-subtext">
					<?php
					if ( pp_get_option( 'display_hints' ) ) {
						_e( '(PP Filtered Post Types, Taxonomies)', 'pp' );
					}
					?>
					</div>
					
					<input type="submit" name="update_filtered_types" value="<?php _e('Update', $this->ID) ?>" class="button" />
				</dd>
			</dl>
			<?php endif;?>
		</td>
	</tr>
	</table>
	</fieldset>
	</form>
</div>
