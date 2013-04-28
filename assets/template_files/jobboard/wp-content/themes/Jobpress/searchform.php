<div id="search">	
	<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<input type="text" name="s" id="s" value="Search ..." onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
<div class="selectt">	
	<select name="post_type">
		<option value="post">All Posts</option>
		<option value="job">All Jobs</option>
	</select>
</div>
	<input type="submit" id="searchsubmit" value="" />
</form>
</div>
<div class="clear"></div>