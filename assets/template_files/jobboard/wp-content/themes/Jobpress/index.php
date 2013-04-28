<?php
if(get_option('job_home') == "jobs") { ?>	
	<?php get_template_part('index', 'jobs'); ?> 
<?php } else { ?>
	<?php get_template_part('index', 'blog'); ?> 
<?php } ?>
