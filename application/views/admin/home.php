<div class="navbar">
	<div class="menu-topbar">
		<div class="pull-left menu-logo">
			<a href="/">
				<img alt="logo" src="<?= base_url(); ?>assets/img/internal/logo_mini.png"/>
			</a>
		</div>
		<ul class="nav">
                    <?php if($access_level == 'admin' || $access_level == 'partner') : ?>
			<li class="<?= $this->uri->segment(1) == "home" ? "active" : ""; ?>"><a href="<?= base_url(); ?>index.php/admin/home">Home</a></li>
			<li class="dropdown <?= $this->uri->segment(1) == "board_controller" ? "active" : ""; ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Boards <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?= base_url(); ?>index.php/admin/home">Board Management</a></li>
					<li><a href="<?= base_url(); ?>index.php/admin/home/index/createbord">Create Board</a></li>
				</ul>
			</li>
                        <li class="dropdown <?= $this->uri->segment(1) == "board_controller" ? "active" : ""; ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Tag <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?= base_url(); ?>index.php/admin/home/tag_Management">Tag Management</a></li>
					<li><a href="<?= base_url(); ?>index.php/admin/home/tag_Management/createtag">Create Tag</a></li>
				</ul>
			</li>
                        
                        <li class="dropdown <?= $this->uri->segment(1) == "board_controller" ? "active" : ""; ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Taxonomy <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?= base_url(); ?>index.php/taxonomy/">Taxonomy Management</a></li>
					<li><a href="<?= base_url(); ?>index.php/taxonomy/index/addtaxonomy">Create Taxonomy</a></li>
				</ul>
			</li>  
                        <?php endif;?>
                        <li class="dropdown <?= $this->uri->segment(1) == "board_controller" ? "active" : ""; ?>">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Items <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?= base_url(); ?>index.php/admin/Item/">Items Management</a></li>
					<li><a href="<?= base_url(); ?>index.php/admin/Item/Add_item">Create Item</a></li>
				</ul>
			</li>
                        
                        
			<?php if ($settings): ?>
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Setting<span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="<?= base_url(); ?>index.php/admin/setting/index">Theme Management</a></li>
                                        <li><a href="<?= base_url(); ?>index.php/admin/setting/select_theme">Select Theme</a></li>
				</ul>
                                </li>
			<?php endif; ?>
		</ul>
		<div class="account-box pull-right">
			<span>Welcome <?= $username; ?>!</span>
			<a class="btn btn-inverse" href="<?= base_url(); ?>index.php/admin/home/logout"><i class="icon-off icon-white"></i> Logout</a>
		</div>
	</div>
</div>
<div class="main">
    
 
