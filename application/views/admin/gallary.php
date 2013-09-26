<!--<link rel="stylesheet" href="<?= base_url(); ?>assets/css/user/bootstrap_gal.css"/>-->
<link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap-image-gallery.min.css"></link>   


<div id="test">
    <div class="container-fluid">


        <div id="gallery1" data-toggle="modal-gallery" data-target="#modal-gallery">

            <?php
            $id = $name;

            if (is_dir('assets/css/user/content/' . $id)) {
                $ar = scandir('assets/css/user/content/' . $id);
                $i = 1;
                foreach ($ar as $img_name) {
                    if ($img_name != '.' && $img_name != '..') { {
                            ?>
                            <div id='img_<?= $i ?>' style="position:relative;float:left;padding:10px">
                                <img src="<?= base_url() ?>assets/extra/resize.php?path=<?php echo base_url(); ?>assets/css/user/content/<?php echo $id . "/" . $img_name ?> &width=100 &height=100" >
                                <div style='position:absolute;top:5px;left:96px'>   <a  href="javascript:deletbox('<?php echo site_url('/admin/Item/delete_image/' . $img_name . '/' . $id) ?>','<?= $i ?>')" ><img src="<?php echo base_url(); ?>assets/img/remove.png"  height="25px" width="25px"></a>
                                </div> </div>
            <?
            }
        }
        $i++;
    }
}
?>
            <br>
        </div>
        <!-- modal-gallery is the modal dialog used for the image gallery -->

        <div id="modal-gallery" class="modal modal-gallery hide" tabindex="" style="width: auto!important; height: auto!important;">
            <div class="modal-header">
                <a id="btn_close_cl" class="close" data-dismiss="modal">&times;</a>
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
                <a class="btn btn-danger" href="javascript:deletbox('<?php echo site_url('/admin/Item/delete_image/' . $img_name . '/' . $id) ?>','<?= $img_name ?>')">
                    <span>Delete</span>
                </a>
            </div>
        </div>
    </div>
</div>
<script>
    function deletbox(urllink, name_t)
    {



        bootbox.confirm('Are you sure?', function(val) {
            if (val) {
                $.ajax({
                    type: "POST",
                    url: urllink,
                    success: function(res) {
                        if (res == "")
                        {
                            var idv = "#img_" + name_t;
                            $(idv).hide();
                            // document.getElementById("img_"+name_t).innerHTML = "";
                            $('#btn_close_cl').click();

                        }
                    }
                });
            }
        });
    }
</script>