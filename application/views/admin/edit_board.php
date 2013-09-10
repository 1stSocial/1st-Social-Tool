<?php 
//$path = $_SERVER['SCRIPT_NAME'];
//$startpath = $_SERVER['DOCUMENT_ROOT'];
//$val = str_replace('/index.php', '/application/views/admin/dropdown.php', $path);
//include $startpath . $val;
?>
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
                    <?php echo form_label('Board Parent Tag:', 'parent_tag', array('class' => "control-label")); ?>
                    <div class="controls">
                        <select data-placeholder="Choose a Parent..." class="chosen-select"  style="width:350px;" tabindex="4" id="parentTag1" name="parentTag1" >
                            <option value="0"></option>
                            <?
                            if (!empty($parenTag)):
                                foreach ($parenTag as $key => $Tag):
                                    $selected = '';
                                    if ($Tag == $boardData[0]->parent_tags) {
                                        $selected = 'selected';
                                    }
                                    ?>    
                                    <option <?= $selected;?> value="<?= $key ?>"><?= $Tag ?></option>
                                <?php endforeach;
                            endif;
                            ?>
                        </select><div style =" color: red; display: none;padding-left:43%" id="perror"> Select Parent Tag </div>
                    </div>
                </div>
            </div>
            
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
            
            <div class="component"><!-- Partner-->
                <div class="control-group">
<?php echo form_label('Board User (Partner):', 'user_id', array('class' => "control-label")); ?>
                    <div class="controls">
                        <select data-placeholder="Choose a Partner..." class="chosen-select" multiple style="width:350px;" tabindex="4" id="user_id" name="user_id[]" >
                            <?php
                            if (!empty($partners)): foreach ($partners as $val):
                                    $selected = '';
                                    if (!empty($selectedPartners)) {
                                        foreach ($selectedPartners as $sePartner) {
                                            if ($val->id == $sePartner->user_id) {
                                                $selected = 'selected';
                                            }
                                        }
                                    }
                                    ?>
                                    <option  <?= $selected ?> value="<?= $val->id ?>"><?= $val->name ?></option>
                                <? endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>

            </div>

        </div></div>
    <div class="modal-footer">
        <div class="div_wrapper">
            <div class="control-group">
                <input type="button" id="update" name="update" class="btn btn-primary footer_btn" value="Update Board" />
                <input type="button" class="close btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" id="cl">
            </div> 
        </div>
    </div>
</div>