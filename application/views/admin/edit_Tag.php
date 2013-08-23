<?php
include '/dropdown.php';
?>
<script>
   setTimeout(function(){
       $('#mod1').click();
   },100);
</script>
<?php echo form_open('admin/home/update_tags',array('name' => 'myform')); ?>
<a href="#myModal"  role="button" id="mod1"  class="btn" data-toggle="modal" value="add"></a>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-header">
<h3 id="myModalLabel">Edit Tag</h3>
</div>
<div class="modal-body">
    <br>
    <input type='hidden' id="id" name="id" value=<?=$id?>  >   
 <?php echo form_label('Name :', 'name', array('class' => "control-label")); ?>
    <input type="text" style="float: left" id="name" value="<?=$name;?>" name="name">
    <div><?php echo validation_errors(); ?></div>
    <label id="msg" class="control-label"></label>
<div class="control-group">
  <?php echo form_label('Parent Tag:', 'parentid', array('class' => "control-label",'style'=>"clear:both") ); ?>
   <?php /* <input type="text" style="float: left" id="parentid" value="<?php if($parentid)echo $parentid;?>" name="parentid"> */ ?>
   <div class="controls">  
 <select data-placeholder="Choose a Partner..." class="chosen-select" style="width:350px;" tabindex="4" id="parentTag1" name="parentTag1">
  <option value="0">No Parent</option>
  <?if(!empty($parenTag)): foreach($parenTag as $key => $Tag): ?>
  <option value="<?=$key?>"><?=$Tag?></option>
  <?php endforeach;endif;?>
</select>
   </div>
</div>
<br>
<br>
    <div class="modal-footer">
        <input type="button" id="updatebtn" name="update" class="btn btn-primary" onclick="updatefun();" value="Update">
        <input type="button" id="close" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close">
    </div>

</div> 
<script>
   
    function updatefun()
    {
     var id = $("#id").val();   
     var name = $('#name').val();
     var pid = $('#parentTag1').val();
    var dataval ={
        id: id,
        name : name,
        pid : pid     
    };
    $.ajax({
        type: "POST",
       url:"update_Tag",
//       contentType: 'json',
       data:dataval,
       success:function(res){
           if(res == '')
               {
                   setTimeout(function (){
                    $('#close').click();
                    window.location.href ='index';    
                   },200);
                   
               }
    },
        error:function(res)
       {
           alert(res);
       }
    });
    }
</script>
