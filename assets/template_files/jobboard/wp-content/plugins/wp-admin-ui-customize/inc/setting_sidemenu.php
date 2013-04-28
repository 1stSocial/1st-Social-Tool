<?php

global $menu, $submenu;

if( !empty( $_POST["update"] ) ) {
	$this->update_sidemenu();
} elseif( !empty( $_POST["reset"] ) ) {
	$this->update_reset( 'sidemenu' );
}

$Data = $this->get_data( 'sidemenu' );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-draggable' , 'jquery-ui-droppable' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.css', array() , $this->Ver );

?>

<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Side Menu' , $this->ltd ); ?></h2>
	<p><?php _e( 'Please change the menu by drag and drop.' , $this->ltd ); ?></p>

	<form id="waum_setting_sidemenu" class="waum_form" method="post" action="">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field(); ?>

		<div class="metabox-holder columns-2" id="sidemenu-holder">

			<div id="postbox-container-1" class="postbox-container">
				<div class="postbox">
					<h3 class="hndle"><span><?php _e( 'The current menu' , $this->ltd ); ?></span></h3>
					<div class="inside">

						<?php if( empty( $Data ) ) : ?>

							<?php foreach($menu as $mm) : ?>

								<?php if( isset( $mm[2] ) && strstr( $mm[2] , 'separator' ) ) : ?>

									<?php $menu_title = '-'; ?>
									<?php $mm[2] = 'separator'; ?>
									<?php $mwsm = array(); ?>

								<?php elseif( !empty( $mm[0] ) ) : ?>
	
									<?php $menu_title = $mm[0]; ?>
									<?php if( !empty( $mm[5] ) ) : ?>
										<?php if( $mm[5] == 'menu-comments' ) : ?>
											<?php $menu_title = __( 'Comments' ); ?>
										<?php elseif( $mm[5] == 'menu-plugins' ) : ?>
											<?php $menu_title = __( 'Plugins' ); ?>
										<?php endif; ?>
									<?php endif; ?>

									<?php $mwsm = array(); ?>
									<?php foreach($submenu as $parent_slug => $sub) : ?>
										<?php foreach($sub as $sm) : ?>
											<?php if( $mm[2] == $parent_slug ) : ?>
												<?php $submenu_title = $sm[0]; ?>
												<?php if( $sm[1] == 'menu-comments' ) : ?>
													<?php $submenu_title = __( 'Comments' ); ?>
												<?php elseif( $sm[1] == 'menu-plugins' ) : ?>
													<?php $submenu_title = __( 'Plugins' ); ?>
												<?php elseif( $sm[1] == 'update_core' ) : ?>
													<?php $submenu_title = __( 'Update' ); ?>
												<?php endif; ?>
												<?php $mwsm[] = array( 'title' => $submenu_title , 'slug' => $sm[2] , 'parent_slug' => $parent_slug ); ?>
											<?php endif; ?>
										<?php endforeach; ?>
									<?php endforeach; ?>

								<?php endif; ?>

								<?php $menu_widget = array( 'title' => $menu_title , 'slug' => $mm[2] , 'parent_slug' => '' , 'new' => false , 'submenu' => $mwsm ); ?>
								<?php $this->menu_widget( $menu_widget ); ?>
	
							<?php endforeach; ?>

						<?php else: ?>

							<?php foreach($Data["main"] as $mm) : ?>

								<?php if( !empty( $mm["title"] ) ) : ?>

									<?php $mwsm = array(); ?>
									<?php foreach($Data["sub"] as $sm) : ?>

										<?php if( $mm["slug"] == $sm["parent_slug"] ) : ?>

											<?php $mwsm[] = array( 'title' => $sm["title"] , 'slug' => $sm["slug"] , 'parent_slug' => $sm["parent_slug"] ); ?>

										<?php endif; ?>

									<?php endforeach; ?>

									<?php $menu_widget = array( 'title' => $mm["title"] , 'slug' => $mm["slug"] , 'parent_slug' => '' , 'new' => false , 'submenu' => $mwsm ); ?>
									<?php $this->menu_widget( $menu_widget ); ?>

								<?php endif; ?>

							<?php endforeach; ?>

						<?php endif; ?>

					</div>
				</div>
			</div>

			<div id="postbox-container-2" class="postbox-container">
				<div class="postbox">
					<h3 class="hndle"><span><?php _e( 'Menu that can be added' , $this->ltd ); ?></span></h3>
					<div class="inside">

						<p class="description"><?php _e( 'Sepalator' , $this->ltd ); ?></p>
						<?php $menu_widget = array( 'title' => '-' , 'slug' => 'separator' , 'parent_slug' => '' , 'new' => true ); ?>
						<?php $this->menu_widget( $menu_widget ); ?>
						<div class="clear"></div>
						
						<?php foreach($this->Menu as $mm) : ?>

							<?php if( !empty( $mm[0] ) ) : ?>

								<?php $menu_title = $mm[0]; ?>
								<?php if( $mm[5] == 'menu-comments' ) : ?>
									<?php $menu_title = __( 'Comments' ); ?>
								<?php elseif( $mm[5] == 'menu-plugins' ) : ?>
									<?php $menu_title = __( 'Plugins' ); ?>
								<?php endif; ?>
								<p class="description"><?php echo $menu_title; ?></p>

								<?php foreach($this->SubMenu as $parent_slug => $sub) : ?>
		
									<?php foreach($sub as $sm) : ?>

										<?php if( $mm[2] == $parent_slug ) : ?>
											<?php $menu_title = $sm[0]; ?>
											<?php if( $sm[1] == 'menu-comments' ) : ?>
												<?php $menu_title = __( 'Comments' ); ?>
											<?php elseif( $sm[1] == 'menu-plugins' ) : ?>
												<?php $menu_title = __( 'Plugins' ); ?>
											<?php elseif( $sm[1] == 'update_core' ) : ?>
												<?php $menu_title = __( 'Update' ); ?>
											<?php endif; ?>
											<?php $menu_widget = array( 'title' => $menu_title , 'slug' => $sm[2] , 'parent_slug' => '' , 'new' => true , 'submenu' => '' ); ?>
											<?php $this->menu_widget( $menu_widget ); ?>
										<?php endif; ?>
		
									<?php endforeach; ?>
		
								<?php endforeach; ?>

								<div class="clear"></div>

							<?php endif; ?>

						<?php endforeach; ?>

					</div>

				</div>
			</div>

		</div>

		<div class="clear"></div>

		<p class="submit">
			<input type="submit" class="button-primary" name="update" value="<?php _e( 'Save' ); ?>" />
		</p>

		<p class="submit reset">
			<span class="description"><?php _e( 'Would initialize?' , $this->ltd ); ?></span>
			<input type="submit" class="button-secondary" name="reset" value="<?php _e('Reset'); ?>" />
		</p>

	</form>

</div>

<style>
#sidemenu-holder #postbox-container-1 .item-edit { background-image: url(<?php echo admin_url(); ?>images/arrows.png); }
#sidemenu-holder #postbox-container-1 .item-edit:hover { background-image: url(<?php echo admin_url(); ?>images/arrows-dark.png); }
</style>

<script type="text/javascript">
jQuery(document).ready(function($) {

	var $Form = $("#waum_setting_sidemenu");
	var $AddInside = $('#postbox-container-2 .postbox .inside', $Form);
	var $SettingInside = $('#postbox-container-1 .postbox .inside', $Form);

	$AddInside.children('.widget').draggable({
		connectToSortable: '#postbox-container-1 .postbox .inside',
		handle: '> .widget-top > .widget-title',
		distance: 2,
		helper: 'clone',
		zIndex: 5,
		containment: 'document',
		stop: function(e,ui) {
			widget_each();
		}
	});

	$SettingInside.live( "mouseover" , function() {
		$('#postbox-container-1 .postbox .inside, #postbox-container-1 .postbox .inside .widget .widget-inside .submenu', $Form).sortable({
			placeholder: "widget-placeholder",
			items: '> .widget',
			connectWith: "#postbox-container-1 .postbox .inside, #postbox-container-1 .postbox .inside .widget .widget-inside .submenu",
			handle: '> .widget-top > .widget-title',
			cursor: 'move',
			distance: 2,
			containment: 'document',
			change: function(e,ui) {
				var $height = ui.helper.height();
				$('#postbox-container-1 .postbox .inside .widget-placeholder').height($height);
			},
			stop: function(e,ui) {
				if ( ui.item.hasClass('deleting') ) {
					ui.item.remove();
				}
				widget_each();
			}
		});
	});

	$('#postbox-container-2', $Form).droppable({
		tolerance: 'pointer',
		accept: function(o){
			return $(o).parent().parent().parent().attr('id') != 'postbox-container-2';
		},
		drop: function(e,ui) {
			ui.draggable.addClass('deleting');
		},
		over: function(e,ui) {
			ui.draggable.addClass('deleting');
			$('div.widget-placeholder').hide();
		},
		out: function(e,ui) {
			ui.draggable.removeClass('deleting');
			$('div.widget-placeholder').show();
		}
	});


	var $AvailableAction = $('#postbox-container-1 .postbox .inside .widget .widget-top .widget-title-action a[href=#available]', $Form);
	$AvailableAction.live( 'click', function() {
		$(this).parent().parent().parent().children(".widget-inside").slideToggle();
		return false;
	});

	var $RemoveAction = $('#postbox-container-1 .postbox .inside .widget .widget-inside .widget-control-actions .alignleft a[href=#remove]', $Form);
	$RemoveAction.live( 'click', function() {
		$(this).parent().parent().parent().parent().slideUp("normal", function() { $(this).remove(); } );
		return false;
	});


	function widget_each() {
		var $Count = 0;
		$('#postbox-container-1 .postbox .inside .widget', $Form).each(function() {
			var $InputSlug = $(this).children(".widget-inside").children(".settings").children(".description").children(".slugtext");
			var $InputTitle = $(this).children(".widget-inside").children(".settings").children("label").children(".titletext");
			var $InputParentSlug = $(this).children(".widget-inside").children(".settings").children(".parent_slugtext");

			var $Name = 'data' + '['+$Count+']';
			$InputSlug.attr("name", $Name+'[slug]');
			$InputTitle.attr("name", $Name+'[title]');
			$InputParentSlug.attr("name", $Name+'[parent_slug]');

			if ( $(this).parent().parent().parent().parent().hasClass("submenu") ) {
				// None three
				$(this).remove();
			} else if ( $(this).parent().hasClass("submenu") ) {
				var $ParentSlug = $(this).parent().parent().children(".settings").children(".description").children(".slugtext").val();
				$InputParentSlug.val($ParentSlug);
			} else {
				$InputParentSlug.val('');
			}
			$Count++;
		});
	}
	widget_each();
		
});
</script>