<?php

if( !empty( $_POST["update"] ) ) {
	$this->update_loginscreen();
} elseif( !empty( $_POST["reset"] ) ) {
	$this->update_reset( 'loginscreen' );
}

$Data = $this->get_data( 'loginscreen' );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' , 'thickbox' );
wp_enqueue_script( $this->PageSlug ,  $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style('thickbox');
wp_enqueue_style( $this->PageSlug , $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.css', array() , $this->Ver );

?>

<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Login Screen Settings' , $this->ltd ); ?></h2>
	<p>&nbsp;</p>

	<form id="waum_setting_loginscreen" class="waum_form" method="post" action="">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field(); ?>

		<a title="<?php _e( 'Login Screen' , $this->ltd ); ?>" href="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?TB_iframe=1&width=520&height=520" class="thickbox"><?php _e( 'Show Login Screen' , $this->ltd ); ?></a>

		<div class="metabox-holder columns-1">

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span><?php _e( 'Login Form' , $this->ltd ); ?></span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<?php $field = 'login_headerurl'; ?>
							<tr>
								<th>
									<label><?php _e( 'The link after clicking on the logo' , $this->ltd ); ?></label>
								</th>
								<td>
									<?php $Val = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Val = strip_tags( $Data[$field] ); endif; ?>
									<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="regular-text" id="<?php echo $field; ?>">
									<code>[blog_url]</code>
								</td>
							</tr>
							<?php $field = 'login_headertitle'; ?>
							<tr>
								<th>
									<label><?php _e( 'Logo title' , $this->ltd ); ?></label>
								</th>
								<td>
									<?php $Val = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Val = strip_tags( $Data[$field] ); endif; ?>
									<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="regular-text" id="<?php echo $field; ?>">
									<code>[blog_name]</code>
								</td>
							</tr>
							<?php $field = 'login_headerlogo'; ?>
							<tr>
								<th>
									<label><?php _e( 'Logo Image path' , $this->ltd ); ?></label>
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

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span><?php _e( 'General' ); ?></span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<?php $field = 'login_css'; ?>
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
							<?php $field = 'login_footer'; ?>
							<tr>
								<th>
									<label><?php _e( 'Footer text' , $this->ltd ); ?></label>
								</th>
								<td>
									<?php $Val = ''; ?>
									<?php if( !empty( $Data[$field] ) ) : $Val = stripslashes( esc_html( $Data[$field] ) ); endif; ?>
									<input type="text" name="data[<?php echo $field; ?>]" value="<?php echo $Val; ?>" class="large-text" id="<?php echo $field; ?>">
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
