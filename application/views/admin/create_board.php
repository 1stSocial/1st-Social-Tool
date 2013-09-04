<?php
include '/dropdown.php';
?>

<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/create_board.js"></script>

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
      <input type="text" style="margin-left: 55px"  class = "control-label" placeholder="Board Name" id="name1" name="name" >
  </div>
<div class="control-group">
   <?php echo form_label('Board Parent Tag:', 'parent_tag', array('class' => "control-label") ); ?>
  <div class="controls">
     <!-- <select id="parentTag" name="parentTag" onselect="call()">-->
     
 <select data-placeholder="Choose a Parent Tag..." class="chosen-select" style="width:350px;" tabindex="4" id="parentTag1" name="parentTag1" >
  <option>Select</option>
  <?  if(!empty($parenTag)): foreach($parenTag as $key => $Tag): ?>
  <option value="<?=$key?>"><?=$Tag?></option>
  <?php endforeach;endif;?>
</select>
   </div>
</div>



<div class="control-group">
  <?php echo form_label('Board User (Partner):', 'user_id1', array('class' => "control-label") ); ?>
  <div class="controls">
    <select data-placeholder="Choose a Partner..." class="chosen-select" multiple style="width:350px;" tabindex="4" id="user_id" name="user_id[]" >
      <!--<select  multiple id="user_id" name="user_id[]" >-->
        <? if(!empty($partners)): foreach($partners as $val):?>
  <option value="<?=$val->id?>"><?=$val->name?></option>
  <? endforeach;endif;?>
</select>
   </div>
</div>
    
    
<div class="modal-footer">
    <div class="control-group">
        <input type="button" style="float: right;margin-left: 0%" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn">
      <input type="button" style="float: right;position: relative" id="add" name="add" class="btn btn-primary" value="Create Board" onclick="savefun();" />
 
    </div>     
  
</div>
    <input type ="hidden" id="ur" value="<?php echo site_url('/admin/home'); ?>">
</div>
 