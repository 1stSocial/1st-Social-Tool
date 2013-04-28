<div id="right">

<!-- Sidebar widgets -->
<div class="sidebar">
<ul>
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar') ) : else : ?>
	<?php endif; ?>
</ul>
</div>
<div class="clear"></div>

<?php include (TEMPLATEPATH . '/sponsors.php'); ?>

</div>