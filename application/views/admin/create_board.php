<?php
//include '/dropdown.php';
?>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/create_board.js"></script>
<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>
<?php echo form_open('admin/home/create_board', 'class="horizontal-form"'); ?>
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 style="margin-left:5px;">Create Board</h3>
        <p> <? if (isset($success)) echo $success; ?> </p>
    </div>
    <div class="modal-body "><!-- Password input-->
        <div class="div_wrapper">
            <?php echo form_label('Board Name:', 'name', array('class' => "control-label", 'style' => "float:left;margin-left:10px")); ?>
            <div class="controls">
                <input required="" type="text" style="margin-left: 55px"  class = "control-label" placeholder="Board Name" id="name1" name="name" ><div style =" color: red; display: none;padding-left:43%" id="berror"> Enter Board Name </div>
            </div>
            <div class="control-group">
                <?php echo form_label('Board Parent Tag:', 'parent_tag', array('class' => "control-label")); ?>
                <div class="controls">
                    <select required="" data-placeholder="Choose a Parent Tag..." class="chosen-select" style="width:350px;" tabindex="4" id="parentTag1" name="parentTag1" >
                        <option value="0"></option>
                        <? if (!empty($parenTag)): foreach ($parenTag as $key => $Tag): ?>
                                <option value="<?= $key ?>"><?= $Tag ?></option>
                            <?php endforeach;
                        endif; ?>
                    </select><div style =" color: red; display: none;padding-left:43%" id="perror"> Select Parent Tag </div>
                </div>
            </div>
            
             <div class="control-group">
                <?php echo form_label('Filterable Taxonomy:', 'taxo', array('class' => "control-label")); ?>
                <div class="controls">
                    <div id="select_box" style="width:451px;">
                        <select required="" data-placeholder="Choose a Filterable Taxonomy..." class="chosen-select" style="width:350px;" tabindex="4" id="taxo" name="taxo" >
                        <option></option>
                    </select></div>
                </div>
            </div>
            <div style="clear: both"></div>
            <div class="control-group">
                <?php echo form_label('Select Theme:', 'theme', array('class' => "control-label")); ?>
                <div class="controls">
                    <select data-placeholder="Choose a Theme..." class="chosen-select" style="width:350px;" tabindex="4" id="theme" name="theme" >
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
                    <?php echo form_label('Domain :', 'domain', array('class' => "control-label")); ?>
                                    <div class="controls">
                                        <select data-placeholder="Choose a Domain..." class="chosen-select" style="width:350px;" tabindex="4" id="domain" name="user_id[]" required="please select Domain">
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
        </div> 
    </div>
    <div class="modal-footer ">
        <div class="control-group">
            <div class="div_wrapper">
                <input type="button"  id="add" name="add" class="btn btn-primary footer_btn" value="Create Board" onclick="savefun();" />
                <input type="button" class="close btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn">
            </div>
        </div>     
        <input type ="hidden" id="ur" value="<?php echo site_url('/admin/home'); ?>">
        <input type="hidden" id="site" value="<?= site_url();?>">
    </div></div>


