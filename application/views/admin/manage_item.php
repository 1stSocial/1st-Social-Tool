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
            $str = $val->body;    
            ?>
                <tr>
                    <?php
                        preg_match_all('/\< *[img][^\>]*[src] *= *[\"\']{0,1}([^\"\']*)/i', $val->body, $all_img);
                        foreach ($all_img['1'] as $match) {
                         $str =  str_replace($match , base_url().'assets/extra/resize.php?path='.$match.'&width=100 &height=100', $str);
                        }
                    ?>
                    <td><?= $val->name ?></td>
                    <td><?= $val->title ?></td>  
                    <td><div class="body_img" style="height:200px;width: 450px;  overflow: auto;"><?= str_replace('/content/', '/thumbnail/', $str) ?></div></td> 
                    <td><?= $val->created_by ?></td>  
                    <td><?= $val->status ?></td>  
                    <td><?= $val->createdTime ?></td>  <? /*  href=".$val->id) ?>"  , */ ?>
                    <td><div class="btn-group"> <a href=<?php echo site_url('/admin/Item/edit_item/'.$val->id);?> class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a>
                            <a href="javascript:deletbox('<?php echo site_url('/admin/Item/delete_item/' . $val->id) ?>')" class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
                </tr>
    <? endforeach;
endif; ?>
    </tbody>
</table>
<div id="item_edit"style="position: absolute;left:-500px;top:-1000px;"></div>
