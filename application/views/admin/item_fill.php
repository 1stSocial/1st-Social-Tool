<script>
   setTimeout(function(){
       $('#mod1').click();
   },100);
   
   $('#body').redactor();
   
   function _close()
    {
        window.location.href ='./';   
    }
</script>
<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>


<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<?php echo form_open('admin/Item/insert_item'); ?>
<div class="modal-header">

    <h3>Add Item <?=$board_name?></h3> 
</div>
    <div class="modal-body" style=" ">   
    
<input type="hidden" id="tag_id" name="tag_id" value="<?=$tag_id;?>">

 <div class="control-group">
<div class="controls">
     <label style=" float: left;" class="control-label"  >Name :</label>
    <input type="text" id ="item_name"name="name" class="control-label" style="margin-left: 10px;"/> <div id="item_name_error"></div>
</div>
 </div>
     
 <div class="control-group">
<div class="controls">
    <label style=" float: left;" class="control-label"  >Title :</label>
    <input type="text" id="item_title" name="title" class="control-label" style="margin-left: 20px;">
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
<!--<div class="controls" id="taxonomydiv">
    <div>
    <? //  if(!empty($Taxonomy)): foreach($Taxonomy as $val): ?>
    <label style="font-size : 20px" class="label input-mini" >//<?=$val->name?> :</label><br>
    <input type="text" class="input-medium" id="taxo[//<?=$val->name?>]" name="taxo[]"/><br>
    <?php // endforeach;endif;?>
    </div>
</div>-->
 <div class="control-group">
<div class="modal-footer">
   <input type="button" class="btn btn-primary " value="Create Item" onclick="savefun('<?php echo site_url("/admin/item/insert_item/"); ?>')" />
   <input type="button" style="float: right" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn" onclick="_close()">
</div>
 </div>

</form>
<?php /*<script type =" text/javascript" src ="<?= base_url();?>assets/js/custom/add_item.js"></script>*/?>
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

function savefun(ur)
    { ur = ur+'/';
        
        var tag_id = $('#tag_id').val();
     var name = $('#item_name').val();
     var title = $('#item_title').val();
     var body = $('#body').val();
    if(name != ""){
  
    var dataval ={
        tag_id:tag_id, // its to be change ;.l;l;l;l;===
        name : name,
        title:title,
        body:body
    }
   //alert('heloo'+ur+ name);
    $.ajax({
        type: "POST",
       url:ur,
//       contentType: 'json',
       data:dataval,
       success:function(res){ //alert('error - '+ res);
           if(res == '')
               {
                   setTimeout(function (){
                    $('#close').click();
                    
                   },200);
                   
               }  window.location.href ='./';
       },
       error:function(res)
       {
           alert(res);
       }
    });
    }
    else
    {
     $("#error").show();
    }
    }   
    function _close()
    {
        window.location.href ='./';   
    }
</script>