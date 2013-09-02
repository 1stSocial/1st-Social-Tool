<table id="tab_id" class="table table-striped ">
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
<input type ="hidden" id ="edit_url" value="<?= site_url('/admin/home/tag');?>"/> 
<div id="edit" style="position: absolute;left:-500px;top:-1000px">
    
</div>
<script>

$(document).ready(function(){
    $('#tab_id').dataTable( {
    "sPaginationType": "full_numbers"
  } );
    $('#tab_id_length').show();
});
    
function edit(val)
{
   edit_url = $('#edit_url').val();
 //  alert(edit_url);
                        $.ajax({
                            url:edit_url,

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
function cl()
{
     var uri = $('#ur').val();   
     window.location.href =uri;   
}
   
    function savefun()
    { 
        var uri = $('#ur').val();

     var name = $('#name').val();
     var id = $('#parentTag').val();
     if(name != ""){
     var dataval ={
        parenttag : name,
        Parentid : id      
       }
    $.ajax({
        type: "POST",
       url:"../create_Tags",
       data:dataval,
       success:function(res){
           if(res == '')
               {
                   setTimeout(function (){
                    $('#close').click();
                    window.location.href =uri;    
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
    else
    {
      $('#error').show();
    }
    }
</script>


<?php
switch ($option) 
{
    case 'createtag':
    {
        echo "<script>
   setTimeout(function(){
       $('#mod').click();
   },100);
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
<?php echo form_open('admin/home/create_tags',array('name' => 'myform')); ?>

<div class="modal-header">
<h3 id="myModalLabel">Create Tag</h3>
</div>
<div class="modal-body">
    <br>
 <?php echo form_label('Name :', 'nametag', array('class' => "control-label") ); ?>
    <input type="text" style="float: left" id="name" placeholder="TagName" name="name" onblur="check()">
    <div><?php echo validation_errors(); ?></div> <div style =" color: red; display: none;" id="error"> Enter tag Name </div>
    <label id="msg" class="control-label"></label>

  <?php echo form_label('Parent Tag :', 'id', array('class' => "control-label",'style'=>"clear:both") ); ?>
    <?php //  <input type="text"  placeholder="Parent Id" id="id" name="id" value=""> ?>
     
      <div class="controls">
      <select data-placeholder="Choose a Parent Tag..." class="chosen-select" style="width:350px;" tabindex="4" id="parentTag" name="parentTag" onselect="call()" style="margin-left:px;">
          <option value="0">No Parent</option>
  <?  if(!empty($parenTag)): foreach($parenTag as $key => $Tag): ?>
  <option value="<?=$key?>"><?=$Tag?></option>
  <?php endforeach;endif;?>
</select>
   </div>
<br><br>  


    <div class="modal-footer">
        <input type="button" id="savebtn" name="save" class="btn btn-primary" value="Create Tag" onclick="savefun()">
        <input type="button" id="close" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close" onclick="cl()">
    </div>
</div>
<?php form_close();?>
</div>

<input type="hidden" id="ur" value="<?= site_url('/admin/home/tag_Management')?>">
<input type="hidden" id="editurl" value="<?= site_url('/admin/home/edit_board')?>">
<div id="edit1"></div>
<div id="createboard"></div>          