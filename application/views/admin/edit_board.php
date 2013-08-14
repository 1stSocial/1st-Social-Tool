

 <div class="container"> 
     <h3 style="margin-left:5px;">Create Board</h3>
    <p> <? if(isset($success)) echo $success;?> </p>
<?php  echo form_open('admin/home/create_board','class="horizontal-form"');  ?>
<div class="component"><!-- Password input-->
<div class="control-group">
  <?php echo form_label('Board Name:', 'name', array('class' => "control-label") ); ?>
  <div class="controls">
    <input type="text"  placeholder="Board Name" value="<?=$boardData[0]->name?>" name="name" >
   </div>
</div>
</div>

<div class="component">
<div class="control-group">
   <?php echo form_label('Board Parent Tag:', 'parent_tag', array('class' => "control-label") ); ?>
  <div class="controls">
    <select id="parentTag" name="parentTag" >
  <option>Select</option>
  <?   if(!empty($parenTag)): 
      
 // echo $boardData[0]->parent_tags;
      foreach($parenTag as $pTag): 
          $selected='';
          if($pTag->name==$boardData[0]->parent_tags){
              $selected='selected';
          }
          ?>    
  <option <?=$selected?> value="<?=$pTag->name?>"><?=$pTag->name?></option>
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
  <?php  
    if(isset($childTags)&& !empty($childTags)):
        foreach($childTags as $child): 
         $selected='';
         if(!empty($selectedChildTag)){
             foreach($selectedChildTag as $selectChild){
                 if($selectChild->tag_id==$child->id){
                     $selected='selected';
                 }
             }
         }  
        ?>
        <option <?=$selected?> value="<?=$child->id?>"><?=$child->name?></option>
       <? endforeach;
    endif;
  ?>
</select>
   </div>
</div>
</div>     

<div class="component"><!-- Partner-->
<div class="control-group">
  <?php echo form_label('Board User (Partner):', 'user_id', array('class' => "control-label") ); ?>
  <div class="controls">
    <select  multiple name="user_id[]" >
        <? if(!empty($partners)): foreach($partners as $val):
            $selected='';
            if(!empty($selectedPartners)){
                foreach($selectedPartners as $sePartner){
                    if($val->id==$sePartner->user_id){
                        $selected='selected';
                    }
                }
            }
            ?>
  <option  <?=$selected?> value="<?=$val->id?>"><?=$val->name?></option>
  <? endforeach;endif;?>
</select>
   </div>
</div>
</div>


<div class="control-group"> 
  <div class="controls">
            <input type="submit" name="save" class="btn btn-primary" value="Update Board" />
        </div>
  </div>
</div>