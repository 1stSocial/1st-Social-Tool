<div class="menu-topbar row-fluid">
	<div class="pull-left menu-logo">
		<a href="/">
			<img alt="logo" src="<?= base_url(); ?>assets/img/internal/logo_mini.png"/>
		</a>
	</div>
	<div class="menu-nav pull-left">
		<div class="dropdown">
		<a class="dropdown-toggle" id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
		Dropdown
		<b class="caret"></b>
		</a>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			<li role="presentation"><a role="menuitem" tabindex="-1" href="http://google.com">Action</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="http://google.com">Action</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="http://google.com">Action</a></li>
		</ul>
		</div>
	</div>
	<?php if ($settings): ?>
		<div class="dropdown"><?= $settings; ?></div>
	<?php endif; ?>
	<div class="account-box pull-right">
		<span>Welcome <?= $username; ?>!</span>
		<a class="btn btn-inverse" href="home/logout"><i class="icon-off icon-white"></i> Logout</a>
	</div>
</div>
<div class="row-fluid">
	<div class="span10 offset1">

