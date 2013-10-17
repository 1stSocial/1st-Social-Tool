<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/edit_board.js"></script>
<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>
<?php echo form_open_multipart(site_url("/admin/home/logo_image/")); ?>
<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div id="load" class="loader"></div>
        <div id="fad">
        <div class="modal-content"> 
    <div class="modal-header">
        <h3 style="margin-left:35%;">Edit Board</h3>
        <p> <? if (isset($success)) echo $success; ?> </p>
    </div>
    <div class="modal-body "><!-- Password input-->
        <div class="div_wrapper">
            
             <div class="control-group">
            <div class="controls">

              <label style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%" class="control-label label label-info"  >Upload Images :</label>
           <div>
               <div style="margin-left: 33%" class="fileupload fileupload-new" data-provides="fileupload">
                   <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img id="imgsrc1" src="<?php if(isset($boardData[0]->image)) if($boardData[0]->image !="") echo base_url() . '/' . $boardData[0]->image; ?>" /></div>
                        <div id="imgdiv" class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                        <span class="btn btn-file" style="margin-left: 0%!important;"><span id="select_btn" class="fileupload-new" style="margin-left: 0%!important;">Select image</span><span class="fileupload-exists">Change</span><input id="img" name="img" type="file" accept="image/jpg,image/jpeg,image/png,image/gif,image/bmp,image/tiff" onchange =""/></span>
                        <a style="margin-left: 0%!important;" href="#" class="btn fileupload-exists" id="clo" data-dismiss="fileupload">Remove</a>
                    </div><div id="img_msg" name="img_msg" style = "display:none">Warning : Please Select jpg image.</div>
                </div>

              <input type="hidden" name="im" id="imgsrc" value="<?php if(isset($boardData[0]->image)) if($boardData[0]->image !="") echo $boardData[0]->image; else echo ""; ?>">
                
            </div>  
        </div>
            
            <div class="control-group">
            <?php echo form_label('Board Name:', 'name', array('class' => "control-label label label-info", 'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;")); ?>
      <div style="margin-left: 33%">
                    <input class="form-control" type="text"  style="width: 68.5%" id="name1" placeholder="Board Name" value="<?= $boardData[0]->name ?>" name="name" ><div style =" color: red; display: none;padding-left:43%" id="berror"> Enter Board Name </div>
                    <input type="hidden" id="mainid" value=<?= $id ?> >
                </div>
            </div>
            
              <div style="margin-top: 5px"></div>   
            <?php echo form_label('Board Title:', 'title', array('class' => "control-label label label-info", 'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%")); ?>
            <div style="margin-left: 33%">
                <input class="form-control" required="" type="text" style="width: 68.5%"  class = "control-label" placeholder="Board Title" id="title1" value="<?= $boardData[0]->board_title ?>" name="title" ><div style =" color: red; display: none;padding-left:43%" id="terror"> Enter Board Title </div>
            </div>   
             <div style="margin-top: 5px"></div>
             
             <div>
         <?php echo form_label('Call to action Name:', 'button_name', array('class' => "control-label label label-info", 'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;")); ?>
                            <div style="margin-left: 33%">
                                <input required="" class="form-control" type="text" style="width: 68.5%"  class = "control-label" placeholder="Call to action Name" id="call_to_action" name="call_to_action"  value="<?= $boardData[0]->call_to_action ?>"><div style =" color: red; display: none;padding-left:43%" id="call_error"> Enter call to action Name </div>
                            </div>
                        </div>
             
            <div class="component">
                <div class="control-group">
               <?php echo form_label('Board Parent Tag:', 'parent_tag', array('class' => "control-label label label-info",'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;"));
               
                    $sel = explode(',', $boardData[0]->parent_tags);
//                    var_dump($sel);
                    ?>
                    <div style="margin-left: 33%">
                        <select class="chosen-select" data-placeholder="Choose a Parent..." multiple="" style="width:350px;" tabindex="4" id="parentTag1" name="parentTag1" >
                            <option value="0"></option>
                            <?
                            if(!empty($parenTag)):
                                foreach ($parenTag as $key => $Tag):
                                    $selected = '';
                                    if (in_array($key, $sel) ) {
                                        $selected = 'selected';  
                                    }
                                    else
                                    {
                                        $selected='';
                                    }
                                    ?>    
                            <option <?=$selected;?> value="<?= $key ?>"><?= $Tag ?></option>
                            <!--<option selected>'test</option>-->
                                <?php endforeach;
                            endif;
                            ?>
                                    <!--<option selected="selected">-->
                        </select><div style =" color: red; display: none;padding-left:43%" id="perror"> Select Parent Tag </div>
                    </div>
                </div>
            </div>
            <input type="text" style="display: none" value="<?=$sel?>" id="selected_tag">
            <input type="text" style="display: none" value="<?= $boardData[0]->Filterable_taxo ?>" id="selected_taxo">
            
             <div style="clear: both;margin-top: 5px"></div>
            
            <div class="control-group">
               <?php echo form_label('Filterable Taxonomy:', 'taxo', array('class' => "control-label label label-info", 'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;")); ?>
                 <div style="margin-left: 33%">
                    <div id="select_box" style="width:451px;">
                    <select class="chosen-select" data-placeholder="Choose a Filterable Taxonomy..." style="width:350px;" tabindex="4" id="taxo" name="taxo" >
                        <option></option>
                    </select></div>
                </div>
            </div>
            <div style="clear: both"></div>
            <div class="control-group">
                    <?php echo form_label('Select Theme:', 'theme', array('class' => "control-label label label-info", 'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;")); ?>
            <div style="margin-left: 33%">
                    <select class="chosen-select" data-placeholder="Choose a Theme..." style="width:350px;" tabindex="4" id="theme" name="theme" >
                        <option value="0"></option>
                        <option <?php if($selected_theme==0) echo 'selected';?> value="0">Default</option>
                        <? if (!empty($theme)): foreach ($theme as $Theme_val): 
                                    $selected = '';
                                    if ($Theme_val->id == $selected_theme) {
                                        $selected = 'selected';  
                                    }
                                    else
                                    {
                                        $selected='';
                                    }
                                    ?>    
                                <option <?=$selected;?> value="<?= $Theme_val->id ?>"><?= $Theme_val->theme_name ?></option>
                            <?php endforeach;
                        endif; ?>
                    </select>
                </div>
            </div> 
             <div style="clear: both"></div>
            <div class="component"><!-- Partner-->
             <?php 
             if($access_level == 'admin') :?>
                <div class="control-group">
              <?php echo form_label('Domain :', 'domain', array('class' => "control-label label label-info", 'style' => "float:left;padding: 0.6em 0.7em 0.7em;margin-right: 5%;margin-top: 0.52%;")); ?>
                          <div style="margin-left: 33%">
                         <select class="chosen-select" data-placeholder="Choose a Domain..." style="width:350px;" tabindex="4" id="domain" name="user_id[]" required="please select Domain">
                           <? if (!empty($domain)): foreach ($domain as $val): 
                               ?>
                             <option value="<?= $val->id ?>" <?php if($val->id == $selected_domain) echo 'selected' ?>><?= $val->name ?></option>
                            <? endforeach;
                            endif; ?>
                        </select>
                    </div>
                </div>
               <?php
            endif;
               if($access_level != 'admin') : ?>
                <input type="hidden" value="<?php echo $domain;?>" id="domain">
            <?php endif;?> 
            </div>

        </div></div>
    <div class="modal-footer">
        <div class="div_wrapper">
            <div class="control-group" style="margin-left: 15%">
                <input type="submit" id="update" name="update" class="btn btn-primary footer_btn" value="Update Board" />
                <input type="button" class=" btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" id="cl">
                <input type="hidden" id="site" value="<?= site_url();?>">
                
            </div> 
        </div>
    </div>
</div></div>
        </div>
    </div>