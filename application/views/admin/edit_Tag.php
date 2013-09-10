<?php
//include '/dropdown.php';
?>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/edit_Tag.js"></script>
<?php echo form_open('admin/home/update_tags', array('name' => 'myform')); ?>
<a href="#myModal"  role="button" id="mod1"  class="btn" data-toggle="modal" value="add"></a>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <input type="hidden" id="id" name="id" value=<?=$id?>>
    <div class="modal-header">
        <h3 id="myModalLabel">Edit Tag</h3>
    </div>

    <div class="modal-body div_wrapper">
        <div class="control-group">
            <?php echo form_label('Name :', 'nametag', array('class' => "control-label", 'style' => "float:left;padding-right:41px")); ?>
            <div class="controls">
                <input type="text" style="float: left" id="name" placeholder="TagName" value="<?=$name;?>" name="name" onblur="check()">
                <div><?php echo validation_errors(); ?></div> <div style =" color: red; display: none;" id="error"> Enter tag Name </div>
            </div>
        </div>
        <br>
        <div class="control-group">    
            <?php echo form_label('Parent Tag :', 'id', array('class' => "control-label", 'style' => "clear:both;float:left")); ?>
            <div class="controls" style="float: left">
                <select data-placeholder="Choose a Parent Tag..." class="chosen-select" multiple style="width:350px;" tabindex="4" id="parentTag" name="parentTag" onselect="call()" >
                    <option value="0">No Parent</option>
                    <? if (!empty($parenTag)): foreach ($parenTag as $key => $Tag): 
                    foreach ($parentid as $sePartner) {
                        $selected =''; 
                                            if ($key == $sePartner) {
                                                $selected = 'selected';
                    }}?>
                            <option <?=$selected;?> value="<?= $key ?>"><?= $Tag ?></option>
                        <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div><div style =" color: red; display: none;" id="perror"> Select Parent tag </div>
        </div><div style="height: 20px"></div>
    </div>
    <div class="modal-footer">
        <div class="control-group">  
            <div class="div_wrapper" style="padding-left: 33%">

                <input type="button" id="updatebtn" name="update" class="btn btn-primary footer_btn" value="Update">
                <input type="button" id="closebtn" class="close btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close">
            </div>
        </div>
    </div>
</div>