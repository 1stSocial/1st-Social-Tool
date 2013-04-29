<?php

if( !empty( $_POST["update"] ) ) {
	$this->update_appearance_menus();
} elseif( !empty( $_POST["reset"] ) ) {
	$this->update_reset( 'appearance_menus' );
}

$Data = $this->get_data( 'appearance_menus' );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.css', array() , $this->Ver );

?>

<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Appearance\'s Menus screen setting' , $this->ltd ); ?></h2>
	<p>&nbsp;</p>

	<form id="waum_setting_removemtabox" class="waum_form" method="post" action="">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field(); ?>

		<div class="metabox-holder columns-1">

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span><?php _e( 'Menus' ); ?></span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<?php $field = 'add_new_menu'; ?>
							<tr>
								<th>
									<label><?php _e( 'Add a new menu' , $this->ltd ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
									<p class="description"><?php _e( 'This is useful when you want to use only the menus have been created.' , $this->ltd ); ?>
									<p><img src="<?php echo $this->Dir; ?>images/appearance_menus_add_new_menu.png" /></p>
								</td>
							</tr>
							<?php $field = 'delete_menu'; ?>
							<tr>
								<th>
									<label><?php _e( 'Delete Menu' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
									<p class="description"><?php _e( 'This is useful when you want to use only the menus have been created.' , $this->ltd ); ?>
									<p><img src="<?php echo $this->Dir; ?>images/appearance_menus_delete_menu.png" /></p>
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
