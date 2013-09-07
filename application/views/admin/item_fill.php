<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/item_fill.js"></script>
<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

    <?php echo form_open('admin/Item/insert_item'); ?>
    <div class="modal-header">
        <input type="hidden" value='<?= $board_id; ?>' id="bord_id" name='bord_id'>
        <h3>Add Item <?= $board_name ?></h3> 
    </div>
    <div class="modal-body" style="overflow: auto ! important;">   
        <div class="control-group">
            <div class="controls">
                <label style=" float: left;" class="control-label"  >Name :</label>
                <div style='magrin-top:33px;padding-left:20%;'><input type="text" id ="item_name"name="name" class="control-label" style="width: 90%"/> <div id="item_name_error"></div></div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <label style=" float: left;" class="control-label"  >Title :</label>
                <div style='magrin-top:33px;padding-left:20%;'><input type="text" id="item_title" name="title" class="control-label" style="width: 90%"></div>
            </div>
        </div>

        <div class="control-group">
            <div class="controls">
                <label style=" float: left;" class="control-label"  >Body :</label>
                <div style="height: 200px; width: auto; overflow: scroll; margin-left: 53px;">
                    <textarea id="body" name="body" ></textarea>
                </div>
            </div>
        </div>
        <div class="controls" id="taxonomydiv">
            <div id="taxodiv">
                <? if (!empty($Taxonomy)): foreach ($Taxonomy as $val): ?>
                        <label style=" float: left;" class="control-label" ><?= $val->name ?> :</label>
                        <div style='magrin-top:33px;padding-left:20%;'><input type="text" style="float:left;width: 90%;" class="control-label" id="<?= $val->id ?>" name="taxo"/><input type="hidden" value="<?=$val->id?>" id="taxoid"/><div id="<?= $val->id ?>d"></div><div style="clear: both"></div></div>
                        
 <?php endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>

    <div class="modal-footer">        
        <div class="control-group div_wrapper">
            <input type="button" style="margin-left: 27%" class="btn btn-primary footer_btn" value="Create Item" onclick="savefun('<?php echo site_url("/admin/item/insert_item/"); ?>')" />
            <input type="button" class="close btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn" onclick="_close()">
        </div>
    </div>
</div>
<table class="table table-striped ">
    <thead>
        <tr>
            <th>Name</th> 
            <th>Title</th>
            <th>Body</th>
            <th>Created By</th>
            <th>Status</th>
            <th>Created Time</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($items) && !empty($items)):
            foreach ($items as $val):
                ?>
                <tr>

                    <td><?= $val->name ?></td>
                    <td><?= $val->title ?></td>  
                    <td><div style=" height:70px;   overflow: scroll;"><?= $val->body ?></div></td> 
                    <td><?= $val->created_by ?></td>  
                    <td><?= $val->status ?></td>  
                    <td><?= $val->createdTime ?></td> 
                    <td><div class="btn-group"> <a onclick="edit('<?php echo site_url('/admin/item/edit_item/'); ?>', '<?php echo $val->id; ?>')" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a><a onclick="return confirm('Are you sure?')" href="<?php echo site_url('/admin/item/delete_item/' . $val->id) ?>"class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
                </tr>
    <? endforeach;
endif;
?>
    </tbody>
</table>
