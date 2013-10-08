<?php
//include '/dropdown.php';
?>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/edit_Tag.js"></script>
<?php echo form_open('admin/home/update_tags', array('name' => 'myform')); ?>
<a href="#myModal"  role="button" id="mod1"  class="btn" data-toggle="modal" value="add"></a>
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
    <input type="hidden" id="id" name="id" value=<?=$id?>>
    <div class="modal-header">
        <h3 id="myModalLabel" style="margin-left: 36%">Edit Tag</h3>
    </div>

    <div class="modal-body div_wrapper" style="height: 130px">
        <div class="control-group">
           <?php echo form_label('Name :', 'nametag', array('class' => "control-label label label-info", 'style' => "float: left;padding: 0.6em 0.7em 0.7em;margin-right: 10%;margin-top: 0.52%")); ?>
            <div class="controls">
                <input type="text" class="form-control" style="float: left;width:45%" id="name" placeholder="TagName" value="<?=$name;?>" name="name" onblur="check()">
                <div><?php echo validation_errors(); ?></div> <div style =" color: red; display: none;" id="error"> Enter tag Name </div>
            </div>
        </div>
        <div style="clear: both;margin-top: 8%;"></div>
        <div class="control-group">    
           <?php echo form_label('Parent Tag :', 'id', array('class' => "control-label label label-info", 'style' => "float: left;padding: 0.6em 0.7em 0.7em;margin-right: 4.5%;margin-top: 0.52%")); ?>
          <div class="controls" style="float: left">
                <select data-placeholder="Choose a Parent Tag..." class="chosen-select selectpicker" multiple style="width:350px;" tabindex="4" id="parentTag" name="parentTag" onselect="call()" >
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
                <input type="button" id="closebtn" class="btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close">
            </div>
        </div>
    </div>
</div>
        </div>
    </div>