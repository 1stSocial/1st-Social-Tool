<div class="container-fluid">
    
     <div id="gallery1" data-toggle="modal-gallery" data-target="#modal-gallery">
         
         <?php
         if (is_array($item) && !empty($item)):
            foreach ($item as $val) :
            $str = $val['body'];
             preg_match_all('/\< *[img][^\>]*[src] *= *[\"\']{0,1}([^\"\']*)/i', $val['body'], $all_img);
                     foreach ($all_img['1'] as $match) {
                       preg_match_all('#[-a-zA-Z0-9@:%_\+.~\#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~\#?&//=]*)?#si', $match, $result);
                         if(isset($result['0']['0']))
                         {
                            ?>  
         <a data-gallery="gallery" href=<?php echo $match;?> title=""><img src="<?=base_url()?>assets/extra/resize.php?path=<?php echo $match;?> &width=100 &height=100" ></a>
                    <?php
                         }}
                        endforeach;
                    endif;
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