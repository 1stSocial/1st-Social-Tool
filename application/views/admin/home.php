<?php 

switch ($access_level) 
{
    case 'admin':
    {
        $domain_check = TRUE;
        $board_check = TRUE;
        $Tag_check = TRUE;
        $Taxonomy_check = TRUE;
        $Item_check =TRUE;
        $settings = TRUE;
    }
        break;
    case 'partner':
    {
        $domain_check = FALSE;
        $board_check = TRUE;
        $Tag_check = TRUE;
        $Taxonomy_check = TRUE;
        $Item_check =TRUE;
        $settings = TRUE;
    }
        break;
    case 'client':
    {
        $domain_check = FALSE;
        $board_check = FALSE;
        $Tag_check = FALSE;
        $Taxonomy_check = FALSE;
        $Item_check =TRUE;
        $settings = FALSE;
    }
        break;
    default:
        
        break;
}


?>

<!--test nav bar-->


<div class="navbar">
  <div class="navbar-inner">
    <div class="container">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target="#nav-collapse-01"></button>
      <a href="#" class="navbar-brand"><img alt="logo" src="<?= base_url(); ?>assets/img/internal/logo_mini.png"/></a>

      <div class="nav-collapse collapse in" id="nav-collapse-01">
        <ul class="nav">
          <?php if($domain_check) : ?>
                         <!--<li class="dropdown <?//= $this->uri->segment(1) == "board_controller" ? "active" : ""; ?>">-->
			<li class="active">
                      <a href="#">Domain <span class="navbar-unread">1</span></a>
				<ul>
                                    <li><a href="<?= base_url(); ?>index.php/admin/home/domain_management">Domain Management</a></li>
				   <li><a href="<?= base_url(); ?>index.php/admin/home/create_domin">Create Domain</a></li>
				</ul>
			</li>
                     <?php endif;?>  
                        
              <?php if($board_check) : ?>   
                        <li class="active">
				<a href="#" >Boards </a>
				<ul>
					<li><a href="<?= base_url(); ?>index.php/admin/home">Board Management</a></li>
					<li><a href="<?= base_url(); ?>index.php/admin/home/index/createbord">Create Board</a></li>
				</ul>
			</li>
                      <?php endif;?>
                        
              <?php if($Tag_check) : ?>
                         <!--<li class="dropdown <?//= $this->uri->segment(1) == "board_controller" ? "active" : ""; ?>">-->
		<li class="active">
                      <a href="#">Tag <span class="navbar-unread">2</span></a>
				<ul>
					<li><a href="<?= base_url(); ?>index.php/admin/home/tag_Management">Tag Management</a></li>
					<li><a href="<?= base_url(); ?>index.php/admin/home/tag_Management/createtag">Create Tag</a></li>
				</ul>
			</li>
                     <?php endif;?>   
              <?php if($Taxonomy_check) : ?>   
                        <li class="active">
				<a href="#">Taxonomy <span class="navbar-unread">3</span></a>
				<ul>
					<li><a href="<?= base_url(); ?>index.php/taxonomy/">Taxonomy Management</a></li>
					<li><a href="<?= base_url(); ?>index.php/taxonomy/index/addtaxonomy">Create Taxonomy</a></li>
				</ul>
			</li>  
                     <?php endif;?>          
                        
                      
                    <?php if($Item_check) : ?>    
                        <li class="active">
				<a href="#">Items <span class="navbar-unread">4</span></a>
				<ul >
					<li><a href="<?= base_url(); ?>index.php/admin/Item/">Items Management</a></li>
					<li><a href="<?= base_url(); ?>index.php/admin/Item/Add_item">Create Item</a></li>
				</ul>
			</li>
                    <?php endif;?>    
                       </ul>
          
           <ul class="nav pull-right">
                    <li class="divider"></li>
                    <li class="dropdown">
                   <?php if ($settings): ?>
				<a href="#" class="fui-gear"> <b class="caret"></b></a>
				<ul>
                                        <li><a href="<?= base_url(); ?>index.php/admin/new_user/">User Management</a></li>
					<li><a href="<?= base_url(); ?>index.php/admin/setting/index">Theme Management</a></li>
                                        <li><a href="<?= base_url(); ?>index.php/admin/setting/select_theme">Select Theme</a></li>
				</ul>
                                
                                </li>
			<?php endif; ?>
                               
                                    		<a class="btn btn-danger" href="<?= base_url(); ?>index.php/admin/home/logout"><i class="icon-off icon-white"></i> Logout</a>
                                </ul>
          		
      </div>
    </div>
	
		 
    </div>
</div>
<div class="main">
    
 
