<div id="right">
<?php include (TEMPLATEPATH . '/searchform.php'); ?>	
	
<!-- Sidebar widgets -->
<div class="sidebar">
<ul>
	<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar') ) : else : ?>
	<?php endif; ?>
</ul>
</div>
	<?php include (TEMPLATEPATH . '/sponsors.php'); ?>	
</div>