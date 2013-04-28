<?php

if( !empty( $_POST["update"] ) ) {
	$this->update_site();
} elseif( !empty( $_POST["reset"] ) ) {
	$this->update_reset( 'site' );
}

$Data = $this->get_data( 'site' );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.css', array() , $this->Ver );

?>

<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Site Settings' , $this->ltd ); ?></h2>
	<p>&nbsp;</p>

	<form id="waum_setting_site" class="waum_form" method="post" action="">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field(); ?>

		<div class="metabox-holder columns-1">

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span>Meta Fields</span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<?php $field = 'wp_generator'; ?>
							<tr>
								<th>
									<label><?php echo $field; ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
									<p class="description"><?php _e( 'Tag to be output' , $this->ltd ); ?> : <code><?php echo esc_html( get_the_generator( 'xhtml' ) ); ?></code></p>
								</td>
							</tr>
							<?php $field = 'wlwmanifest_link'; ?>
							<tr>
								<th>
									<?php echo $field; ?>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
									<p class="description"><?php _e( 'Please display when using the Windows Live Writer.' , $this->ltd ); ?></p>
									<p class="description"><?php _e( 'Tag to be output' , $this->ltd ); ?> : <code><?php echo esc_html( '<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="'
		. get_bloginfo('wpurl') . '/wp-includes/wlwmanifest.xml" />' ); ?></code></p>
								</td>
							</tr>
							<?php $field = 'rsd_link'; ?>
							<tr>
								<th>
									<?php echo $field; ?>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
									<p class="description"><?php _e( 'Information of XML-rpc' , $this->ltd ); ?></p>
									<p class="description"><?php _e( 'Tag to be output' , $this->ltd ); ?> : <code><?php echo esc_html( '<link rel="EditURI" type="application/rsd+xml" title="RSD" href="' . get_bloginfo('wpurl') . '"/xmlrpc.php?rsd" />' ); ?></code></p>
								</td>
							</tr>
							<?php $field = 'feed_links'; ?>
							<tr>
								<th>
									<?php echo $field; ?>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
									<p class="description"><?php _e( 'Sitewide feed' , $this->ltd ); ?></p>
									<p class="description"><?php _e( 'Tag to be output' , $this->ltd ); ?> : <code><?php echo esc_html( '<link rel="alternate" type="' . feed_content_type() . '" title="' . esc_attr( sprintf( __('%1$s %2$s Feed') , get_bloginfo('name') , '&amp;raquo&#059;' ) ) . '" href="' . get_feed_link( get_default_feed() ) . ' />' ); ?></code></p>
								</td>
							</tr>
							<?php $field = 'feed_links_extra'; ?>
							<tr>
								<th>
									<?php echo $field; ?>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
									<p class="description"><?php _e( 'Extra feed' , $this->ltd ); ?></p>
									<p class="description"><?php _e( 'Tag to be output' , $this->ltd ); ?> : <code><?php echo esc_html( '<link rel="alternate" type="' . feed_content_type() . '" title="' . esc_attr( sprintf( __('%1$s %2$s Comments Feed') , get_bloginfo('name') , '&amp;raquo&#059;' ) ) . '" href="' . get_feed_link( get_default_feed() . '&#038;p=***' ) . ' />' ); ?></code></p>
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
							<?php $field = 'admin_bar'; ?>
							<tr>
								<th>
									<?php echo $field; ?>
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
