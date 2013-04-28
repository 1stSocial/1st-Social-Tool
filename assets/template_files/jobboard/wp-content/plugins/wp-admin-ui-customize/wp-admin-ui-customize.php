<?php
/*
Plugin Name: WP Admin UI Customize
Description: It is an excellent plugin to customize the management screen.
Plugin URI: http://wordpress.org/extend/plugins/wp-admin-ui-customize/
Version: 1.2.2.2
Author: gqevu6bsiz
Author URI: http://gqevu6bsiz.chicappa.jp/?utm_source=use_plugin&utm_medium=list&utm_content=wauc&utm_campaign=1_2_2_2
Text Domain: wauc
Domain Path: /languages
*/

/*  Copyright 2012 gqevu6bsiz (email : gqevu6bsiz@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/



class WP_Admin_UI_Customize
{

	var $Ver,
		$Name,
		$Dir,
		$ltd,
		$Record,
		$PageSlug,
		$UPFN,
		$DonateKey,
		$Menu,
		$SubMenu,
		$Admin_bar,
		$Msg;


	function __construct() {
		$this->Ver = '1.2.2.2';
		$this->Name = 'WP Admin UI Customize';
		$this->Dir = WP_PLUGIN_URL . '/' . dirname( plugin_basename( __FILE__ ) ) . '/';
		$this->ltd = 'wauc';
		$this->ltd_p = $this->ltd . '_plugin';
		$this->Record = array(
			"user_role" => $this->ltd . '_user_role_setting',
			"site" => $this->ltd . '_site_setting',
			"admin_general" => $this->ltd . '_admin_general_setting',
			"dashboard" => $this->ltd . '_dashboard_setting',
			"admin_bar_menu" => $this->ltd . '_admin_bar_menu_setting',
			"sidemenu" => $this->ltd . '_sidemenu_setting',
			"removemetabox" => $this->ltd . '_removemetabox_setting',
			"post_add_edit" => $this->ltd . '_post_add_edit_setting',
			"appearance_menus" => $this->ltd . '_appearance_menus_setting',
			"loginscreen" => $this->ltd . '_loginscreen_setting',
			"donate" => $this->ltd . '_donated',
		);
		$this->PageSlug = 'wp_admin_ui_customize';
		$this->UPFN = 'Y';
		$this->DonateKey = 'd77aec9bc89d445fd54b4c988d090f03';
		
		$this->PluginSetup();
		$this->FilterStart();
	}





	// PluginSetup
	function PluginSetup() {
		// load text domain
		load_plugin_textdomain( $this->ltd , false , basename( dirname( __FILE__ ) ) . '/languages' );
		load_plugin_textdomain( $this->ltd_p , false , basename( dirname( __FILE__ ) ) . '/languages' );

		// plugin links
		add_filter( 'plugin_action_links' , array( $this , 'plugin_action_links' ) , 10 , 2 );

		// add menu
		add_action( 'admin_menu' , array( $this , 'admin_menu' ) , 2 );
	}

	// PluginSetup
	function plugin_action_links( $links , $file ) {
		if( plugin_basename(__FILE__) == $file ) {
			$link = '<a href="' . 'admin.php?page=' . $this->PageSlug . '">' . __('Settings') . '</a>';
			$support_link = '<a href="http://wordpress.org/support/plugin/wp-admin-ui-customize" target="_blank">' . __( 'Support Forums' ) . '</a>';
			array_unshift( $links, $link , $support_link );
		}
		return $links;
	}

	// PluginSetup
	function admin_menu() {
		add_menu_page( $this->Name , $this->Name , 'administrator', $this->PageSlug , array( $this , 'setting_default') );
		add_submenu_page( $this->PageSlug , __( 'Site Settings' , $this->ltd ) , __( 'Site Settings' , $this->ltd ) , 'administrator' , $this->PageSlug . '_setting_site' , array( $this , 'setting_site' ) );
		add_submenu_page( $this->PageSlug , __( 'General screen setting' , $this->ltd ) , __( 'General screen setting' , $this->ltd ) , 'administrator' , $this->PageSlug . '_admin_general_setting' , array( $this , 'setting_admin_general' ) );
		add_submenu_page( $this->PageSlug , __( 'Dashboard' ) , __( 'Dashboard' ) , 'administrator' , $this->PageSlug . '_dashboard' , array( $this , 'setting_dashboard' ) );
		add_submenu_page( $this->PageSlug , __( 'Admin bar Menu' , $this->ltd ) , __( 'Admin bar Menu' , $this->ltd ) , 'administrator' , $this->PageSlug . '_admin_bar' , array( $this , 'setting_admin_bar_menu' ) );
		add_submenu_page( $this->PageSlug , __( 'Side Menu' , $this->ltd ) , __( 'Side Menu' , $this->ltd ) , 'administrator' , $this->PageSlug . '_sidemenu' , array( $this , 'setting_sidemenu' ) );
		add_submenu_page( $this->PageSlug , __( 'Remove meta box' , $this->ltd ) , __( 'Remove meta box' , $this->ltd ) , 'administrator' , $this->PageSlug . '_removemtabox' , array( $this , 'setting_removemtabox' ) );
		add_submenu_page( $this->PageSlug , __( 'Add New Post and Edit Post screen setting' , $this->ltd ) , __( 'Add New Post and Edit Post screen setting' , $this->ltd ) , 'administrator' , $this->PageSlug . '_post_add_edit_screen' , array( $this , 'setting_post_add_edit' ) );
		add_submenu_page( $this->PageSlug , __( 'Appearance\'s Menus screen setting' , $this->ltd ) , __( 'Appearance\'s Menus screen setting' , $this->ltd ) , 'administrator' , $this->PageSlug . '_appearance_menus' , array( $this , 'setting_appearance_menus' ) );
		add_submenu_page( $this->PageSlug , __( 'Login Screen' , $this->ltd ) , __( 'Login Screen' , $this->ltd ) , 'administrator' , $this->PageSlug . '_loginscreen' , array( $this , 'setting_loginscreen' ) );
	}





	// SettingPage
	function setting_default() {
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		include_once 'inc/setting_default.php';
	}

	// SettingPage
	function setting_site() {
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->DisplayDonation();
		include_once 'inc/setting_site.php';
	}

	// SettingPage
	function setting_admin_general() {
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->settingCheck();
		$this->DisplayDonation();
		include_once 'inc/setting_admin_general.php';
	}

	// SettingPage
	function setting_dashboard() {
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->settingCheck();
		$this->DisplayDonation();
		include_once 'inc/setting_dashboard.php';
	}

	// SettingPage
	function setting_admin_bar_menu() {
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->settingCheck();
		$this->DisplayDonation();
		include_once 'inc/setting_admin_bar_menu.php';
	}

	// SettingPage
	function setting_sidemenu() {
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->settingCheck();
		$this->DisplayDonation();
		include_once 'inc/setting_sidemenu.php';
	}

	// SettingPage
	function setting_removemtabox() {
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->settingCheck();
		$this->DisplayDonation();
		include_once 'inc/setting_removemtabox.php';
	}

	// SettingPage
	function setting_post_add_edit() {
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->settingCheck();
		$this->DisplayDonation();
		include_once 'inc/setting_post_add_edit.php';
	}

	// SettingPage
	function setting_appearance_menus() {
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->settingCheck();
		$this->DisplayDonation();
		include_once 'inc/setting_appearance_menus.php';
	}

	// SettingPage
	function setting_loginscreen() {
		add_filter( 'admin_footer_text' , array( $this , 'layout_footer' ) );
		$this->settingCheck();
		$this->DisplayDonation();
		include_once 'inc/setting_loginscreen.php';
	}





	// GetData
	function get_data( $record ) {
		$GetData = get_option( $this->Record[$record] );

		$Data = array();
		if( !empty( $GetData ) && !empty( $GetData["UPFN"] ) && $GetData["UPFN"] == $this->UPFN ) {
			$Data = $GetData;
		}

		return $Data;
	}



	// Settingcheck
	function settingCheck() {
		$Data = $this->get_data( 'user_role' );
		if( !empty( $Data["UPFN"] ) ) {
			unset( $Data["UPFN"] );
		}
		if( empty( $Data ) ) {
			$this->Msg .= '<div class="error"><p><strong>' . sprintf( __( 'Authority to apply the setting is not selected. <a href="%s">From here</a>, please select the permissions you want to set.' , $this->ltd ) , self_admin_url( 'admin.php?page=' . $this->PageSlug ) ) . '</strong></p></div>';
		}
	}





	// SetList
	function get_user_role() {
		$editable_roles = get_editable_roles();
		foreach ( $editable_roles as $role => $details ) {
			$UserRole[$role] = translate_user_role( $details['name'] );
		}

		return $UserRole;
	}

	// SetList
	function sidemenu_default_load() {
		global $menu , $submenu;

		$this->Menu = $menu;
		$this->SubMenu = $submenu;
	}

	// SetList
	function admin_bar_default_load( $wp_admin_bar ) {
		global $wp_admin_bar;

		$this->Admin_bar = $wp_admin_bar->get_nodes();

	}

	// SetList
	function menu_widget( $menu_widget ) {
		 $new_widget = '';
		 if( !empty( $menu_widget["new"] ) ) {
			  $new_widget = 'new';
		 }
?>
		<div class="widget <?php echo $menu_widget["slug"]; ?> <?php echo $new_widget; ?>">

			<div class="widget-top">
				<div class="widget-title-action">
					<a class="widget-action" href="#available"></a>
				</div>
				<div class="widget-title">
					<h4>
						<?php echo $menu_widget["title"]; ?>
						: <span class="in-widget-title"><?php echo $menu_widget["slug"]; ?></span>
					</h4>
				</div>
			</div>

			<div class="widget-inside">
				<div class="settings">
					<p class="description">
						<?php if( $menu_widget["slug"] == 'custom_menu' ) : ?>
							<?php _e( 'Url' ); ?>:
							<input type="text" class="slugtext" value="" name="data[][slug]">
						<?php else : ?>
							<?php _e( 'Slug' ); ?>: <?php echo $menu_widget["slug"]; ?>
							<input type="hidden" class="slugtext" value="<?php echo $menu_widget["slug"]; ?>" name="data[][slug]">
						<?php endif; ?>
					</p>
					<label>
						<?php _e( 'Title' ); ?> : <input type="text" class="regular-text titletext" value="<?php echo esc_attr( $menu_widget["title"] ); ?>" name="data[][title]">
					</label>
					<input type="hidden" class="parent_slugtext" value="<?php echo $menu_widget["parent_slug"]; ?>" name="data[][parent_slug]">
				</div>

				<?php if( $menu_widget["slug"] != 'separator' ) : ?>
					<div class="submenu">
						<p class="description"><?php _e( 'Sub Menus' , $this->ltd ); ?></p>
						<?php if( empty( $menu_widget["new"] ) && !empty( $menu_widget["submenu"] ) ) : ?>
							<?php foreach($menu_widget["submenu"] as $sm) : ?>
								<?php $sepalator_widget = ''; ?>
								<?php if( $sm["slug"] == 'separator' ) : $sepalator_widget = $sm["slug"]; endif; ?>

								<div class="widget <?php echo $sepalator_widget; ?>">

									<div class="widget-top">
										<div class="widget-title-action">
											<a class="widget-action" href="#available"></a>
										</div>
										<div class="widget-title">
											<h4>
												<?php echo $sm["title"]; ?>
												: <span class="in-widget-title"><?php echo $sm["slug"]; ?></span>
											</h4>
										</div>
									</div>

									<div class="widget-inside">
										<div class="settings">
											<p class="description">
												<?php _e( 'Slug' ); ?>: <?php echo $sm["slug"]; ?>
												<input type="hidden" class="slugtext" value="<?php echo $sm["slug"]; ?>" name="data[][slug]">
											</p>
											<label>
												<?php _e( 'Title' ); ?> : <input type="text" class="regular-text titletext" value="<?php echo esc_attr( $sm["title"] ); ?>" name="data[][title]">
											</label>
											<input type="hidden" class="parent_slugtext" value="<?php echo $sm["parent_slug"]; ?>" name="data[][parent_slug]">
										</div>
										<div class="widget-control-actions">
											<div class="alignleft">
												<a href="#remove"><?php _e( 'Remove' ); ?></a>
											</div>
											<div class="clear"></div>
										</div>
									</div>
								</div>

							<?php endforeach; ?>
						<?php endif; ?>
					</div>
					<div class="widget-control-actions">
						<div class="alignleft">
							<a href="#remove"><?php _e( 'Remove' ); ?></a>
						</div>
						<div class="clear"></div>
					</div>

				<?php endif; ?>
			</div>

		</div>
<?php
	}

	// SetList
	function admin_bar_menu_widget( $menu_widget ) {
		 $new_widget = '';
		 if( !empty( $menu_widget["new"] ) ) {
			  $new_widget = 'new';
		 }
?>
		<div class="widget <?php echo $new_widget; ?> <?php echo $menu_widget["id"]; ?>">

			<div class="widget-top">
				<div class="widget-title-action">
					<a class="widget-action" href="#available"></a>
				</div>
				<div class="widget-title">
					<h4>
						<?php echo $menu_widget["title"]; ?>
						: <span class="in-widget-title"><?php echo $menu_widget["id"]; ?></span>
					</h4>
				</div>
			</div>

			<div class="widget-inside">
				<div class="settings">
					<p class="description">
						ID: <?php echo $menu_widget["id"]; ?>
						<input type="hidden" class="idtext" value="<?php echo $menu_widget["id"]; ?>" name="data[][id]"><br />
						<?php if( $menu_widget["id"] == 'custom_node' ) : ?>
							link: <input type="text" class="linktext" value="" name="data[][href]">
						<?php else:  ?>
							link: <a href="<?php echo $menu_widget["href"]; ?>" target="_blank"><?php echo $menu_widget["href"]; ?></a>
							<input type="hidden" class="linktext" value="<?php echo $menu_widget["href"]; ?>" name="data[][href]">
						<?php endif; ?>
					</p>
					<label>
						<?php _e( 'Title' ); ?> : <input type="text" class="regular-text titletext" value="<?php echo esc_html( $menu_widget["title"] ); ?>" name="data[][title]">
					</label>
					<input type="hidden" class="parent" value="<?php echo $menu_widget["parent"]; ?>" name="data[][parent]">
				</div>

				<div class="submenu">
					<p class="description"><?php _e( 'Sub Menus' , $this->ltd ); ?></p>
					<?php if( empty( $menu_widget["new"] ) && !empty( $menu_widget["subnode"] ) ) : ?>
						<?php foreach($menu_widget["subnode"] as $sm) : ?>

							<div class="widget">

								<div class="widget-top">
									<div class="widget-title-action">
										<a class="widget-action" href="#available"></a>
									</div>
									<div class="widget-title">
										<h4>
											<?php echo $sm["title"]; ?>
											: <span class="in-widget-title"><?php echo $sm["id"]; ?></span>
										</h4>
									</div>
								</div>

								<div class="widget-inside">
									<div class="settings">
										<p class="description">
											ID: <?php echo $sm["id"]; ?>
											<input type="hidden" class="idtext" value="<?php echo $sm["id"]; ?>" name="data[][id]"><br />
											link: <a href="<?php echo $sm["href"]; ?>" target="_blank"><?php echo $sm["href"]; ?></a>
											<input type="hidden" class="linktext" value="<?php echo $sm["href"]; ?>" name="data[][href]">
										</p>
										<label>
											<?php _e( 'Title' ); ?> : <input type="text" class="regular-text titletext" value="<?php echo esc_html( $sm["title"] ); ?>" name="data[][title]">
										</label>
										<input type="hidden" class="parent" value="<?php echo $sm["parent"]; ?>" name="data[][parent]">
									</div>
									<div class="widget-control-actions">
										<div class="alignleft">
											<a href="#remove"><?php _e( 'Remove' ); ?></a>
										</div>
										<div class="clear"></div>
									</div>
								</div>
							</div>

						<?php endforeach; ?>
					<?php endif; ?>
				</div>
				<div class="widget-control-actions">
					<div class="alignleft">
						<a href="#remove"><?php _e( 'Remove' ); ?></a>
					</div>
					<div class="clear"></div>
				</div>
			</div>

		</div>
<?php
	}



	// DataUpdate
	function update_validate() {
		$Update = array();

		if( !empty( $_POST[$this->UPFN] ) ) {
			$UPFN = strip_tags( $_POST[$this->UPFN] );
			if( $UPFN == $this->UPFN ) {
				$Update["UPFN"] = strip_tags( $_POST[$this->UPFN] );
			}
		}

		return $Update;
	}

	// DataUpdate
	function update_reset( $record ) {
		$Update = $this->update_validate();
		if( !empty( $Update ) ) {
			delete_option( $this->Record[$record] );
			$this->Msg .= '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
		}
	}

	// DataUpdate
	function DonatingCheck() {
		$Update = $this->update_validate();

		if( !empty( $Update ) ) {
			if( !empty( $_POST["donate_key"] ) ) {
				$SubmitKey = md5( strip_tags( $_POST["donate_key"] ) );
				if( $this->DonateKey == $SubmitKey ) {
					update_option( $this->Record["donate"] , $SubmitKey );
					$this->Msg .= '<div class="updated"><p><strong>' . __( 'Thank you for your donation.' , $this->ltd ) . '</strong></p></div>';
				}
			}
		}

	}

	// DataUpdate
	function update_userrole() {
		$Update = $this->update_validate();
		if( !empty( $Update ) ) {

			if( !empty( $_POST["data"]["user_role"] ) ) {
				foreach($_POST["data"]["user_role"] as $key => $val) {
					$tmpK = strip_tags( $key );
					$tmpV = strip_tags ( $val );
					$Update[$tmpK] = $tmpV;
				}
			}

			update_option( $this->Record["user_role"] , $Update );
			$this->Msg .= '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
		}
	}

	// DataUpdate
	function update_site() {
		$Update = $this->update_validate();
		if( !empty( $Update ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $key => $val) {
					$tmpK = strip_tags( $key );
					$tmpV = strip_tags ( $val );
					$Update[$tmpK] = $tmpV;
				}
			}

			update_option( $this->Record["site"] , $Update );
			$this->Msg .= '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
		}
	}

	// DataUpdate
	function update_admin_general() {
		$Update = $this->update_validate();
		if( !empty( $Update ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $key => $val) {
					$tmpK = strip_tags( $key );
					$tmpV = $val;
					$Update[$tmpK] = $tmpV;
				}
			}

			update_option( $this->Record["admin_general"] , $Update );
			$this->Msg .= '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
		}
	}

	// DataUpdate
	function update_dashboard() {
		$Update = $this->update_validate();
		if( !empty( $Update ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $key => $val) {
					$tmpK = strip_tags( $key );
					$tmpV = $val;
					$Update[$tmpK] = $tmpV;
				}
			}

			update_option( $this->Record["dashboard"] , $Update );
			$this->Msg .= '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
		}
	}

	// DataUpdate
	function update_admin_bar_menu() {
		$Update = $this->update_validate();
		if( !empty( $Update ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $boxtype => $nodes) {
					if( $boxtype === 'left' or $boxtype === 'right' ) {
						foreach($nodes as $key => $node) {
							$id = "";
							if( !empty( $node["id"] ) ) {
								$id = strip_tags( $node["id"] );
							}
							$title = "";
							if( !empty( $node["title"] ) ) {
								$title = stripslashes( $node["title"] );
							}
							$href = "";
							if( !empty( $node["href"] ) ) {
								$href = strip_tags( $node["href"] );
							}
							$parent = "";
							$depth = "main";
							if( !empty( $node["parent"] ) ) {
								$parent = strip_tags( $node["parent"] );
								$depth = 'sub';
							}
		
							$Update[$boxtype][$depth][] = array( "id" => $id , "title" => $title , "href" => $href , "parent" => $parent );
						}
					}
				}
			}

			update_option( $this->Record["admin_bar_menu"] , $Update );
			$this->Msg .= '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
		}
	}

	// DataUpdate
	function update_sidemenu() {
		$Update = $this->update_validate();
		if( !empty( $Update ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $menu) {
					if( !empty( $menu["title"] ) && !empty( $menu["slug"] ) ) {
						$slug = htmlspecialchars( $menu["slug"] );
						$title = stripslashes( $menu["title"] );
						$parent_slug = '';
						$depth = 'main';

						if( !empty( $menu["parent_slug"] ) ) {
							$parent_slug = strip_tags( $menu["parent_slug"] );
							$depth = 'sub';
						}
						
						$Update[$depth][] = array( "slug" => $slug , "title" => $title , "parent_slug" => $parent_slug );
					}
				}
			}

			update_option( $this->Record["sidemenu"] , $Update );
			$this->Msg .= '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
		}
	}

	// DataUpdate
	function update_removemetabox() {
		$Update = $this->update_validate();
		if( !empty( $Update ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $post_type => $val) {
					$post_type = strip_tags( $post_type );
					if( is_array( $val ) ) {
						foreach($val as $id => $v) {
							$tmpK = strip_tags( $id );
							$tmpV = strip_tags ( $v );
							$Update[$post_type][$tmpK] = $tmpV;
						}
					}
					
				}
			}

			update_option( $this->Record["removemetabox"] , $Update );
			$this->Msg .= '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
		}
	}

	// DataUpdate
	function update_post_add_edit() {
		$Update = $this->update_validate();
		if( !empty( $Update ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $edited => $val) {
					$tmpK = strip_tags( $edited );
					$tmpV = strip_tags ( $val );
					$Update[$tmpK] = $tmpV;
				}
			}

			update_option( $this->Record["post_add_edit"] , $Update );
			$this->Msg .= '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
		}
	}

	// DataUpdate
	function update_appearance_menus() {
		$Update = $this->update_validate();
		if( !empty( $Update ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $edited => $val) {
					$tmpK = strip_tags( $edited );
					$tmpV = strip_tags ( $val );
					$Update[$tmpK] = $tmpV;
				}
			}

			update_option( $this->Record["appearance_menus"] , $Update );
			$this->Msg .= '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';
		}
	}

	// DataUpdate
	function update_loginscreen() {
		$Update = $this->update_validate();
		if( !empty( $Update ) ) {

			if( !empty( $_POST["data"] ) ) {
				foreach($_POST["data"] as $key => $val) {
					$tmpK = strip_tags( $key );
					$tmpV = $val;
					$Update[$tmpK] = $tmpV;
				}
			}

			update_option( $this->Record["loginscreen"] , $Update );
			$this->Msg .= '<div class="updated"><p><strong>' . __('Settings saved.') . '</strong></p></div>';

		}
	}





	// FilterStart
	function FilterStart() {
		// site
		if( !is_admin() ) {
			add_action( 'setup_theme' , array( $this , 'remove_action_front' ) ) ;
			add_filter( 'login_headerurl' , array( $this , 'login_headerurl' ) );
			add_filter( 'login_headertitle' , array( $this , 'login_headertitle' ) );
			add_action( 'login_head' , array( $this , 'login_head' ) );
			add_action( 'login_footer' , array( $this , 'login_footer' ) );
		}
		// admin UI
		if ( is_admin() ) {
			// default side menu load.
			add_action( 'admin_menu' , array( $this , 'sidemenu_default_load' ) , 10000 );
			// default admin bar menu load.
			add_action( 'wp_before_admin_bar_render' , array( $this , 'admin_bar_default_load' ) , 1 );
			// admin init
			add_action( 'init' , array( $this , 'admin_init' ) );
		}
	}

	// FilterStart
	function admin_init() {

		$SettingRole = $this->get_data( 'user_role' );
		if( !empty( $SettingRole ) ) {
			unset($SettingRole["UPFN"]);

			$UserRole = '';
			$User = wp_get_current_user();
			if( !empty( $User->roles[0] ) ) {
				$UserRole = $User->roles[0];
			}

			if( !is_network_admin() ) {
				if( array_key_exists( $UserRole , $SettingRole ) ){
					add_action( 'wp_before_admin_bar_render' , array( $this , 'admin_bar_menu') , 25 );
					add_action( 'init' , array( $this , 'notice_dismiss' ) , 2 );
					add_action( 'admin_head' , array( $this , 'remove_tab' ) );
					add_filter( 'admin_footer_text' , array( $this , 'admin_footer_text' ) );
					add_action( 'admin_print_styles' , array( $this , 'load_css' ) );
					add_action( 'wp_dashboard_setup' , array( $this , 'wp_dashboard_setup' ) );
					add_action( 'admin_menu' , array( $this , 'removemetabox' ) );
					add_filter( 'admin_menu', array( $this , 'sidemenu' ) , 10001 );
					add_filter( 'get_sample_permalink_html' , array( $this , 'add_edit_post_change_permalink' ) );
					add_action( 'admin_print_styles-nav-menus.php', array( $this , 'nav_menus' ) );
				}
			}
		}
	}

	// FilterStart
	function remove_action_front() {
		$GetData = $this->get_data( 'site' );
		
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );
			foreach($GetData as $key => $val) {
				if( $key == 'feed_links' ) {
					remove_action( 'wp_head', $key , 2 );
				} elseif( $key == 'feed_links_extra' ) {
					remove_action( 'wp_head', $key , 3 );
				} elseif( $key == 'admin_bar' ) {
					add_filter( 'show_admin_bar' , '__return_false' );  
				} else {
					remove_action( 'wp_head', $key );
				}
			}
		}

	}

	// FilterStart
	function login_headerurl() {
		$GetData = get_option( $this->Record["loginscreen"] );

		$url = __( 'http://wordpress.org/' );
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["login_headerurl"] ) ) {
				$url = strip_tags( $GetData["login_headerurl"] );
				$url = str_replace( '[blog_url]' , get_bloginfo( 'url' ) , $url );
				
			}
		}

		return $url;
	}

	// FilterStart
	function login_headertitle() {
		$GetData = get_option( $this->Record["loginscreen"] );

		$title = __( 'Powered by WordPress' );
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["login_headertitle"] ) ) {
				$title = strip_tags( $GetData["login_headertitle"] );
				$title = str_replace( '[blog_name]' , get_bloginfo( 'name' ) , $title );
				
			}
		}

		return $title;
	}

	// FilterStart
	function login_head() {
		$GetData = get_option( $this->Record["loginscreen"] );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["login_headerlogo"] ) ) {
				$logo = strip_tags( $GetData["login_headerlogo"] );
				$logo = str_replace( '[blog_url]' , get_bloginfo( 'url' ) , $logo );
				$logo = str_replace( '[template_directory_uri]' , get_bloginfo( 'template_directory' ) , $logo );

				echo '<style type="text/css">.login h1 a { background-image: url(' . $logo . '); }</style>';
			}

			if( !empty( $GetData["login_css"] ) ) {
				$css = strip_tags( $GetData["login_css"] );
				$css = str_replace( '[blog_url]' , get_bloginfo( 'url' ) , $css );
				$css = str_replace( '[template_directory_uri]' , get_bloginfo( 'template_directory' ) , $css );

				wp_enqueue_style( $this->PageSlug , $css , array() , $this->Ver );
			}

		}

	}

	// FilterStart
	function login_footer() {
		$GetData = get_option( $this->Record["loginscreen"] );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["login_footer"] ) ) {
				$text = stripslashes( $GetData["login_footer"] );

				echo $text;
			}

		}
	}

	// FilterStart
	function admin_bar_menu() {
		global $wp_admin_bar;

		$GetData = $this->get_data( 'admin_bar_menu' );
		
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );
			if( !empty( $GetData ) ) {

				// remove all nodes
				$All_Nodes = $wp_admin_bar->get_nodes();
				foreach( $All_Nodes as $node ) {
					if( $node->id != 'top-secondary' ) {
						$wp_admin_bar->remove_node( $node->id );
					}
				}

				// add nodes
				foreach($GetData as $Boxtype => $allnodes) {
					foreach($allnodes as $depth => $nodes) {
						foreach($nodes as $node) {
							$args = array( "id" => $node["id"] , "title" => stripslashes( $node["title"] ) , "href" => $node["href"] , "parent" => "" );
							if( $depth == 'sub' ) {
								$args["parent"] = $node["parent"];
							}
							if( $Boxtype == 'right' && $depth == 'main' ) {
								$args["parent"] = "top-secondary";
							}
							$wp_admin_bar->add_menu( $args );
						}
					}
				}

			}
		}
	}

	// FilterStart
	function notice_dismiss() {
		$GetData = $this->get_data( 'admin_general' );

		if( !empty( $GetData["UPFN"] ) ) {

			if( !empty( $GetData["notice_update_core"] ) ) {
				add_filter( 'update_footer' , '__return_false' , 20) ;
				add_filter( 'site_transient_update_core' , array( $this , 'notice_update_core' ) );
			}

			if( !empty( $GetData["notice_update_plugin"] ) ) {
				add_filter( 'site_transient_update_plugins' , array( $this , 'notice_update_plugin' ) );
			}
			if( !empty( $GetData["notice_update_theme"] ) ) {
				add_filter( 'site_transient_update_themes' , array( $this , 'notice_update_theme' ) );
			}

		}

	}

	// FilterStart
	function notice_update_core( $site_transient_update_core ) {
		$site_transient_update_core->updates[0]->response = 'latest';
		
		return $site_transient_update_core;
	}

	// FilterStart
	function notice_update_plugin( $site_transient_update_plugins ) {
		$site_transient_update_plugins->response = '';
		
		return $site_transient_update_plugins;
	}

	// FilterStart
	function notice_update_theme( $site_transient_update_themes ) {
		$site_transient_update_themes->response = '';
		
		return $site_transient_update_themes;
	}

	// FilterStart
	function remove_tab() {
		$GetData = get_option( $this->Record["admin_general"] );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["help_tab"] ) ) {
				$screen = get_current_screen();
				$screen->remove_help_tabs();
			}
	
			if( !empty( $GetData["screen_option_tab"] ) ) {
				add_filter( 'screen_options_show_screen' , '__return_false' );
			}
		}

	}

	// FilterStart
	function admin_footer_text( $text ) {
		$GetData = $this->get_data( 'admin_general' );

		$footer_text = $text;
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			$footer_text = stripslashes( $GetData["footer_text"] );
		}

		return $footer_text;
	}

	// FilterStart
	function load_css() {
		$GetData = get_option( $this->Record["admin_general"] );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["css"] ) ) {

				$css = strip_tags( $GetData["css"] );
				$css = str_replace( '[blog_url]' , get_bloginfo( 'url' ) , $css );
				$css = str_replace( '[template_directory_uri]' , get_bloginfo( 'template_directory' ) , $css );

				wp_enqueue_style( $this->PageSlug , strip_tags( $css ) , array() , $this->Ver );
			}
	
		}

	}

	// FilterStart
	function wp_dashboard_setup() {
		global $wp_meta_boxes;

		$GetData = get_option( $this->Record["dashboard"] );

		if( !empty( $GetData ) && is_array( $GetData ) ) {
			unset($GetData["UPFN"]);
			$dashboard_widgets = array();
			foreach($wp_meta_boxes["dashboard"] as $ns => $core) {
				foreach($core["core"] as $id => $val) {
					$dashboard_widgets[$id] = $ns;
				}
			}

			foreach($GetData as $id => $val) {
				if( $id == 'show_welcome_panel' ) {
					$user_id = get_current_user_id();
					if( get_user_meta( $user_id , 'show_welcome_panel' , true ) == true ) {
						update_user_meta( $user_id , 'show_welcome_panel' , 0 );
					}
				} elseif( array_key_exists( $id , $dashboard_widgets ) ){
					remove_meta_box( $id , 'dashboard' , $dashboard_widgets[$id] );
				}
			}
		}

	}

	// FilterStart
	function removemetabox() {
		$GetData = get_option( $this->Record["removemetabox"] );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData ) && is_array( $GetData ) ) {
				foreach($GetData as $post_type => $val) {
					foreach($val as $id => $v) {
						if( $id == 'postimagediv' ) {
							if( current_theme_supports( 'post-thumbnails' ) ) {
								remove_post_type_support( $post_type , 'thumbnail' );
							}
						} else {
							remove_meta_box( $id , $post_type , 'normal' );
						}
					}
				}
			}
		}

	}

	// FilterStart
	function sidemenu() {
		global $menu;
		global $submenu;

		$GetData = get_option( $this->Record["sidemenu"] );
		$General = get_option( $this->Record["admin_general"] );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData ) && is_array( $GetData ) && !empty( $GetData["main"] ) ) {
				$SetMain_menu = array();
				$SetMain_submenu = array();
				$separator_menu = $menu[99];
				
				foreach($GetData["main"] as $mm_pos => $mm) {
					if($mm["slug"] == 'separator') {
						$SetMain_menu[] = $separator_menu;
					} else {
						$gm_search = false;
						foreach($menu as $gm_pos => $gm) {
							if($mm["slug"] == $gm[2]) {
								$menu[$gm_pos][0] = $mm["title"];
								$SetMain_menu[] = $menu[$gm_pos];
								$gm_search = true;
								break;
							}
						}
						if( empty( $gm_search ) ) {
							foreach($submenu as $gsm_parent_slug => $v) {
								foreach($v as $gsm_pos => $gsm) {
									if($mm["slug"] == $gsm[2]) {
										
										foreach($menu as $tmp_m) {
											if( $tmp_m[2] == $gsm_parent_slug) {
												$submenu[$gsm_parent_slug][$gsm_pos][4] = $tmp_m[4];
												break;
											}
										}
										
										$submenu[$gsm_parent_slug][$gsm_pos][0] = $mm["title"];
										$SetMain_menu[] = $submenu[$gsm_parent_slug][$gsm_pos];

									}
								}
							}
						}
					}
				}

				foreach($GetData["sub"] as $sm_pos => $sm) {
					if($sm["slug"] == 'separator') {
						$SetMain_submenu[$sm["parent_slug"]][] = $separator_menu;
					} else {
						$gm_search = false;
						foreach($menu as $gm_pos => $gm) {
							if($sm["slug"] == $gm[2]) {
								$menu[$gm_pos][0] = $sm["title"];
								$SetMain_submenu[$sm["parent_slug"]][] = $menu[$gm_pos];
								$gm_search = true;
								break;
							}
						}
						if( empty( $gm_search ) ) {
							foreach($submenu as $gsm_parent_slug => $v) {
								foreach($v as $gsm_pos => $gsm) {
									if($sm["slug"] == $gsm[2]) {
										$submenu[$gsm_parent_slug][$gsm_pos][0] = $sm["title"];
										$SetMain_submenu[$sm["parent_slug"]][] = $submenu[$gsm_parent_slug][$gsm_pos];
									}
								}
							}
						}
					}
				}

				$menu = $SetMain_menu;
				$submenu = $SetMain_submenu;
				
			}
		}
	}

	// FilterStart
	function add_edit_post_change_permalink( $permalink_html ) {
		$GetData = get_option( $this->Record["post_add_edit"] );

		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData ) && is_array( $GetData ) ) {
				if( !empty( $GetData["default_permalink"] ) ) {
					if( strpos( $permalink_html , 'change-permalinks' ) ) {

						$permalink_html = preg_replace( "/<span id=\"change-permalinks\">(.*)<\/span>/" , "" , $permalink_html );

					}
				}
			}
		}
		
		return $permalink_html;
	}

	// FilterStart
	function nav_menus() {
		$GetData = get_option( $this->Record["appearance_menus"] );
		if( !empty( $GetData["UPFN"] ) ) {
			unset( $GetData["UPFN"] );

			if( !empty( $GetData["add_new_menu"] ) ) {
				echo '<style>.nav-tabs .menu-add-new { display: none; }</style>';
			}
			if( !empty( $GetData["delete_menu"] ) ) {
				echo '<style>.major-publishing-actions .delete-action { display: none; }</style>';
			}

		}
	}

	// FilterStart
	function layout_footer( $text ) {
		$text = '<img src="http://www.gravatar.com/avatar/7e05137c5a859aa987a809190b979ed4?s=18" width="18" /> Plugin developer : <a href="http://gqevu6bsiz.chicappa.jp/?utm_source=use_plugin&utm_medium=footer&utm_content=' . $this->ltd . '&utm_campaign=' . str_replace( '.' , '_' , $this->Ver ) . '" target="_blank">gqevu6bsiz</a>';
		return $text;
	}

	// FilterStart
	function DisplayDonation() {
		$donation = get_option( $this->Record["donate"] );
		if( $this->DonateKey != $donation ) {
			$this->Msg .= '<div class="error"><p><strong>' . __( 'Please consider a donation if you are satisfied with this plugin.' , $this->ltd_p ) . '</strong> <a href="' . self_admin_url( 'admin.php?page=' . $this->PageSlug ) . '">' . __( 'Please donation.' , $this->ltd_p ) . '</a></p></div>';
		}
	}

}
$wauc = new WP_Admin_UI_Customize();


