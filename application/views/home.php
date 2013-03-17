<div class="menu-topbar row-fluid">
	<div class="pull-left menu-logo">
		<a href="/">
			<img alt="logo" src="<?= base_url(); ?>assets/img/internal/logo_mini.png"/>
		</a>
	</div>
	<?= $settings; ?>
	<div class="account-box pull-right">
		<span>Welcome <?= $username; ?>!</span>
		<a class="btn btn-inverse" href="home/logout"><i class="icon-off icon-white"></i> Logout</a>
	</div>
</div>
<div class="row-fluid">
	<div class="span10 offset1">

