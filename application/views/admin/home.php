<div class="navbar">
	<div class="menu-topbar">
		<div class="pull-left menu-logo">
			<a href="/">
				<img alt="logo" src="<?= base_url(); ?>assets/img/internal/logo_mini.png"/>
			</a>
		</div>
		<ul class="nav">
			<li class="<?= $this->uri->segment(1) == "home" ? "active" : ""; ?>"><a href="<?= base_url(); ?>index.php/admin/home">Home</a></li>
			<li class="dropdown <?= $this->uri->segment(1) == "board_controller" ? "active" : ""; ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Boards <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?= base_url(); ?>index.php/admin/home/index">Board Management</a></li>
					<li><a href="<?= base_url(); ?>index.php/admin/home/create_board">Create Board</a></li>
				</ul>
			</li>
			<?php if ($settings): ?>
				<li><?= $settings; ?></li>
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

