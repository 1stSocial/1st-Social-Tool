<?php

if( !empty( $_POST["update"] ) ) {
	$this->update_removemetabox();
} elseif( !empty( $_POST["reset"] ) ) {
	$this->update_reset( 'removemetabox' );
}

$Data = $this->get_data( 'removemetabox' );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.css', array() , $this->Ver );

?>

<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Remove meta box' , $this->ltd ); ?></h2>
	<p>&nbsp;</p>

	<form id="waum_setting_removemtabox" class="waum_form" method="post" action="">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field(); ?>

		<div class="metabox-holder columns-1">

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span><?php _e( 'Post' ); ?></span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<?php $field = 'categorydiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Category' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'tagsdiv-post_tag'; ?>
							<tr>
								<th>
									<label><?php _e( 'Tag' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'postimagediv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Featured Images' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'postexcerpt'; ?>
							<tr>
								<th>
									<label><?php _e( 'Excerpt' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'trackbacksdiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Send Trackbacks' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'postcustom'; ?>
							<tr>
								<th>
									<label><?php _e( 'Custom Fields' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'commentstatusdiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Discussion' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'commentsdiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Comments' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'slugdiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Slug' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'authordiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Author' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'revisionsdiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Revisions' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'formatdiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Format' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["post"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[post][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>

			<div class="postbox">
				<div class="handlediv" title="Click to toggle"><br></div>
				<h3 class="hndle"><span><?php _e( 'Page' ); ?></span></h3>
				<div class="inside">
					<table class="form-table">
						<tbody>
							<?php $field = 'pageparentdiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Page Attributes' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["page"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[page][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'postimagediv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Featured Images' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["page"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[page][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'postcustom'; ?>
							<tr>
								<th>
									<label><?php _e( 'Custom Fields' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["page"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[page][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'commentstatusdiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Discussion' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["page"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[page][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'commentsdiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Comments' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["page"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[page][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'slugdiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Slug' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["page"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[page][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'authordiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Author' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["page"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[page][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
								</td>
							</tr>
							<?php $field = 'revisionsdiv'; ?>
							<tr>
								<th>
									<label><?php _e( 'Revisions' ); ?></label>
								</th>
								<td>
									<?php $Checked = ''; ?>
									<?php if( !empty( $Data["page"][$field] ) ) : $Checked = 'checked="checked"'; endif; ?>
									<label><input type="checkbox" name="data[page][<?php echo $field; ?>]" value="1" <?php echo $Checked; ?> /> <?php _e ( 'Hide' ); ?></label>
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
