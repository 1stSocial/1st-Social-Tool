<script>
   setTimeout(function(){
       $('#mod1').click();
   },100);
</script>
<?php
include '/admin/dropdown.php';
?>
<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>
<?php echo form_open('taxonomy/add_taxonomy','class="horizontal-form"');?>
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <h3 style="margin-left:5px;">Create Taxonomy</h3>
    <p> <? if(isset($success)) echo $success;?> </p>
</div>
    <div class="modal-body"><!-- Password input-->
        <div class="control-group">
     <?php echo form_label('Name:', 'name', array('class' => "control-label",'style'=>"float:left;margin-left:10px") ); ?>
  <div class="controls">
      <input type="text" style="margin-left: 20px"  class = "control-label" placeholder="Taxonomy Name" name="name" >
  </div>
            </div>
        
        <div class="control-group">
        <?php echo form_label('Type:', 'type', array('class' => "control-label",'style'=>"float:left;margin-left:10px") ); ?>
  <div class="controls">
     
      <select name ="type" style="margin-left: 20px">
           <option>Select</option>
          <option>String</option>
           <option>Integer</option>
          </select>
  </div>
        </div>
            
        <div class="control-group">
       <?php echo form_label('Value:', 'value', array('class' => "control-label",'style'=>"float:left;margin-left:10px") ); ?>
  <div class="controls">
      <input type="text" style="margin-left: 20px"  class = "control-label" placeholder="Taxonomy Value" name="value" >
  </div>
        </div>
        
        <div class="control-group"> 
  <div class="controls">
       <input type="submit" style="float: left; margin-left:0%; " name="save" class="btn btn-primary" value="Create Taxonomy" />
      <input type="button" style="float: left;" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close">      
     
        </div>
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