<script>
   setTimeout(function(){
       $('#mod1').click();
   },100);
</script>


<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>

<?php  echo form_open('admin/home/create_board','class="horizontal-form"');  ?>
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <h3 style="margin-left:5px;">Create Board</h3>
    <p> <? if(isset($success)) echo $success;?> </p>
</div>

<div class="modal-body"><!-- Password input-->

  <?php echo form_label('Board Name:', 'name', array('class' => "control-label",'style'=>"float:left;margin-left:10px") ); ?>
  <div class="controls">
      <input type="text" style="margin-left: 55px"  class = "control-label" placeholder="Board Name" name="name" >
  </div>
<div class="control-group">
   <?php echo form_label('Board Parent Tag:', 'parent_tag', array('class' => "control-label") ); ?>
  <div class="controls">
      <select id="parentTag" name="parentTag" onselect="call()">
  <option>Select</option>
  <?  if(!empty($parenTag)): foreach($parenTag as $parentTag): ?>
  <option value="<?=$parentTag->name?>"><?=$parentTag->name?></option>
  <?php endforeach;endif;?>
</select>
   </div>
</div>

     
<div class="control-group">
   <?php echo form_label('Board Child Tag:', 'child_tag', array('class' => "control-label") ); ?>
  <div class="controls">
    <select  id="childTagsId" multiple name="tagId[]">
  <option>Select</option>
  
</select>
   </div>
</div>

<div class="control-group">
  <?php echo form_label('Board User (Partner):', 'user_id', array('class' => "control-label") ); ?>
  <div class="controls">
    <select  multiple name="user_id[]" >
        <? if(!empty($partners)): foreach($partners as $val):?>
  <option value="<?=$val->id?>"><?=$val->name?></option>
  <? endforeach;endif;?>
</select>
   </div>
</div>
<div class="modal-footer">
      <input type="button" style="float: right" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close">
      <input type="submit" style="float: right;position: relative" name="save" class="btn btn-primary" value="Create Board" />
 </div>     
  
</div>
<script>
    $('#parentTag').change(function()
    {
     $.ajax({
         url:'../child_tag_list',
         type:"post",
         data:{'parent':this.value},
         success:function(res)
         {
             $("#childTagsId").html(res);
         }
     });
        
    });
</script>
</div>
 