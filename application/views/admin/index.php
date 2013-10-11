<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/index.js"></script>
<table id="tab_id" class="table table-striped">
    <thead>
        <tr>
            <th>Board Name</th>
            <th>Board Parent Tag</th>
            <th>Created By</th>
            <th>Created Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($boards) && !empty($boards)):
            foreach ($boards as $val):
                ?>
                <tr>
                    <td><?= $val->board_name ?></td>
                    <td><?= $val->parent_tags ?></td>
                    <td><?= $val->user_name ?></td>
                    <td><? echo date('d-m-Y', strtotime($val->createdTime)); ?></td>
                    <td><div class="btn-group"> <a href="javascript:edit(<?= $val->board_id ?>)" class="btn btn-primary fui-new"><i class="icon-edit icon-white"></i> Edit</a>
                            <a href="javascript:deletbox('<?php  echo site_url('/admin/home/delete_board/' . $val->board_id) ?>')"  class="btn btn-danger fui-trash"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
                </tr>
            <? endforeach;
        endif;
        ?>

    </tbody>
</table>
</table>
<?php
switch ($option) {
    case 'createtag': {
            echo "<script>
   setTimeout(function(){
       $('#mod').click();
   },100);
</script>";
        }
        break;
    case 'createbord': {
            echo "
            <script>
    $.ajax({
       url:'../create_board',
       type:'POST',
       success:function(res)
       {
           $('#createboard').html(res);
       }
    });
</script>    
            ";
        }
        break;
    default:
        break;
}
?>
<a href="#myModal" role="button" id="mod" style="display: none" class="btn" data-toggle="modal"></a>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   
<?php echo form_open('admin/home/create_tags', array('name' => 'myform')); ?>
    <div class="modal-header">
        <h3 id="myModalLabel">Create Tag</h3>
    </div>
    <div class="modal-body">
        <br>
<?php echo form_label('Name :', 'nametag', array('class' => "control-label")); ?>
        <input type="text" style="float: left" id="name" placeholder="TagName" name="name" onblur="check()">
        <div><?php echo validation_errors(); ?></div> <div style =" color: red; display: none;" id="error"> Enter tag Name </div>
        <label id="msg" class="control-label"></label>
<?php echo form_label('Parent Tag :', 'id', array('class' => "control-label", 'style' => "clear:both")); ?>
        <div class="controls">
            <select data-placeholder="Choose a Parent Tag..."  style="width:350px;" tabindex="4" id="parentTag" name="parentTag" onselect="call()" style="margin-left:px;">
                <option value="0">No Parent</option>
                <? if (!empty($parenTag)): foreach ($parenTag as $key => $Tag): ?>
                        <option value="<?= $key ?>"><?= $Tag ?></option>
    <?php endforeach;
endif;
?>
            </select>
        </div>
        <br><br>  
        <div class="modal-footer">
            <input type="button" id="savebtn" name="save" class="btn btn-primary" value="Create Tag" onclick="savefun()">
            <input type="button" id="close" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close" onclick="cl()">
        </div>
    </div>
<?php form_close(); ?>
</div>
<input type="hidden" id="ur" value="<?= site_url('/admin/home') ?>">
<input type="hidden" id="editurl" value="<?= site_url('/admin/home/edit_board') ?>">
<div id="edit"></div>
<div id="createboard"></div>
