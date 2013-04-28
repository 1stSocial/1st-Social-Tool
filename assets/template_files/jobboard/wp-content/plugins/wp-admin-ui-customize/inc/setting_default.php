<?php

if( !empty( $_POST["donate_key"] ) ) {
	$this->DonatingCheck();
} elseif( !empty( $_POST["update"] ) ) {
	$this->update_userrole();
} elseif( !empty( $_POST["reset"] ) ) {
	$this->update_reset( 'user_role' );
}

$Data = $this->get_data( 'user_role' );
$UserRoles = $this->get_user_role();

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.css', array() , $this->Ver );

?>
<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<?php echo $this->Msg; ?>
	<h2><?php echo $this->Name; ?></h2>
	<p><?php _e( 'Customize the UI of the management screen for all users.' , $this->ltd ); ?>
	<p><?php _e ( 'Please select the user role you want to apply the settings.' , $this->ltd ); ?></p>

	<div class="metabox-holder columns-2">

		<div id="postbox-container-1" class="postbox-container">

			<form id="waum_setting_site" class="waum_form" method="post" action="">
				<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
				<?php wp_nonce_field(); ?>

				<div class="postbox">
					<h3 class="hndle"><span><?php _e( 'User Roles' ); ?></span></h3>
					<div class="inside">
						<?php $field = 'user_role'; ?>
						<?php foreach($UserRoles as $key => $val) : ?>
							<?php $Checked = ''; ?>
							<?php if( !empty( $Data[$key] ) ) : $Checked = 'checked="checked"'; endif; ?>
							<p>
								<label>
									<input type="checkbox" name="data[<?php echo $field; ?>][<?php echo $key; ?>]" value="1" <?php echo $Checked; ?> />
									<?php echo $val; ?>
								</label>
							</p>
						<?php endforeach; ?>
					</div>
				</div>

				<p class="submit">
					<input type="submit" class="button-primary" name="update" value="<?php _e( 'Save' ); ?>" />
				</p>
		
				<p class="submit reset">
					<span class="description"><?php _e( 'Would initialize?' , $this->ltd ); ?></span>
					<input type="submit" class="button-secondary" name="reset" value="<?php _e('Reset'); ?>" />
				</p>

				<p>&nbsp;</p>
				
			</form>

			<form id="donation_form" class="waum_form" method="post" action="">
				<h3><?php _e( 'If you have already donated to.' , $this->ltd_p ); ?></h3>
				<p><?php _e( 'Please enter the \'Donation delete key\' that have been described in the \'Line Break First and End download page\'.' , $this->ltd_p ); ?></p>
				<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
				<?php wp_nonce_field(); ?>
				<label for="donate_key"><?php _e( 'Donation delete key' , $this->ltd_p ); ?></label>
				<input type="text" name="donate_key" id="donate_key" value="" class="regular-text" />
				<input type="submit" class="button-primary" name="update" value="<?php _e( 'Submit' ); ?>" />
			</form>

		</div>

		<div id="postbox-container-2" class="postbox-container">

			<div class="stuffbox" id="donationbox">
				<div class="inside">
					<p style="color: #FFFFFF; font-size: 20px;"><?php _e( 'Please donation.' , $this->ltd_p ); ?></p>
					<p style="color: #FFFFFF;"><?php _e( 'You are contented with this plugin?<br />By the laws of Japan, Japan\'s new paypal user can not make a donation button.<br />So i would like you to buy this plugin as the replacement for the donation.' , $this->ltd_p ); ?></p>
					<p>&nbsp;</p>
					<p style="text-align: center;">
						<a href="http://gqevu6bsiz.chicappa.jp/line-break-first-and-end/?utm_source=use_plugin&utm_medium=donate&utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" class="button-primary" target="_blank">Line Break First and End</a>
					</p>
					<p>&nbsp;</p>
					<div class="donation_memo">
						<p><strong><?php _e( 'Features' , $this->ltd_p ); ?></strong></p>
						<p><?php _e( 'Line Break First and End plugin is In the visual editor TinyMCE, It is a plugin that will help when you will not be able to enter a line break.' , $this->ltd_p ); ?></p>
					</div>
					<div class="donation_memo">
						<p><strong><?php _e( 'The primary use of donations' , $this->ltd_p ); ?></strong></p>
						<ul>
							<li>- <?php _e( 'Liquidation of time and value' , $this->ltd_p ); ?></li>
							<li>- <?php _e( 'Additional suggestions feature' , $this->ltd_p ); ?></li>
							<li>- <?php _e( 'Maintain motivation' , $this->ltd_p ); ?></li>
							<li>- <?php _e( 'Ensure time as the father of Sunday' , $this->ltd_p ); ?></li>
						</ul>
					</div>
				</div>
			</div>

			<div class="stuffbox" id="aboutbox">
				<h3><span class="hndle"><?php _e( 'About plugin' , $this->ltd_p ); ?></span></h3>
				<div class="inside">
					<p><?php _e( 'Version check' , $this->ltd_p ); ?> : 3.4.2 - 3.5.1</p>
					<ul>
						<li><a href="http://gqevu6bsiz.chicappa.jp/?utm_source=use_plugin&utm_medium=side&utm_content=utm_content=<?php echo $this->ltd; ?>&utm_campaign=<?php echo str_replace( '.' , '_' , $this->Ver ); ?>" target="_blank"><?php _e( 'Developer\'s site' , $this->ltd_p ); ?></a></li>
						<li><a href="http://wordpress.org/support/plugin/wp-admin-ui-customize" target="_blank"><?php _e( 'Support Forums' ); ?></a></li>
						<li><a href="http://wordpress.org/support/view/plugin-reviews/wp-admin-ui-customize" target="_blank"><?php _e( 'Reviews' , $this->ltd ); ?></a></li>
						<li><a href="https://twitter.com/gqevu6bsiz" target="_blank">twitter</a></li>
						<li><a href="http://www.facebook.com/pages/Gqevu6bsiz/499584376749601" target="_blank">facebook</a></li>
					</ul>
				</div>
			</div>

			<div class="stuffbox" id="usefulbox">
				<h3><span class="hndle"><?php _e( 'Useful plugins' , $this->ltd_p ); ?></span></h3>
				<div class="inside">
					<p><strong><a href="http://wordpress.org/extend/plugins/post-lists-view-custom/" target="_blank">Post Lists View Custom</a></strong></p>
					<p class="description"><?php _e( 'Customize the list of the post and page. custom post type page, too. You can customize the column display items freely.' , $this->ltd_p ); ?></p>
					<p><strong><a href="http://wordpress.org/extend/plugins/announce-from-the-dashboard/" target="_blank">Announce from the Dashboard</a></strong></p>
					<p class="description"><?php _e( 'Announce to display the dashboard. Change the display to a different user role.' , $this->ltd_p ); ?></p>
					<p><strong><a href="http://wordpress.org/extend/plugins/custom-options-plus-post-in/" target="_blank">Custom Options Plus Post in</a></strong></p>
					<p class="description"><?php _e( 'The plugin that allows you to add the value of the options. Option value that you have created, can be used in addition to the template tag, Short code can be used in the body of the article.' , $this->ltd_p ); ?></p>
					<p>&nbsp;</p>
				</div>
			</div>

		</div>

		<div class="clear"></div>

	</div>

</div>

<script type="text/javascript">
jQuery(document).ready(function($) {
	
	var $RDonated = '<?php echo get_option( $this->Record["donate"] ); ?>';
	var $TDonated = '<?php echo $this->DonateKey; ?>';

	if( $RDonated == $TDonated ) {
		$("#donationbox").hide();
		if( $TDonated != "" ) {
			$("#donation_form").html( '<p>&nbsp;</p><p>&nbsp;</p><span class="description"><?php _e( 'Thank you for your donation.' , $this->ltd ); ?></span>' );
		} else {
			$("#donation_form").html( '' );
		}
	}
		
});
</script>
