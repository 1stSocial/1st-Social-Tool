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
            <?php if(is_array($items) && !empty($items)): 
                foreach ($items as $val): ?>
          <tr>
           
            <td><?=$val->name?></td>
             <td><?=$val->title?></td>  
             <td><div style=" height:70px;   overflow: scroll;"><?=$val->body?></div></td> 
              <td><?=$val->created_by?></td>  
               <td><?=$val->status?></td>  
               <td><?=$val->createdTime?></td>  <? /*  href=".$val->id) ?>"  , */?>
               <td><div class="btn-group"> <a onclick="edit('<?php echo site_url('/admin/item/edit_item/'); ?>','<?php echo $val->id; ?>')" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a><a onclick="return confirm('Are you sure?')" href="<?php echo site_url('/admin/item/delete_item/'.$val->id) ?>"class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
   </tr>
          <? endforeach;endif;?>
        </tbody>
      </table>
<script>
    
$(document).ready(function(){
  $('#tab_id').dataTable( {
    "sPaginationType": "full_numbers"
        } );
  $("#tab_id_info").css("width","550px");
$("#tab_id_length").css("width","500px");
        $('.dataTables_length').insertAfter($("#tab_id_info"));
         $('#tab_id_length').show();
});
    
   function edit(ur,id){
       ur = ur+'/'+id;
     // alert(ur+id+";");
        
        
  $.ajax({ url:ur,
      
      type:'POST',
  success:function(res)
  { //alert(res);
 $('#item_edit').html(res);
    }
        });      
   }
</script>
    
<div id="item_edit"style="position: absolute;left:-500px;top:-1000px;">
    
</div>
