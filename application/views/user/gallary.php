  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/user/bootstrap_gal.css"/>
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-image-gallery.min.css"></link>   
    
     
<div id="test">
<div class="container-fluid">
 

     <div id="gallery1" data-toggle="modal-gallery" data-target="#modal-gallery">
         
                    <?php
                    $id = $val->id;
            if(is_dir('assets/css/user/content/'.$id))   
            { 
            $ar = scandir('assets/css/user/content/'.$id);    
            foreach ($ar as $img_name)
            if($img_name !='.' && $img_name !='..')
            {
                {?>
                    <a data-gallery="gallery" href="<?php echo base_url();?>assets/css/user/content/<?php echo $id."/".$img_name?>" title=""><img src="<?=base_url()?>assets/extra/resize.php?path=<?php echo base_url();?>assets/css/user/content/<?php echo  $id."/".$img_name?> &width=100 &height=100" ></a>
            <?} }}
                    ?>
    <br>
</div>
<!-- modal-gallery is the modal dialog used for the image gallery -->

<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="" style="margin-top: 0px!important;width: auto!important; height: auto!important;">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000">
            <i class="icon-play icon-white"></i>
            <span>Slideshow</span>
        </a>
        <a class="btn btn-info modal-prev">
            <i class="icon-arrow-left icon-white"></i>
            <span>Previous</span>
        </a>
        <a class="btn btn-primary modal-next">
            <span>Next</span>
            <i class="icon-arrow-right icon-white"></i>
        </a>
    </div>
</div>
</div>
</div>