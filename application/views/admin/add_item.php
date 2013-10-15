<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/create_item.js"></script>
<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>
<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div id="load" class="loader"></div>
        <div id="fad">
        <div class="modal-content"> 
    <?php echo form_open('admin/Item/fill_value', 'additem'); ?>
    <div class="modal-header">
        <input type="hidden" id="url" value="<?= site_url(); ?>">
        <h3> Create Item </h3>
    </div>
    <div class="modal-body div_wrapper"> 
        <br/>
        <label class="control-label label label-info" style=" float: left;padding: 0.6em 0.7em 0.7em;margin-top: 0.52%;width: 23%;">Choose Board :</label>
        <select required data-placeholder="Choose a Board..." class="chosen-select" style="width:350px;" tabindex="4" id="boardval" name="boardval" onchange="get_parent_change_val()">
            <option value="0"></option>
            <? if (!empty($boards)): foreach ($boards as $val): ?>
                    <option value="<?= $val['id'] ?>"><?= $val['name'] ?></option>
                <?php endforeach;
            endif;
            ?>
        </select>
        <div id="parent_tag">
            
        </div>
        
        <div id="add">
        </div>
        <br/><br/>
    </div>
    <div class="control-group">
        <div class="modal-footer div_wrapper">
            <input type="submit" value="Create" id="sub" name="sub" class="btn btn-primary " style="display: none">
            <input type="button" style="margin-left: 30%" value="Create" id="sub1" name="sub1" class="btn btn-primary footer_btn">
            <input type="button" class="btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn" onclick="_close()">
        </div>
    </div>
<?php echo form_close(); ?>
</div>
</div></div>
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
                    <td><?= $val->createdTime ?></td>  <? /*  href=".$val->id) ?>"  , */ ?>
                    <td><div class="btn-group"> <a onclick="edit('<?php echo site_url('/admin/item/edit_item/'); ?>', '<?php echo $val->id; ?>')" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a><a onclick="return confirm('Are you sure?')" href="<?php echo site_url('/admin/item/delete_item/' . $val->id) ?>"class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
                </tr>
    <? endforeach;
endif;
?>
    </tbody>
</table>