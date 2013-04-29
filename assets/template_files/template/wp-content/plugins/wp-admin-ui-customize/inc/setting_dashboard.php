<?php

if( !empty( $_POST["update"] ) ) {
	$this->update_dashboard();
} elseif( !empty( $_POST["reset"] ) ) {
	$this->update_reset( 'dashboard' );
}

$Data = $this->get_data( 'dashboard' );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.css', array() , $this->Ver );

?>

<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Dashboard' ); ?><?php _e( 'Settings' ); ?></h2>
	<p>&nbsp;</p>

	<form id="waum_setting_dashboard" class="waum_form" method="post" action="">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field(); ?>

		<div class="metabox-holder columns-1">

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span>Meta boxes</span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<?php $field = 'show_welcome_panel'; ?>
							<tr>
								<th>
									<label><?php _e( 'Welcome Panel' , $this->ltd ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'dashboard_right_now'; ?>
							<tr>
								<th>
									<label><?php _e( 'Right Now' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'dashboard_recent_comments'; ?>
							<tr>
								<th>
									<label><?php _e( 'Recent Comments' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'dashboard_incoming_links'; ?>
							<tr>
								<th>
									<label><?php _e( 'Incoming Links' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'dashboard_plugins'; ?>
							<tr>
								<th>
									<label><?php _e( 'Plugins' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'dashboard_quick_press'; ?>
							<tr>
								<th>
									<label><?php _e( 'QuickPress' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'dashboard_recent_drafts'; ?>
							<tr>
								<th>
									<label><?php _e( 'Recent Drafts' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'dashboard_primary'; ?>
							<tr>
								<th>
									<label><?php _e( 'WordPress Blog' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'dashboard_secondary'; ?>
							<tr>
								<th>
									<label><?php _e( 'Other WordPress News' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
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
