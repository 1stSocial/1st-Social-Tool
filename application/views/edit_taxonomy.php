<?php
//include '/admin/dropdown.php';
?>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/edit_taxonomy.js"></script>

<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>

<input type="hidden" id="id" value="<?php echo $id; ?>" name="id" >
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 style="margin-left:5px;">Edit Taxonomy</h3>
        <p> <? if (isset($success)) echo $success; ?> </p>
    </div>
    <div class="modal-body div_wrapper"><!-- Password input-->
        <div class="control-group">
            <?php echo form_label('Name:', 'name', array('class' => "control-label", 'style' => "float:left;margin-left:10px")); ?>
            <div class="controls" style="float:left;">
                <input type="text" style="margin-left: 55px"  class = "control-label" value="<?php
                if (isset($name)) {
                    echo $name;
                }
                ?>" name="name" id="name" >
            </div> <div style =" color: red; display: none;padding-left:43%;clear: both;" id="taxoname"> Enter Taxonomy Name </div>
        </div> 
        <div style="clear: both;"></div> 
        <div class="control-group">
<?php echo form_label('Type:', 'type', array('class' => "control-label", 'style' => "float:left;margin-left:10px;")); ?>
            <div class="controls">
                <select data-placeholder="Choose a Type..." class="chosen-select"  style="width:350px;" tabindex="4" id="type" name="type" style="margin-left: 60px;">
                    <option value="select">Select</option>
                    <option value="string">String</option>
                    <option value="Integer">Integer</option>
                </select><div style =" color: red; display: none;padding-left:43%" id="type_error"> Select Taxonomy Type </div>
            </div>
        </div>    

        <div class="control-group">
<?php echo form_label('Parent Tag:', 'parent_tag1', array('class' => "control-label", 'style' => "float:left;margin-left:10px;")); ?>
            <div class="controls">
                <select data-placeholder="Choose a Parent..." class="chosen-select mar"  style="width:350px;" tabindex="4" id="parentTag2" name="parentTag2"  style="margin-left: 22px;">
                    <option value="0">Select</option>
                    <? if (!empty($parenTag)): foreach ($parenTag as $key => $Tag): ?>
                            <option value="<?= $key ?>"><?= $Tag ?></option>
    <?php endforeach;
endif;
?>
                </select><div style =" color: red; display: none;padding-left:43%" id="tag_error"> Select Parent Tag </div>
            </div>
        </div>        
    </div>

    <div class="modal-footer ">
        <div class="control-group"> 
            <div class="controls">
                <input type="button" style="float: left; margin-left:170px;  " name="save" class="btn btn-primary" value="Update Taxonomy" onclick="savefun()" />
                <input type="button" style="float: left;" id="close"  class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close">      

            </div>
        </div> 

    </div>

</div>
<input type ="hidden" id ="ur" value="<? echo site_url('/taxonomy/edit_taxonomy'); ?>"/>
<input type ="hidden" id ="ur2" value="<? echo site_url('/taxonomy'); ?>"/>
