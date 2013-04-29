<?php

if( !empty( $_POST["update"] ) ) {
	$this->update_post_add_edit();
} elseif( !empty( $_POST["reset"] ) ) {
	$this->update_reset( 'post_add_edit' );
}

$Data = $this->get_data( 'post_add_edit' );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.css', array() , $this->Ver );

?>

<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Add New Post and Edit Post screen setting' , $this->ltd ); ?></h2>
	<p>&nbsp;</p>

	<form id="waum_setting_removemtabox" class="waum_form" method="post" action="">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field(); ?>

		<div class="metabox-holder columns-1">

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span><?php _e( 'Add New Post' ); ?> &amp; <?php _e( 'Edit Post' ); ?></span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<?php $field = 'default_permalink'; ?>
							<tr>
								<th>
									<label><?php _e( 'Change Permalinks' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
									<p class="description"><?php _e( 'Only appears when you have settings to the default permalink.' , $this->ltd ); ?></p>
									<p><img src="<?php echo $this->Dir; ?>images/post_add_edit_screen__edit_ppermalink.png" /></p>
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
