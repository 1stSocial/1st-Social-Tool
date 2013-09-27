<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/item_edit.js"></script>

<?php echo form_open_multipart(site_url("/admin/Item/test/")); ?>

<div class="header" style="margin-left: 40%">
    <h3>Edit Item <?= $item['0']['name'] ?></h3>
</div>
<div class="container"> 

      <div class="control-group">
            <div class="controls">
                <label style=" float: left;" class="control-label"  >Upload Image :</label>
                <div style='magrin-top:33px;padding-left:20%;'>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img id="imgsrc" src="<?php echo base_url() . '/' . $item['0']['image']; ?>" /></div>
                        <div id="imgdiv" class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                        <span class="btn btn-file"><span id="select_btn" class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input id="img" name="img" type="file" accept="image/jpg,image/jpeg,image/png,image/gif,image/bmp,image/tiff" onchange ="change_fun()"/></span>
                        <a href="#" class="btn fileupload-exists" id="clo" data-dismiss="fileupload">Remove</a>
                    </div><div id="img_msg" name="img_msg" style = "display:none">Warning : Please Select jpg image.</div>
                </div>
            </div>
        </div>
<!--    <div class="control-group">
        <div class="controls">
            <label style=" float: left;" class="control-label"  >Name :</label>
            <div style='magrin-top:33px;padding-left:20%;'><input style="width: 90%" type="text" name="name" id="name" class="control-label" value="<?= $item['0']['name'] ?>"></div>
        </div> 
    </div>-->
    <div class="control-group">
        <div class="controls">
            <label style="float: left;" class="control-label" >Title :</label>
            <div style='magrin-top:33px;padding-left:20%;'><input style="width: 90%" type="text" name="title" id="title" class="control-label" value="<?= $item['0']['title'] ?>" ></div>
        </div>
    </div>
    <div class="control-group">
        <div class="controls">
            <label style="float: left;" class="control-label " >body :</label>
            <div style="width: auto;height: auto; overflow: scroll; margin-left: 20%;margin-right: 6%">
                <textarea id="body" name="body"><?= $item['0']['body'] ?></textarea>
                <input type="hidden" value="<?= $item['0']['item_id'] ?>" name="id" id="item_id">
            </div>
        </div>
    </div>
    <div class="controls" id="maintaddiv">
        <div id="taddiv">
            <?php
            $selectArr = array();

            foreach ($Tag['Parent'] as $data):
                ?>
                <div style='magrin-top:33px;padding-top:8px;'>
                    <label class="control-label" style="float: left;width:20%"> <?= $data['name']; ?>  </label>
                    <select data-placeholder='Choose...' class=chosen-select multiple  style='width:350px;' id = '<?= $data['tag_id'] ?>' name=tag[]>
                        <?php if (!empty($Tag['child'])): foreach ($Tag['child'] as $val): if ($val['parent_tag_id'] == $data['tag_id']): ?>
                                    <?php
                                    var_dump($item);
                                    foreach ($item as $maindata): if ($maindata['tag_id'] == $val['tag_id']):
                                            $selectArr[] = $val['tag_id'];
                                            ?>
                                            <option value='<?= $val['tag_id'] ?>' selected="selected"><?= $val['name'] ?></option> 
                                        <?php else : ?>
                                        <?php
                                        endif;
                                    endforeach;

                                    if (!in_array($val['tag_id'], $selectArr)):
                                        ?>

                                        <option value='<?= $val['tag_id'] ?>'><?= $val['name'] ?></option>

                                    <?php
                                    endif;
                                endif;
                            endforeach;
                        endif;
                        ?> 
                    </select>
<?php endforeach; ?> 

            </div>
        </div>
    </div>    

    <div class="controls" id="taxonomydiv">
        <div id="taxodiv" style="padding-top: 5px">
            <? if (!empty($Taxonomy)): foreach ($Taxonomy as $val): ?>
                    <label style=" float: left;" class="control-label" ><?= $val['name'] ?> :</label>
                    <div style='magrin-top:33px;padding-left:20%;'><input type="text" style="float:left;width:90%" class="control-label" id="<?= $val['id'] ?>" name="taxo" value="<?= $val['ival'] ?>"/><input type="hidden" value="<?= $val['id'] ?>" id="taxoid"/><div id="<?= $val['id'] ?>d"></div><div style="clear: both"></div></div>
    <?php endforeach;
endif;
?>

        </div>    
    </div>
     <label style=" float: left;" class="control-label"  >Upload Gallery Images :</label>
<form>
                             <div id="queue"></div>
                             <input id="file_upload" name="file_upload" type="file" multiple="true">
                             <input id='base' type="hidden" value="<?php echo base_url();?>">
                             <?php $timestamp = time();
                             ?>
                             <input id='folder_name' type="hidden" value="<?php echo $timestamp;?>">
                     </form>
  <div id="image_div">
           <?php
           if(isset($image_div))
           {
               echo $image_div;
           }
           ?>
       </div>
        <div class="control-group div_wrapper">
            <input type="hidden" id ="url_temp" name="temp" value="<?php echo site_url("/admin/Item/update_item/"); ?>">
            <input type="submit" style="margin-left: 27%" class="btn btn-primary footer_btn" value="Update Item" onclick="//savefun('<?php // echo site_url("/admin/item/update_item/");  ?>')" />
            <input type="button" class="close btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn" onclick="_close();">
        </div>
   
    <input type="hidden" value="<?= site_url(); ?>" id="url">
</div></form></div>
<script>
    $('#redactor_upload_btn').click(function () {
                            alert('shfkj');
                         });
</script>
<script type="text/javascript">
    
		
		$(function() {
             
               
                var base = $('#base').val();
                var id = $('#item_id').val();
           
        var dataval = {
            id: id,
            name:""
        };
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : id,
                                        'token'     : id,
                                       'id': id
				},
				'swf'      : base +'assets/extra/uploadify.swf',
				'uploader' : base +'assets/extra/uploadify.php',
                              'onUploadSuccess' : function(file, data, response) {
                                   
                                        $.ajax({
                                                type: "POST",
                                                url: '../gallery',
                                                data:dataval,
                                                success: function(res) {
                                                 $('#image_div').html(res);
                                               }
                                                }); 
                                     
                              
			}
		});
              }); 
                
	</script>