<div class="navbar">
	<div class="menu-topbar">
		<div class="pull-left menu-logo">
			<a href="/">
				<img alt="logo" src="<?= base_url(); ?>assets/img/internal/logo_mini.png"/>
			</a>
		</div>
		<ul class="nav">
			<li class="active"><a href="#">Home</a></li>
			<li><a href="#">Link</a></li>
			<li><a href="#">Link</a></li>
		
			<?php if ($settings): ?>
				<li class="pull-right"><?= $settings; ?></li>
			<?php endif; ?>
		</ul>
		<div class="account-box pull-right">
			<span>Welcome <?= $username; ?>!</span>
			<a class="btn btn-inverse" href="home/logout"><i class="icon-off icon-white"></i> Logout</a>
		</div>
	</div>
</div>
<div class="row-fluid">
	<div class="span10 offset1">

