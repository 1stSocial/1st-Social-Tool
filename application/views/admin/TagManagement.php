<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/tag_management.js"></script>

<table id="tab_id" class="table table-striped ">
    <thead>
        <tr>
            <th>Tag Id</th> 
            <th>Parent Tag</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($parentTags) && !empty($parentTags)):
            foreach ($parentTags as $val):
                ?>
                <tr>
                    <td><?= $val->id ?></td>  
                    <td><?= $val->name ?></td>
                    <td><div class="btn-group"> <a onclick="edit(<?= $val->id ?>)" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a>
                            <a href="javascript:deletbox('<?php echo site_url('/admin/home/delete_parenttag/' . $val->id) ?>')"   class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
                </tr>
            <? endforeach;
        endif;
        ?>
    </tbody>
</table>
<input type ="hidden" id ="edit_url" value="<?= site_url('/admin/home/tag'); ?>"/> 
<div id="edit" style="position: absolute;left:-500px;top:-1000px">

</div>
<?php
switch ($option) {
    case 'createtag': {
            echo "<script>
   setTimeout(function(){
       $('#mod').click();
   },300);
</script>";
        }
        break;
}
?>

<a href="#myModal" role="button" id="mod" style="display: none" class="btn" data-toggle="modal"></a>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <?php
    include '/dropdown.php';
    ?>
<?php echo form_open('admin/home/create_tags', array('name' => 'myform')); ?>

    <div class="modal-header">
        <h3 id="myModalLabel">Create Tag</h3>
    </div>
    <div class="modal-body div_wrapper">
        <div class="control-group">
<?php echo form_label('Name :', 'nametag', array('class' => "control-label", 'style' => "float:left;padding-right:41px")); ?>
            <div class="controls">
                <input type="text" style="float: left" id="name" placeholder="TagName" name="name" onblur="check()">
                <div><?php echo validation_errors(); ?></div> <div style =" color: red; display: none;" id="error"> Enter tag Name </div>
            </div>
        </div>
        <br>
        <div class="control-group">    
<?php echo form_label('Parent Tag :', 'id', array('class' => "control-label", 'style' => "clear:both;float:left")); ?>
            <div class="controls" style="float: left">
                <select data-placeholder="Choose a Parent Tag..." class="chosen-select" multiple style="width:350px;" tabindex="4" id="parentTag" name="parentTag" onselect="call()" >
                    <option value="0">No Parent</option>
                    <? if (!empty($parenTag)): foreach ($parenTag as $key => $Tag): ?>
                            <option value="<?= $key ?>"><?= $Tag ?></option>
    <?php endforeach;
endif;
?>
                </select>
            </div><div style =" color: red; display: none;" id="perror"> Select Parent tag </div>
        </div><div style="height: 20px"></div>
    </div>
    <div class="modal-footer">
        <div class="control-group">  
            <div class="div_wrapper" style="padding-left: 33%">
                <input type="button" id="savebtn" name="save" class="btn btn-primary footer_btn" value="Create Tag" onclick="savefun()">
                <input type="button" id="close" class="close btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" onclick="cl()">
            </div>
        </div>
    </div>    
<?php form_close(); ?>
</div>

<input type="hidden" id="ur" value="<?= site_url('/admin/home/tag_Management') ?>">
<div id="edit1"></div>
<div id="createboard"></div>          