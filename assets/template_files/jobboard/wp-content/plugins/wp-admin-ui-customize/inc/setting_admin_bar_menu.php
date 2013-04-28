<?php

if( !empty( $_POST["update"] ) ) {
	$this->update_admin_bar_menu();
} elseif( !empty( $_POST["reset"] ) ) {
	$this->update_reset( 'admin_bar_menu' );
}

$Data = $this->get_data( 'admin_bar_menu' );

// include js css
$ReadedJs = array( 'jquery' , 'jquery-ui-draggable' , 'jquery-ui-droppable' , 'jquery-ui-sortable' );
wp_enqueue_script( $this->PageSlug ,  $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.js', $ReadedJs , $this->Ver );
wp_enqueue_style( $this->PageSlug , $this->Dir . dirname( dirname( plugin_basename( __FILE__ ) ) ) . '.css', array() , $this->Ver );

?>

<div class="wrap">
	<div class="icon32" id="icon-tools"></div>
	<?php echo $this->Msg; ?>
	<h2><?php _e( 'Admin bar Menu' , $this->ltd ); ?></h2>
	<p><?php _e( 'Please change the menu by drag and drop.' , $this->ltd ); ?></p>
	<p><strong><?php _e( 'Notice: When you set up the same menu more, you will not display properly.' , $this->ltd ); ?></strong></p>
	<p class="description"><?php _e( 'can be more than one custom menu.' , $this->ltd ); ?></p>

	<form id="waum_setting_admin_bar_menu" class="waum_form" method="post" action="">
		<input type="hidden" name="<?php echo $this->UPFN; ?>" value="Y" />
		<?php wp_nonce_field(); ?>

		<div class="metabox-holder columns-2" id="admin_bar-holder">

			<div id="postbox-container-1" class="postbox-container">
				<div class="postbox">
					<div class="handlediv" title="Click to toggle"><br></div>
					<h3 class="hndle"><span><?php _e( 'Left' , $this->ltd ); ?></span></h3>
					<div class="inside">
						<?php if( empty( $Data ) ) : ?>

							<?php $ParentNode = array(); ?>
							<?php $ChildNode = array(); ?>
							<?php foreach( $this->Admin_bar as $node_id => $node ) : ?>

								<?php if( empty( $node->parent ) && $node_id != 'top-secondary' ) : ?>

									<?php $ParentNode[$node_id] = $node; ?>

								<?php endif; ?>

							<?php endforeach; ?>

							<?php foreach( $this->Admin_bar as $node_id => $node ) : ?>

								<?php if( !empty( $node->parent ) && $node->parent != 'top-secondary' ) : ?>

									<?php $ChildNode[$node->parent][] = $node; ?>

								<?php endif; ?>

							<?php endforeach; ?>

							<?php foreach( $ParentNode as $p_node_id => $p_node ) : ?>

								<?php $pnsn = array(); ?>
								<?php if( !empty( $ChildNode[$p_node_id] ) ) : ?>

									<?php foreach( $ChildNode[$p_node_id] as $key => $c_node ) : ?>

										<?php $pnsn[] = array( 'id' => $c_node->id , 'title' => $c_node->title , 'parent' => $p_node_id , 'href' => $c_node->href , 'group' => false , 'new' => false ); ?>
	
									<?php endforeach; ?>

								<?php endif; ?>

								<?php if( !empty( $pnsn ) ) : ?>

									<?php foreach( $pnsn as $key => $pnsn_node ) : ?>

										<?php if( !empty( $ChildNode[$pnsn_node["id"]] ) ) : ?>

											<?php foreach( $ChildNode[$pnsn_node["id"]] as $cs_node ) : ?>

												<?php $pnsn[] = array( 'id' => $cs_node->id , 'title' => $cs_node->title , 'parent' => $p_node_id , 'href' => $cs_node->href , 'group' => false , 'new' => false ); ?>

											<?php endforeach; ?>
										
										<?php endif; ?>
									
									<?php endforeach; ?>

								<?php endif; ?>

								<?php $menu_widget = array( 'id' => $p_node->id , 'title' => $p_node->title , 'parent' => '' , 'href' => $p_node->href , 'group' => false , 'new' => false , 'subnode' => $pnsn ); ?>

								<?php $this->admin_bar_menu_widget( $menu_widget ); ?>

							<?php endforeach; ?>

						<?php else : ?>

							<?php if( !empty( $Data["left"]["main"] ) ) : ?>

								<?php foreach($Data["left"]["main"] as $main_node) : ?>
	
									<?php $pnsn = array(); ?>
									<?php if( !empty( $Data["left"]["sub"] ) ) : ?>
										<?php foreach($Data["left"]["sub"] as $sub_node) : ?>
		
											<?php if( $main_node["id"] == $sub_node["parent"] ) : ?>
		
												<?php $pnsn[] = array( 'id' => $sub_node["id"] , 'title' => stripslashes( $sub_node["title"] ) , 'parent' => $main_node["id"] , 'href' => $sub_node["href"] , 'group' => false , 'new' => false ); ?>
		
											<?php endif; ?>
		
										<?php endforeach; ?>
									<?php endif; ?>
	
									<?php $menu_widget = array( 'id' => $main_node["id"] , 'title' => stripslashes( $main_node["title"] ) , 'parent' => '' , 'href' => $main_node["href"] , 'group' => false , 'new' => false , 'subnode' => $pnsn ); ?>
									<?php $this->admin_bar_menu_widget( $menu_widget ); ?>
	
								<?php endforeach; ?>
								
							<?php endif; ?>
						
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div id="postbox-container-2" class="postbox-container">
				<div class="postbox">
					<div class="handlediv" title="Click to toggle"><br></div>
					<h3 class="hndle"><span><?php _e( 'Right' , $this->ltd ); ?></span></h3>
					<div class="inside">

						<?php if( empty( $Data ) ) : ?>

							<?php $ParentNode = array(); ?>
							<?php $ChildNode = array(); ?>
							<?php foreach( $this->Admin_bar as $node_id => $node ) : ?>

								<?php if( !empty( $node->parent ) && $node->parent == 'top-secondary' ) : ?>

									<?php $ParentNode[$node_id] = $node; ?>

								<?php endif; ?>

							<?php endforeach; ?>

							<?php foreach( $this->Admin_bar as $node_id => $node ) : ?>

								<?php if( !empty( $node->parent ) && $node->parent == 'user-actions' ) : ?>

									<?php $ChildNode["my-account"][] = $node; ?>

								<?php endif; ?>

							<?php endforeach; ?>

							<?php foreach( $ParentNode as $p_node_id => $p_node ) : ?>

								<?php $pnsn = array(); ?>
								<?php if( !empty( $ChildNode[$p_node_id] ) ) : ?>

									<?php foreach( $ChildNode[$p_node_id] as $key => $c_node ) : ?>

										<?php $pnsn[] = array( 'id' => $c_node->id , 'title' => $c_node->title , 'parent' => $p_node_id , 'href' => $c_node->href , 'group' => false , 'new' => false ); ?>
	
									<?php endforeach; ?>
	
								<?php endif; ?>

								<?php $menu_widget = array( 'id' => $p_node->id , 'title' => $p_node->title , 'parent' => '' , 'href' => $p_node->href , 'group' => false , 'new' => false , 'subnode' => $pnsn ); ?>

								<?php $this->admin_bar_menu_widget( $menu_widget ); ?>

							<?php endforeach; ?>

						<?php else : ?>

							<?php if( !empty( $Data["right"]["main"] ) ) : ?>

								<?php foreach($Data["right"]["main"] as $main_node) : ?>
	
									<?php $pnsn = array(); ?>
									<?php if( !empty( $Data["right"]["sub"] ) ) : ?>

										<?php foreach($Data["right"]["sub"] as $sub_node) : ?>
		
											<?php if( $main_node["id"] == $sub_node["parent"] ) : ?>
		
												<?php $pnsn[] = array( 'id' => $sub_node["id"] , 'title' => stripslashes( $sub_node["title"] ) , 'parent' => $main_node["id"] , 'href' => $sub_node["href"] , 'group' => false , 'new' => false ); ?>
		
											<?php endif; ?>
		
										<?php endforeach; ?>
									<?php endif; ?>
	
									<?php $menu_widget = array( 'id' => $main_node["id"] , 'title' => stripslashes( $main_node["title"] ) , 'parent' => '' , 'href' => $main_node["href"] , 'group' => false , 'new' => false , 'subnode' => $pnsn ); ?>
									<?php $this->admin_bar_menu_widget( $menu_widget ); ?>
	
								<?php endforeach; ?>

							<?php endif; ?>
						
						<?php endif; ?>

					</div>
				</div>
			</div>

			<div class="clear"></div>

		</div>

		<div class="metabox-holder columns-1">

			<div class="postbox">
				<h3 class="hndle"><span><?php _e ( 'Menu that can be added' , $this->ltd ); ?></span></h3>
				<div class="inside">

					<p class="description">Custom Menu</p>
					<?php $menu_widget = array( 'id' => "custom_node" , 'title' => "" , 'parent' => '' , 'href' => "" , 'group' => false , 'new' => true , 'subnode' => false ); ?>
					<?php $this->admin_bar_menu_widget( $menu_widget ); ?>
					<div class="clear"></div>
					
					<p class="description" style="display: none;"><?php _e ( 'Menu that can be added' , $this->ltd ); ?></p>

					<h4><?php _e( 'Left' , $this->ltd ); ?><?php _e( 'Menus' ); ?></h4>

					<?php foreach( $this->Admin_bar as $node_id => $node ) : ?>

						<?php if( empty( $node->parent ) && $node_id != 'top-secondary' ) : ?>

							<?php // left parent menu ?>
							<?php $menu_widget = array( 'id' => $node->id , 'title' => $node->title , 'parent' => '' , 'href' => $node->href , 'group' => false , 'new' => true , 'subnode' => false ); ?>
							<p class="description"><?php echo $node_id; ?></p>
							<?php $this->admin_bar_menu_widget( $menu_widget ); ?>

							<?php foreach( $this->Admin_bar as $child_node_id => $child_node ) : ?>

								<?php if( $child_node->parent == $node_id ) : ?>

									<?php // left child menu ?>
									<?php if( !empty( $child_node->href ) ) : ?>
										<?php $menu_widget = array( 'id' => $child_node->id , 'title' => $child_node->title , 'parent' => '' , 'href' => $child_node->href , 'group' => false , 'new' => true , 'subnode' => false ); ?>
										<?php $this->admin_bar_menu_widget( $menu_widget ); ?>
									<?php endif; ?>

									<?php foreach( $this->Admin_bar as $child_sub_node_id => $child_sub_node ) : ?>
		
										<?php if( $child_sub_node->parent == $child_node_id ) : ?>

											<?php // left child sub menu ?>
											<?php if( !empty( $child_sub_node->href ) ) : ?>
												<?php $menu_widget = array( 'id' => $child_sub_node->id , 'title' => $child_sub_node->title , 'parent' => '' , 'href' => $child_sub_node->href , 'group' => false , 'new' => true , 'subnode' => false ); ?>
												<?php $this->admin_bar_menu_widget( $menu_widget ); ?>
											<?php endif; ?>

										<?php endif; ?>
		
									<?php endforeach; ?>

								<?php endif; ?>

							<?php endforeach; ?>

							<div class="clear"></div>

						<?php endif; ?>

					<?php endforeach; ?>
					
					<div class="clear"></div>

					<h4><?php _e( 'Right' , $this->ltd ); ?><?php _e( 'Menus' ); ?></h4>

					<?php foreach( $this->Admin_bar as $node_id => $node ) : ?>

						<?php if( $node->parent == 'top-secondary' ) : ?>

							<p class="description"><?php echo $node_id; ?></p>
							<?php $menu_widget = array( 'id' => $node->id , 'title' => $node->title , 'parent' => '' , 'href' => $node->href , 'group' => false , 'new' => true , 'subnode' => false ); ?>
							<?php $this->admin_bar_menu_widget( $menu_widget ); ?>
							
							<?php foreach( $this->Admin_bar as $child_node_id => $child_node ) : ?>

								<?php if( $child_node->parent == 'user-actions' ) : ?>
									<?php $menu_widget = array( 'id' => $child_node->id , 'title' => $child_node->title , 'parent' => '' , 'href' => $child_node->href , 'group' => false , 'new' => true , 'subnode' => false ); ?>
									<?php $this->admin_bar_menu_widget( $menu_widget ); ?>
								<?php endif; ?>

							<?php endforeach; ?>

							<div class="clear"></div>

						<?php endif; ?>

					<?php endforeach; ?>
					
					<div class="clear"></div>
					
					<?php foreach( $this->Admin_bar as $node_id => $node ) : ?>

						<?php if( !empty( $node->parent ) && $node->parent != 'top-secondary' && $node->id != 'user-info' && $node->id != 'user-actions' && $node->id != 'wp-logo-external' ) : ?>

							<?php $menu_widget = array( 'id' => $node->id , 'title' => $node->title , 'parent' => '' , 'href' => $node->href , 'group' => false , 'new' => true , 'subnode' => false ); ?>
							<?php //$this->admin_bar_menu_widget( $menu_widget ); ?>

						<?php endif; ?>

					<?php endforeach; ?>
					
					<div class="clear"></div>

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

<style>
#admin_bar-holder .item-edit { background-image: url(<?php echo admin_url(); ?>images/arrows.png); }
#admin_bar-holder .item-edit:hover { background-image: url(<?php echo admin_url(); ?>images/arrows-dark.png); }

#admin_bar-holder .postbox .inside .widget.wp-logo .widget-top .widget-title h4 .ab-icon,
#admin_bar-holder .postbox .inside .widget.updates .widget-top .widget-title h4 .ab-icon,
#admin_bar-holder .postbox .inside .widget.comments .widget-top .widget-title h4 .ab-icon,
#admin_bar-holder .postbox .inside .widget.new-content .widget-top .widget-title h4 .ab-icon
{ background-image: url(../wp-includes/images/admin-bar-sprite.png); }
</style>

<script type="text/javascript">
jQuery(document).ready(function($) {

	var $Form = $("#waum_setting_admin_bar_menu");
	var $AddInside = $('.columns-1 .postbox .inside', $Form);
	var $SettingInside = $('#admin_bar-holder .postbox .inside', $Form);

	$AddInside.children('.widget').draggable({
		connectToSortable: '#admin_bar-holder .postbox .inside',
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
		$('#admin_bar-holder .postbox .inside, #admin_bar-holder .postbox .inside .widget .widget-inside .submenu', $Form).sortable({
			placeholder: "widget-placeholder",
			items: '> .widget',
			connectWith: "#admin_bar-holder .postbox .inside, #admin_bar-holder .postbox .inside .widget .widget-inside .submenu",
			handle: '> .widget-top > .widget-title',
			cursor: 'move',
			distance: 2,
			containment: 'document',
			change: function(e,ui) {
				var $height = ui.helper.height();
				$('#admin_bar-holder .postbox .inside .widget-placeholder').height($height);
			},
			stop: function(e,ui) {
				if ( ui.item.hasClass('deleting') ) {
					ui.item.remove();
				}
				widget_each();
			}
		});
	});

	$('.columns-1', $Form).droppable({
		tolerance: 'pointer',
		accept: function(o){
			return $(o).parent().parent().parent().parent().parent().parent().parent().attr('class') != 'columns-1';
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


	var $AvailableAction = $('#admin_bar-holder .postbox .inside .widget .widget-top .widget-title-action a[href=#available]', $Form);
	$AvailableAction.live( 'click', function() {
		$(this).parent().parent().parent().children(".widget-inside").slideToggle();
		return false;
	});

	var $RemoveAction = $('#admin_bar-holder .postbox .inside .widget .widget-inside .widget-control-actions .alignleft a[href=#remove]', $Form);
	$RemoveAction.live( 'click', function() {
		$(this).parent().parent().parent().parent().slideUp("normal", function() { $(this).remove(); } );
		return false;
	});

	function widget_each() {
		var $Count = 0;
		$('#admin_bar-holder .postbox .inside .widget', $Form).each(function() {
			var $InputId = $(this).children(".widget-inside").children(".settings").children(".description").children(".idtext");
			var $InputLink = $(this).children(".widget-inside").children(".settings").children(".description").children(".linktext");
			var $InputTitle = $(this).children(".widget-inside").children(".settings").children("label").children(".titletext");
			var $InputParentName = $(this).children(".widget-inside").children(".settings").children(".parent");

			var $BoxName = "";
			if( $(this).parent().hasClass("submenu") ) {
				$BoxName = $(this).parent().parent().parent().parent().parent().parent().attr("id");
			} else {
				$BoxName = $(this).parent().parent().parent().attr("id");
			}
			var $BarType = '';
			if( $BoxName == 'postbox-container-1' ) {
				$BarType = 'left';
			} else if( $BoxName == 'postbox-container-2' ) {
				$BarType = 'right';
			}

			if( $(this).hasClass("custom_node") ) {
				var $CustomVal = $InputId.val();
				$InputId.val( $CustomVal + Math.ceil( Math.random() * 1000 ) );
			}

			var $Name = 'data' + '[' + $BarType + ']['+$Count+']';
			$InputId.attr("name", $Name+'[id]');
			$InputLink.attr("name", $Name+'[href]');
			$InputTitle.attr("name", $Name+'[title]');
			$InputParentName.attr("name", $Name+'[parent]');

			if ( $(this).parent().parent().parent().parent().hasClass("submenu") ) {
				// None three
				$(this).remove();
			} else if ( $(this).parent().hasClass("submenu") ) {
				var $ParentId = $(this).parent().parent().children(".settings").children(".description").children(".idtext").val();
				$InputParentName.val($ParentId);
			} else {
				$InputParentName.val('');
			}

			$Count++;
		});
	}
	widget_each();
		
});
</script>