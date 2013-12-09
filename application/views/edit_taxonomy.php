<?php
//include '/admin/dropdown.php';
?><?php echo form_open_multipart(site_url("/admin/home/logo_image/")); ?>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/edit_taxonomy.js"></script>

<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>

<input type="hidden" id="id" value="<?php echo $id; ?>" name="id" >
<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
     <div class="modal-dialog">
          <div id="load" class="loader"></div>
        <div id="fad">
        <div class="modal-content"> 
    <div class="modal-header">
        <h3 style="margin-left:33%">Edit Taxonomy</h3>
        <p> <? if (isset($success)) echo $success; ?> </p>
    </div>
    <div class="modal-body div_wrapper"><!-- Password input--> 
        <div class="control-group">
           <?php echo form_label('Name:', 'name', array("class"=>"control-label label label-info", 'style' => " float: left;padding: 0.6em 0.7em 0.7em;margin-right: 5%;margin-top: 0.52%")); ?> 
             <div class="controls" style="float:left;">
                <input type="text" class="form-control" style="margin-left: 55px;width: 95%"  class = "control-label" value="<?php
                if (isset($name)) {
                    echo $name;
                }
                ?>" name="name" id="name" >
            </div> <div style =" color: red; display: none;padding-left:43%;clear: both;" id="taxoname"> Enter Taxonomy Name </div>
        </div> 
         <div style="clear: both;margin: 9%"></div>
        <div class="control-group">
 <?php echo form_label('Type:', 'type', array("class"=>"control-label label label-info", 'style' => "float: left;padding: 0.6em 0.7em 0.7em;margin-right: 4%;margin-top: 0.52%")); ?>
                      <div class="controls">
                <select data-placeholder="Choose a Type..." class="chosen-select"  style="width:350px;" tabindex="4" id="type" name="type" style="margin-left: 60px;">
                    <?php if($type=='Select') {?>
                    <option selected value="select">Select</option>
                    <?}else{?>
                    <option value="select">Select</option>
                    <?}?>
                    <?php if($type=='string') {?>
                    <option selected value="string">String</option>
                    <?}else{?>
                    <option value="string">String</option>
                    <?}?>
                    <?php if($type=='Integer') {?>
                    <option selected value="Integer">Integer</option>
                    <?}else{?>
                    <option value="Integer">Integer</option>
                    <?}?>
                    <?php if($type=='html') {?>
                    <option selected value="html">html</option>
                    <?}else{?>
                    <option value="html">html</option>
                    <?}?>
                    <?php if($type=='Status') {?>
                    <option selected value="Status">Status</option>
                    <?}else{?>
                    <option value="Status">Status</option>
                    <?}?>
                </select><div style =" color: red; display: none;padding-left:43%" id="type_error"> Select Taxonomy Type </div>
            </div>
        </div>    
<div style="clear: both;margin: 8px"></div>
        <div class="control-group">
 <?php echo form_label('Parent Tag:', 'parent_tag',  array("class"=>"control-label label label-info", 'style' => "float: left;padding: 0.6em 0.7em 0.7em;margin-right:5.4%;margin-top: 0.52%")); ?>
                      <div class="controls">
                          <select multiple="" data-placeholder="Choose a Parent..." class="chosen-select mar"  style="width:350px;" tabindex="4" id="parentTag2" name="parentTag2"  style="margin-left: 22px;">
                    <option value="0">Select</option>
                    <? if (!empty($parenTag)): foreach ($parenTag as $key => $Tag): 
                            $selected = '';
                     echo $tag_id.'---'.$key . ' --';
                    
                                    if (in_array($key,  explode(',', $tag_id))) {
                                       
                                        $selected = 'selected';  
                                    }
                                    else
                                    {
                                        $selected='';
                                    }
                        ?>
                    
                            <option <?=$selected?> value="<?= $key ?>"><?= $Tag ?></option>
    <?php endforeach;
endif;
?>
                </select><div style =" color: red; display: none;padding-left:43%" id="tag_error"> Select Parent Tag </div>
            </div>
        </div>  
        <div style="clear: both;margin: 2%"></div>
        <div class="control-group" id="link" <?php if($type !='Status') { echo 'style="display:none"'; }?> >
            <?php echo form_label('Status Image:', 'value', array("class"=>"control-label label label-info", 'style' => " float: left;padding: 0.6em 0.7em 0.7em;margin-right: 5%;margin-top: 0.52%")); ?> 
<!--            <div class="controls" style="float:left;">
                <input  type="text" class="form-control" style="margin-left: 60px;width: 92%"  class = "control-label" placeholder="Link" id="link_val" name="link_val" value="<?=$value?>" />
            </div><div style =" color: red; display: none;padding-left:43%;clear: both;" id="linkname"> Enter Link </div>-->

             <div>
               <div style="margin-left: 26%" class="fileupload fileupload-new" data-provides="fileupload">
                   <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img id="imgsrc1" src="<?php if(isset($value)) if($value !="") echo base_url() . '/' . $value; ?>" /></div>
                        <div id="imgdiv" class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                        <span class="btn btn-file" style="margin-left: 0%!important;"><span id="select_btn" class="fileupload-new" style="margin-left: 0%!important;">Select image</span><span class="fileupload-exists">Change</span><input id="img" name="img" type="file" accept="image/jpg,image/jpeg,image/png,image/gif,image/bmp,image/tiff" onchange =""/></span>
                        <a style="margin-left: 0%!important;" href="#" class="btn fileupload-exists" id="clo" data-dismiss="fileupload">Remove</a>
                    </div><div id="img_msg" name="img_msg" style = "display:none">Warning : Please Select jpg image.</div>
                </div>
 <input type="hidden" name="im" id="imgsrc" value="<?php if(isset($value)) if($value !="") echo $value; else echo ""; ?>">
        </div> 
        <div style="clear: both;margin: 10%"></div>
    </div>

    <div class="modal-footer ">
        <div class="control-group"> 
            <div class="controls">
                <input type="submit" style="float: left; margin-left:170px;  " name="save" class="btn btn-primary" value="Update Taxonomy"  />
                <input type="button" style="float: left;" id="close"  class="btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close">      

            </div>
        </div> 

    </div>
            <script>
    $('#type').change(function(){
      
        if(this.value == "Status")
            {
                $('#link').show();
            }
        else
            {
                $('#link').hide();
            }
    })
</script>
</div></div>
         </div>
</div>
<input type ="hidden" id ="ur" value="<? echo site_url('/taxonomy/edit_taxonomy'); ?>"/>
<input type ="hidden" id ="ur2" value="<? echo site_url('/taxonomy'); ?>"/>
<?php echo form_close(); ?>