
<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/manage_item.js"></script>
<table id="tab_id" class="table table-striped ">
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
        <?php if (is_array($items) && !empty($items)):
            foreach ($items as $val):
                ?>
                <tr>

                    <td><?= $val->name ?></td>
                    <td><?= $val->title ?></td>  
                    <td><div class="body_img" style="height:200px;  overflow: auto;"><?= $val->body ?></div></td> 
                    <td><?= $val->created_by ?></td>  
                    <td><?= $val->status ?></td>  
                    <td><?= $val->createdTime ?></td>  <? /*  href=".$val->id) ?>"  , */ ?>
                    <td><div class="btn-group"> <a href=<?php echo site_url('/admin/item/edit_item/'.$val->id);?> class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a>
                            <a href="javascript:deletbox('<?php echo site_url('/admin/item/delete_item/' . $val->id) ?>')" class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
                </tr>
    <? endforeach;
endif; ?>
    </tbody>
</table>
<div id="item_edit"style="position: absolute;left:-500px;top:-1000px;"></div>
