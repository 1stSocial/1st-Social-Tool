<?php

if( !empty( $_POST["update"] ) ) {
	$this->update_admin_general();
} elseif( !empty( $_POST["reset"] ) ) {
	$this->update_reset( 'admin_general' );
}

$Data = $this->get_data( 'admin_general' );
$User = wp_get_current_user();

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.css', array() , $this->Ver );

?>

<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<?php echo $this->Msg; ?>
	<h2><?php _e( 'General screen setting' , $this->ltd ); ?></h2>
	<p>&nbsp;</p>

	<form id="waum_setting_admin_genelral" class="waum_form" method="post" action="">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field(); ?>

		<div class="metabox-holder columns-1">

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span><?php echo _e( 'Notice' , $this->ltd ); ?></span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<tr>
								<th>
									<label><?php _e( 'Wordpress core update notice' , $this->ltd ); ?></label>
								</th>
								<td>
									<?php $field = 'notice_update_core'; ?>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Not notified' , $this->ltd ); ?></label>
								</td>
							</tr>
							<tr>
								<th>
									<label><?php _e( 'Plugin update notice' , $this->ltd ); ?></label>
								</th>
								<td>
									<?php $field = 'notice_update_plugin'; ?>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Not notified' , $this->ltd ); ?></label>
								</td>
							</tr>
							<tr>
								<th>
									<label><?php _e( 'Theme update notice' , $this->ltd ); ?></label>
								</th>
								<td>
									<?php $field = 'notice_update_theme'; ?>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Not notified' , $this->ltd ); ?></label>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span><?php echo _e( 'Screen Options and Help tab' , $this->ltd ); ?></span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<tr>
								<th>
									<label><?php _e( 'Screen Options' ); ?></label>
								</th>
								<td>
									<?php $field = 'screen_option_tab'; ?>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<tr>
								<th>
									<label><?php _e( 'Help' ); ?></label>
								</th>
								<td>
									<?php $field = 'help_tab'; ?>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span><?php echo _e( 'Footer' ); ?></span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<tr>
								<th>
									<label><?php _e( 'Footer text' , $this->ltd ); ?></label>
								</th>
								<td>
									<?php $field = 'footer_text'; ?>
									<?php $Val = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Val = esc_html( stripslashes( $Data[$field] ) ); endif; ?>
									<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="large-text" />
									<p class="description">Default: <?php _e( 'Thank you for creating with <a href="http://wordpress.org/">WordPress</a>.' ); ?></p>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span><?php _e( 'General' ); ?></span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<?php $field = 'css'; ?>
							<tr>
								<th>
									<label><?php _e( 'Css file to load' , $this->ltd ); ?></label>
								</th>
								<td>
									<?php $Val = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Val = strip_tags( $Data[$field] ); endif; ?>
									<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="regular-text" id="<?php echo $field; ?>">
									<code>[blog_url] [template_directory_uri]</code>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

		</div>

		<p class="submit">
			<input type="submit" class="button-primary" name="update" value="<?php _e( 'Save' ); ?>" />
		</p>

		<p class="submit reset">
			<span class="description"><?php _e( 'Would initialize?' , $this->ltd ); ?></span>
			<input type="submit" class="button-secondary" name="reset" value="<?php _e('Reset'); ?>" />
		</p>

	</form>

</div>
