<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/edit_board.js"></script>
<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>
<?php echo form_open('', 'class="horizontal-form"'); ?>
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 style="margin-left:5px;">Edit Board</h3>
        <p> <? if (isset($success)) echo $success; ?> </p>
    </div>
    <div class="modal-body "><!-- Password input-->
        <div class="div_wrapper">
            <div class="control-group">
                <?php echo form_label('Board Name:', 'name', array('class' => "control-label")); ?>
                <div class="controls">
                    <input type="text" id="name1" placeholder="Board Name" value="<?= $boardData[0]->name ?>" name="name" ><div style =" color: red; display: none;padding-left:43%" id="berror"> Enter Board Name </div>
                    <input type="hidden" id="mainid" value=<?= $id ?> >
                </div>
            </div>
            <div class="component">
                <div class="control-group">
                    <?php echo form_label('Board Parent Tag:', 'parent_tag', array('class' => "control-label"));
                    $sel = $boardData[0]->parent_tags;?>
                    <div class="controls">
                        <select data-placeholder="Choose a Parent..." class="chosen-select"  style="width:350px;" tabindex="4" id="parentTag1" name="parentTag1" >
                            <option value="0"></option>
                            <?
                            if(!empty($parenTag)):
                                foreach ($parenTag as $key => $Tag):
                                    $selected = '';
                                    if ($key == $sel) {
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
            <div class="control-group">
                <?php echo form_label('Filterable Taxonomy:', 'taxo', array('class' => "control-label")); ?>
                <div class="controls">
                    <div id="select_box" style="width:451px;">
                    <select data-placeholder="Choose a Filterable Taxonomy..." class="chosen-select" style="width:350px;" tabindex="4" id="taxo" name="taxo" >
                        <option></option>
                    </select></div>
                </div>
            </div>

            <div class="control-group">
                <?php echo form_label('Select Theme:', 'theme', array('class' => "control-label")); ?>
                <div class="controls">
                    <select data-placeholder="Choose a Theme..." class="chosen-select" style="width:350px;" tabindex="4" id="theme" name="theme" >
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
            
            <div class="component"><!-- Partner-->
             <?php 
             if($access_level == 'admin') :?>
                <div class="control-group">
                <?php echo form_label('Domain :', 'domain', array('class' => "control-label")); ?>
                    <div class="controls">
                         <select data-placeholder="Choose a Domain..." class="chosen-select" style="width:350px;" tabindex="4" id="domain" name="user_id[]" required="please select Domain">
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
            <div class="control-group">
                <input type="button" id="update" name="update" class="btn btn-primary footer_btn" value="Update Board" />
                <input type="button" class="close btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" id="cl">
                <input type="hidden" id="site" value="<?= site_url();?>">
                
            </div> 
        </div>
    </div>
</div>