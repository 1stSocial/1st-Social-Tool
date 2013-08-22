<table class="table table-striped ">
        <thead>
          <tr>
              <th>Tag Id</th> 
            <th>Parent Tag</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php if(is_array($parentTags) && !empty($parentTags)): 
                foreach ($parentTags as $val): ?>
          <tr>
            <td><?=$val->id?></td>  
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
                            data:{'id':val},
                            success:function(res)
                            {
                                $('#edit').html(res);
                            }
                            });
}
</script>
<script>
   
    function savefun()
    {
     var name = $('#name').val();
     var id = $('#id').val();
     
     var dataval ={
        parenttag : name,
        Parentid : id      
       };
    $.ajax({
        type: "POST",
       url:"create_Tags",
       data:dataval,
       success:function(res){
           if(res == '')
               {
                   setTimeout(function (){
                    $('#close').click();
                    window.location.href ='index';    
                   },200);
                   
               }
        else
        $('#msg').text(res);
        },
       error:function(res)
       {
           alert(res);
       }
    });
    }
</script>



           