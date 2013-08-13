<h3 style="margin-left:5px;">Create Board</h3>

 <div class="row-fluid">  
    <p> <? if(isset($success)) echo $success;?> </p>
<?php  echo form_open('admin/home/create_board','class="horizontal-form"');  ?>
<div class="component"><!-- Password input-->
<div class="control-group">
  <?php echo form_label('Board Name:', 'name', array('class' => "control-label") ); ?>
  <div class="controls">
    <input type="text"  placeholder="Board Name" name="name" >
   </div>
</div>
</div>

<div class="component">
<div class="control-group">
   <?php echo form_label('Board Parent Tag:', 'parent_tag', array('class' => "control-label") ); ?>
  <div class="controls">
    <select id="parentTag" name="parentTag" >
  <option>Select</option>
  <?  if(!empty($parenTag)): foreach($parenTag as $parentTag): ?>
  <option value="<?=$parentTag->name?>"><?=$parentTag->name?></option>
  <?php endforeach;endif;?>
</select>
   </div>
</div>
</div>
     
<div class="component">
<div class="control-group">
   <?php echo form_label('Board Child Tag:', 'child_tag', array('class' => "control-label") ); ?>
  <div class="controls">
    <select  id="childTagsId" name="tagId" >
  <option>Select</option>
  <?  if(!empty($parenTag)): foreach($parenTag as $parentTag): ?>
  <option value="<?=$parentTag->name?>"><?=$parentTag->name?></option>
  <?php endforeach;endif;?>
</select>
   </div>
</div>
</div>     

<div class="component"><!-- Partner-->
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
</div>


<div class="control-group"> 
  <div class="controls">
            <input type="submit" name="save" class="btn btn-primary" class="btn btn-primary" value="Create Board" />
        </div>
  </div>
</div>