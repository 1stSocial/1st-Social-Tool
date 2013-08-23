<script>
setTimeout(function(){
       $('#mod1').click();
   },100);
</script>
<?php 
include '/dropdown.php';
?>
<script>
    function updatefun()
    {
        var name = $('#name1').val();
     var parentTag = $('#parentTag1').val();
     var user_id =$('#user_id').val();
     var id = $('#mainid').val();
     var dataval ={
        name : name,
        parentTag : parentTag,
        user_id:user_id,
        id:id
       };
    $.ajax({
       type: "POST",
       url:"home/update_board",
       data:dataval,
       success:function(res){
           if(res == '')
               {
                   setTimeout(function (){
                    $('#cl').click();
                    window.location.href ="home";    
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


<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>

<?php  echo form_open('admin/home/create_board','class="horizontal-form"');  ?>

<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
     <h3 style="margin-left:5px;">Edit Board</h3>
    <p> <? if(isset($success)) echo $success;?> </p>
</div>

<div class="modal-body"><!-- Password input-->
<div class="control-group">
  <?php echo form_label('Board Name:', 'name', array('class' => "control-label") ); ?>
  <div class="controls">
    <input type="text" id="name1" placeholder="Board Name" value="<?=$boardData[0]->name?>" name="name" >
    <input type="hidden" id="mainid" value=<?=$id?> >
  </div>
</div>


<div class="component">
<div class="control-group">
   <?php echo form_label('Board Parent Tag:', 'parent_tag', array('class' => "control-label") ); ?>
  <div class="controls">
   <select data-placeholder="Choose a Partner..." class="chosen-select"  style="width:350px;" tabindex="4" id="parentTag1" name="parentTag1" >
  <option>Select</option>
  <?   if(!empty($parenTag)): 
      
 // echo $boardData[0]->parent_tags;
      foreach($parenTag as $pTag): 
          $selected='';
          if($pTag->name==$boardData[0]->parent_tags){
              $selected='selected';
          }
          ?>    
  <option <?=$selected?> value="<?=$pTag->id?>"><?=$pTag->name?></option>
  <?php endforeach;endif;?>
</select>
   </div>
</div>
</div>
     
<div class="component"><!-- Partner-->
<div class="control-group">
  <?php echo form_label('Board User (Partner):', 'user_id', array('class' => "control-label") ); ?>
  <div class="controls">
    <select data-placeholder="Choose a Partner..." class="chosen-select" multiple style="width:350px;" tabindex="4" id="user_id" name="user_id[]" >
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

</div>
<div class="modal-footer">
    <div class="control-group">
      <input type="button" style="float: right" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close" id="cl">
      <input type="button" style="float: right;position: relative" name="update" class="btn btn-primary" value="Update Board" onclick="updatefun();" />
 
    </div>   
</div>
</div>