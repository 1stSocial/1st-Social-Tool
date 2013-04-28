<div class="squarebanner ">
<div class="sidetitl clearfix">  <h3>Sponsors</h3> </div>
<ul>


<li>
<?php 
	$ban1 = get_option('job_banner1'); 
	$url1 = get_option('job_url1'); 
	$lab1 = get_option('job_lab1'); 
	$alt1 = get_option('job_alt1');
?>
<a href="<?php echo ($url1); ?> " title="<?php echo ($lab1); ?>"><img src="<?php echo ($ban1); ?>" alt="<?php echo ($alt1); ?>" style="vertical-align:bottom;" /></a>
</li>			

<li>
<?php 
	$ban2 = get_option('job_banner2'); 
	$url2 = get_option('job_url2'); 
	$lab2 = get_option('job_lab2'); 	
	$alt2 = get_option('job_alt2');
?>
<a href="<?php echo ($url2); ?>" title="<?php echo ($lab2); ?>"><img src="<?php echo ($ban2); ?>" alt="<?php echo ($alt2); ?>" style="vertical-align:bottom;" /></a>
</li>

<li>
<?php 
	$ban3 = get_option('job_banner3'); 
	$url3 = get_option('job_url3'); 
	$lab3 = get_option('job_lab3'); 
	$alt3 = get_option('job_alt3');	
?>
<a href="<?php echo ($url3); ?>" title="<?php echo ($lab3); ?>"><img src="<?php echo ($ban3); ?>" alt="<?php echo ($alt3); ?>" style="vertical-align:bottom;" /></a>
</li>

<li>
<?php 
	$ban4 = get_option('job_banner4'); 
	$url4 = get_option('job_url4');
	$lab4 = get_option('job_lab4'); 
	$alt4 = get_option('job_alt4');	
?>
<a href="<?php echo ($url4); ?>" title="<?php echo ($lab4); ?>"><img src="<?php echo ($ban4); ?>" alt="<?php echo ($alt4); ?>" style="vertical-align:bottom;" /></a>
</li>



</ul>
</div>