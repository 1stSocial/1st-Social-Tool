<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/item_fill.js"></script>
<style>
#progress {display: none;position:relative; width:250px;z-index: 11; border: 1px solid #ddd; padding: 1px; border-radius: 3px;margin-top: 1.5%;float: right;margin-right: 47%}
#bar { background-color: #2980B9; width:0%; height:20px; border-radius: 3px; }
#percent { position:absolute; display:inline-block; top:3px; left:48%; }
</style>
<!--<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">-->
        
    <?php echo form_open_multipart(site_url("/admin/Item/test/")); ?>
<div>


<div id="load" class="loader"></div>
        <div id="fad">
<div class="header" style="margin-left  : 40%">
        <input class="form-control" type="hidden" value='<?= $board_id; ?>' id="bord_id" name='bord_id'>
        <h3>Add Item <?= $board_name ?></h3> 
        <input type="hidden" value="<?=$parent_tag;?>" id='tag_id'>
    </div>
<div class="container">
        <div class="control-group">
            <div class="controls">
                <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%" class="control-label label label-info"  >Upload Image :</label>
                <div style='magrin-top:33px;padding-left:20%;'>
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img id="imgsrc" src="" /></div>
                        <div id="imgdiv" class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                        <span class="btn btn-file"><span id="select_btn" class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input id="img" name="img" type="file" accept="image/jpg,image/jpeg,image/png,image/gif,image/bmp,image/tiff" onchange ="change_fun()"/></span>
                        <a href="#" onclick="rem()" class="btn fileupload-exists" id="clo" data-dismiss="fileupload">Remove</a>
                        <div id="progress" style="display: none;position:relative; width:250px;z-index: 11; border: 1px solid #ddd; padding: 1px; border-radius: 3px;margin-top: 1.5%;float: right;margin-right: 47%">
                        <div id="bar"></div>
                        <div id="percent"></div >
                </div>
                    </div><div id="img_msg" name="img_msg" style = "display:none;float: left">Warning : Please Select jpg image.</div>
                </div>
                
            </div>
        </div>
    
     <div style="clear: both;margin: 1%"></div>
    <div id='tagdiv' >
        <?php 
        foreach ($abc as $value) {?>
            <input type="hidden" id='abc' name="abc[]" value="<?=$value?>">
        <?

        }?>
            </div>
    
        <div class="control-group">
            <div class="controls">
                <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;" class="control-label label label-info"  >Title :</label>
                <div style='magrin-top:33px;padding-left:20%;'><input type="text" id="item_title" name="title" class="form-control" style="width: 90%"></div>
            </div>
        </div>
        
          <div style="clear: both;margin: 1%"></div>
        <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%" class="control-label label label-info"  >call to action :</label>
        <div style='magrin-top:33px;padding-left:20%;'>
            <input type="text" class="form-control" style="width:90%" name="call_to_action" id ="call_to_action"/>
        </div>
     
    <div style="clear: both;margin: 1%"></div>
    
        <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;" class="control-label label label-info">Body :</label>
        <div style="width: auto;height: auto; overflow: scroll; margin-left: 20%;margin-right: 6%">
            <textarea id="body1" name="body1" ></textarea>
        </div>
        <div style="clear: both;margin: 1%"></div>
        <div class="controls" id="taxonomydiv" style="margin-top: 8px">
            <div id="taxodiv">
                <? if (!empty($Taxonomy)): foreach ($Taxonomy as $val): if($val->type != 'Status') :?>
                        <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;" class="control-label label label-info" ><?= $val->name ?> :</label>
                        <div style='magrin-top:33px;padding-left:20%;'>
                            <input type="text" style="float:left;width: 90%;" class="form-control" id="<?= $val->id ?>" name="taxo"/>
                            <input type="hidden" value="<?= $val->id ?>" id="taxoid"/><div id="<?= $val->id ?>"></div>
                            <div style="clear: both"></div>
                        </div>
                        <div style="clear: both;margin: 1%"></div>
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
                <? if (!empty($Taxonomy)): foreach ($Taxonomy as $val): if($val->type == 'Status') :?>
                <option value="<?=$val->value?>"><?=$val->name?></option>
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
       <!--image upload-->
       
       <div id="image_div">
           
       </div>
       
       <div style="clear: both"></div>
       <input type="hidden" id="image" value=""/>
        <div class="control-group div_wrapper">
            <input type="hidden" id ="url_temp" name="temp" value="<?php echo site_url("/admin/Item/insert_item/"); ?>">
            <input id="btn_sub" type="submit" style="display: none"  value="Create Item"/>
            <input type="button" style="margin-left: 27%" class="btn btn-primary footer_btn" value="Create Item" onclick="savefun()"/>
            <input type="button" class="btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn" onclick="_close()">
        </div>
   
    <input type="hidden" value="<?= site_url(); ?>" id="url">
</div>
            </div>
<script type="text/javascript">
    
		
		$(function() {
             
//                alert(temp);
                var base = $('#base').val();
                 var dataval = {
            name: <?php echo $timestamp;?>,
            id:""
        };
			$('#file_upload').uploadify({
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
                                        'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'      : base +'assets/extra/uploadify.swf',
				'uploader' : base +'assets/extra/uploadify.php',
                              'onUploadSuccess' : function(file, data, response) {
                                        $.ajax({
                                                type: "POST",
                                                url: './gallery',
                                                data:dataval,
                                                success: function(res) {
                                                   $('#image_div').html(res);
                                               }
                                                }); 
                                     
                                
			}
		});
              }); 
               
	</script>