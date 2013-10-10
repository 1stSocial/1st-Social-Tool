<?php
//include '/dropdown.php';
?>

<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/create_board.js"></script>
<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>
<?php echo form_open_multipart(site_url("/admin/home/logo_image/")); ?>
<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  
    <div class="modal-dialog">
       <div id="load" class="loader"></div>
        <div id="fad">
        <div class="modal-content">
           
    <div class="modal-header">
         
        <h3 style="margin-left:33%;">Create Board</h3>
        <p> <? if (isset($success)) echo $success; ?> </p>
    </div>
    <div class="modal-body "><!-- Password input-->
        <div class="div_wrapper">

            
              <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-right: 5%;margin-top: 0.52%" class="control-label label label-info"  >Upload Images :</label>
                   <div>
               <div style="margin-left: 33%" class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img id="imgsrc" src="" /></div>
                        <div id="imgdiv" class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                        <span class="btn btn-file" style="margin-left: 0%!important;"><span id="btn select_btn" class="fileupload-new" style="margin-left: 0%!important;">Select image</span><span class="fileupload-exists">Change</span><input id="img" name="img" type="file" accept="image/jpg,image/jpeg,image/png,image/gif,image/bmp,image/tiff" onchange ="change_fun()"/></span>
                        <a style="margin-left: 0%!important;" href="#" class="btn fileupload-exists" id="clo" data-dismiss="fileupload">Remove</a>
                    </div><div id="img_msg" name="img_msg" style = "display:none">Warning : Please Select jpg image.</div>
                </div>

            
             <div>
             
 <?php echo form_label('Board Name:', 'name', array('class' => "control-label label label-info", 'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-right: 15.5%;margin-top: 0.52%;")); ?>
                     <div class="controls">
                <input required="" class="form-control" type="text" style="margin-left: 33%!important;width: 46%"  class = "control-label" placeholder="Board Name" id="name1" name="name" ><div style =" color: red; display: none;padding-left:43%" id="berror"> Enter Board Name </div>
            </div>
                 </div>
              <div style="margin-top: 5px"></div>
             <div>  
           <?php echo form_label('Board Title:', 'title', array('class' => "control-label label label-info", 'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-right: 17%;margin-top: 0.52%")); ?>
            <div class="controls">
                <input required="" class="form-control" type="text" style="margin-left: 33%!important;width: 46%"  class = "control-label" placeholder="Board Title" id="title1" name="title" ><div style =" color: red; display: none;padding-left:43%" id="terror"> Enter Board Title </div>
            </div>   
              </div>
              <div style="margin-top: 5px"></div>
            <div class="control-group">
                <?php echo form_label('Board Parent Tag:', 'parent_tag', array('class' => "control-label label label-info",'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;margin-right:10%")); ?>
                <div class="controls">
                    <select required="" multiple="" data-placeholder="Choose a Parent Tag..." tabindex="4" id="parentTag1" name="parentTag1" >
                        <option value="0"></option>
                        <? if (!empty($parenTag)): foreach ($parenTag as $key => $Tag): ?>
                                <option value="<?= $key ?>"><?= $Tag ?></option>
                            <?php endforeach;
                        endif; ?>
                    </select><div style =" color: red; display: none;padding-left:43%" id="perror"> Select Parent Tag </div>
                </div>
            </div>
            
             <div class="control-group">
                <?php echo form_label('Filterable Taxonomy:', 'taxo', array('class' => "control-label label label-info", 'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;margin-right:6.5%")); ?>
                <div class="controls">
                    <div id="select_box" style="width:451px;">
                        <select required="" data-placeholder="Choose a Filterable Taxonomy..."  tabindex="4" id="taxo" name="taxo" >
                        <option></option>
                    </select></div>
                </div>
            </div>
            <div style="clear: both"></div>
            <div class="control-group">
                <?php echo form_label('Select Theme:', 'theme', array('class' => "control-label label label-info", 'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;margin-right:14%")); ?>
                <div class="controls">
                    <select data-placeholder="Choose a Theme..."  tabindex="4" id="theme" name="theme" >
                        <option value="0"></option>
                        <option value="0">Default</option>
                        <? if (!empty($theme)): foreach ($theme as $Theme_val): ?>
                                <option value="<?= $Theme_val->id ?>"><?= $Theme_val->theme_name ?></option>
                            <?php endforeach;
                        endif; ?>
                    </select>
                </div>
            </div>
             <div style="clear: both"></div>
            <?php if($access_level == 'admin') :?>
            
            <div class="control-group">
                    <?php echo form_label('Domain :', 'domain', array('class' => "control-label label label-info", 'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-right: 5%;margin-top: 0.52%;margin-right:20%")); ?>
                                    <div class="controls">
                                        <select data-placeholder="Choose a Domain..."   tabindex="4" id="domain" name="user_id[]" required="please select Domain">
                                            <option value="0"></option>
                                            <? if (!empty($domain)): foreach ($domain as $val): ?>
                                                    <option value="<?= $val->id ?>"><?= $val->name ?></option>
                        <? endforeach;
                    endif; ?>
                    </select>
                </div>
            </div>
            <?php else : ?>
            <input type="hidden" value="<?php echo $domain;?>" id="domain">
            <?php endif;?>
            <div style="clear: both"></div>
            
</div></div>
    <div class="modal-footer ">
        <div class="control-group">
            <div class="div_wrapper" style="margin-left: 10%!important">
                <input type="submit"  id="add" name="add" class="btn btn-primary footer_btn" value="Create Board" onclick="" />
                <input type="button" class="btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn">
            </div>
        </div>     
        <input type ="hidden" id="ur" value="<?php echo site_url('/admin/home'); ?>">
        <input type="hidden" id="site" value="<?= site_url();?>">
    </div>
    </div>
       </div>
   </div>
    </div>
<?php echo form_close();?>
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
                jQuery('#file_upload').css('margin-left','33%');
                
                
	</script>