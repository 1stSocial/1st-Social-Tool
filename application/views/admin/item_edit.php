<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/item_edit.js"></script>
<style>
#progress {display: none;position:relative; width:250px;z-index: 11; border: 1px solid #ddd; padding: 1px; border-radius: 3px;margin-top: 1.5%;float: right;margin-right: 47%}
#bar { background-color: #2980B9; width:0%; height:20px; border-radius: 3px; }
#percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>
<?php echo form_open_multipart(site_url("/admin/Item/test/")); ?>
<div id="load" class="loader"></div>

        <div id="fad">
<div class="header" style="margin-left: 40%">
    <h3>Edit Item <?= $item['0']['name'] ?></h3>
</div>
<div class="container"> 
    
      <div class="control-group">
            <div class="controls">
                <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%" class="control-label label label-info"  >Upload Image :</label>
                <div style='magrin-top:33px;padding-left:20%;'>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img id="imgsrc" src="<?php echo base_url() . '/' . $item['0']['image']; ?>" /></div>
                        <div id="imgdiv" class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                        <span class="btn btn-file"><span id="select_btn" class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input id="img" name="img" type="file" accept="image/jpg,image/jpeg,image/png,image/gif,image/bmp,image/tiff" onchange ="change_fun()"/></span>
                        <a href="#" class="btn fileupload-exists" id="clo" data-dismiss="fileupload">Remove</a>
                        <div id="progress" style="display: none;position:relative; width:250px;z-index: 11; border: 1px solid #ddd; padding: 1px; border-radius: 3px;margin-top: 1.5%;float: right;margin-right: 47%">
                        <div id="bar"></div>
                        <div id="percent"></div >
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
               <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;" class="control-label label label-info"  >Title :</label>
             <div style='magrin-top:33px;padding-left:20%;'><input style="width: 90%" type="text" name="title" id="title" class="form-control" value="<?= $item['0']['title'] ?>" ></div>
        </div>
    </div>
      <div style="clear: both;margin: 1%"></div>
      <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%" class="control-label label label-info"  >call to action :</label>
        <div style='magrin-top:33px;padding-left:20%;'>
            <input type="text" class="form-control" style="width:90%" name="call_to_action" id ="call_to_action" value="<?= $item['0']['call_to_action'] ?>" >
        </div>
     
    <div style="clear: both;margin: 1%"></div>
<div class="control-group">
        <div class="controls">
            <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;" class="control-label label label-info">Body :</label>
         <div style="width: auto;height: auto; overflow: scroll; margin-left: 20%;margin-right: 6%">
                <textarea id="body" name="body"><?= $item['0']['body'] ?></textarea>
                <input type="hidden" value="<?= $item['0']['item_id'] ?>" name="id" id="item_id">
            </div>
        </div>
    </div>
       <div style="clear: both;margin: 1%"></div>
    <div class="controls" id="maintaddiv">
        <div id="taddiv">
            <?php
            $selectArr = array();
          if($Tag != "")
          {
            foreach ($Tag['Parent'] as $data):
                ?>
                <div style='magrin-top:33px;padding-top:8px;'>
                     <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;" class="control-label label label-info" ><?= $data['name']; ?> :</label>
                       
                    <!--<label class="control-label" style="float: left;width:20%"> <?= $data['name']; ?>  </label>-->
                    <div style='magrin-top:33px;padding-left:20%;'>
                     <select data-placeholder='Choose...' class="chosen-select" multiple  style='width:350px;' id = '<?= $data['tag_id'] ?>' name=tag[]>
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
                        </div>
          <?php endforeach;} ?> 

             </div>
        </div>
    </div>    
 
<!--    <div class="controls" id="taxonomydiv">
        <div id="taxodiv" style="padding-top: 5px">
            <? if (!empty($Taxonomy)): foreach ($Taxonomy as $val): ?>
                    <label style=" float: left;" class="control-label" ><?= $val['name'] ?> :</label>
            <div style="clear: both;margin: 1%"></div>
                     <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;" class="control-label label label-info" ><?= $val['name'] ?> :</label>
                       
                    <div style='magrin-top:33px;padding-left:20%;'><input type="text" style="float:left;width:90%" class="form-control" id="<?= $val['id'] ?>" name="taxo" value="<?= $val['ival'] ?>"/><input type="hidden" value="<?= $val['id'] ?>" id="taxoid"/><div id="<?= $val['id'] ?>d"></div><div style="clear: both"></div></div>
    <?php endforeach;
endif;
?>

        </div>    
    </div>
    <div style="clear: both;margin: 1%"></div>
        <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%" class="control-label label label-info"  >Item status :</label>
        <div style='magrin-top:33px;padding-left:20%;'>
            <select class="chosen-select" id="status" name="status" style="width: 25%">
               
                <option <?php if($item['0']['status'] == 1) echo 'selected' ?> value="1">Open</option>
                <option <?php if($item['0']['status'] == 0) echo 'selected' ?> value="0">Close</option>
            </select>
        </div>-->

 <div class="controls" id="taxonomydiv" style="margin-top: 8px">
            <div id="taxodiv">
                <? if (!empty($Taxonomy)): foreach ($Taxonomy as $val): if($val['type'] != 'Status') : ?>
<!--                        <label style=" float: left;" class="control-label" ><?= $val['name'] ?> :</label>-->
            <div style="clear: both;margin: 1%"></div>
                     <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;" class="control-label label label-info" ><?= $val['name'] ?> :</label>
                       
                    <div style='magrin-top:33px;padding-left:20%;'><input type="text" style="float:left;width:90%" class="form-control" id="<?= $val['id'] ?>" name="taxo" value="<?= $val['ival'] ?>"/><input type="hidden" value="<?= $val['id'] ?>" id="taxoid"/><div id="<?= $val['id'] ?>d"></div><div style="clear: both"></div></div>
                        <?php
                               endif;
                    endforeach;
                endif;
                ?>
            </div>
        </div>
       <!--  image upload  -->
      <div style="clear: both;margin: 1%"></div>
        <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%" class="control-label label label-info"  >Item status :</label>
        <div style='magrin-top:33px;padding-left:20%;'>
            <select class="chosen-select" id="status" name="status" style="width: 25%">
                <? if (!empty($taxonomy_val)): foreach ($taxonomy_val as $val): if($val->type == 'Status') :?>
                <option value="<?=$val->value?>" <?php if($val->value == $item['0']['status']) echo 'selected'?> ><?=$val->name?></option>
                  <?php
                               endif;
                    endforeach;
                endif;
                ?>
                <!--<option value="0">Close</option>-->
            </select>
        </div>

         
  <div style="clear: both;margin: 1%"></div>
     <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%" class="control-label label label-info"  >Upload Gallery Images :</label>
               
<form>
                             <div id="queue"></div>
                             <input id="file_upload" name="file_upload" type="file" multiple="true">
                             <input id='base' type="hidden" value="<?php echo base_url();?>">
                             <?php $timestamp = time();
                             ?>
                             <input id='folder_name' type="hidden" value="<?php echo $timestamp;?>">
                     </form>
        <div style="margin-left: 19%" id="image_div">
           <?php
           if(isset($image_div))
           {
               echo $image_div;
           }
           ?>
       </div>
     <div style="clear: both"></div>
     <input type="hidden" id="image" value="<?=$item['0']['image'];?>"/>
        <div class="control-group div_wrapper">
            <input type="hidden" id ="url_temp" name="temp" value="<?php echo site_url("/admin/Item/update_item/"); ?>">
             <input id="btn_sub" type="submit" style="display: none"  value="Create Item"/>
             <input type="button" style="margin-left: 27%" class="btn btn-primary footer_btn" value="Update Item" onclick="savefun()" />
            <input type="button" class="btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn" onclick="_close();">
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