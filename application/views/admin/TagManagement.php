<table class="table table-striped ">
        <thead>
          <tr>
            <th >Parent Tag</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php if(is_array($parentTags) && !empty($parentTags)): 
                foreach ($parentTags as $val): ?>
          <tr>
            <td><?=$val->name?></td>
            <td><div class="btn-group"> <a onclick="edit(<?=$val->id?>)" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a><a onclick="return confirm('Are you sure?')" href="<?php echo site_url('/admin/home/delete_parenttag/'.$val->id) ?>"class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
          </tr>
          <? endforeach;endif;?>
        </tbody>
      </table>

<div id="edit" style="position: absolute;left:-500px;top:-1000px">
    
</div>
<script>
function edit(val)
{
   
                        $.ajax({
                            url:'tag',

                            type:'POST',
                            data:{'parentTagid':val},
                            success:function(res)
                            {
                                $('#edit').html(res);
                            }
                            });
}
</script>



<?php // echo site_url('/admin/home/edit_tag/'.$val->name) ?>
<!--<a href="#myModal" role="button" id="mod" style="display: none" class="btn" data-toggle="modal"></a>


<div id="myModal" class="modal hide fade">
<div class="modal-header"><h3>Confirmation</h3></div>   
<div class="modal-body" style="text-align: center">Are you sure?</div>
<div class="modal-footer">
    <a href="<?php //  echo site_url('/admin/home/delete_parenttag/'.$val->id) ?>" class="btn primary">OK</a>
    <input type="button" id="close" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Cancel">
</div>
</div>

<script>
    function cofirmation()
    {
        $('#mod').click();
    }
</script>-->