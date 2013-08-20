<script>
   setTimeout(function(){
       $('#mod1').click();
   },100);
</script>


<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>
<?php echo form_open('taxonomy/edit_taxonomy','class="horizontal-form"');?>
<input type="hidden" id="id" value="<?php echo $taxonomy_id ; ?>" name="id" >
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <h3 style="margin-left:5px;">Edit Taxonomy</h3>
    <p> <? if(isset($success)) echo $success;?> </p>
</div>
    <div class="modal-body"><!-- Password input-->
        <div class="control-group">
     <?php echo form_label('Name:', 'name', array('class' => "control-label",'style'=>"float:left;margin-left:10px") ); ?>
  <div class="controls">
      <input type="text" style="margin-left: 20px"  class = "control-label" value="<?php if(isset($name)){echo $name;} ?>" name="name" id="name" >
  </div>
            </div>
        
        <div class="control-group">
        <?php echo form_label('Type:', 'type', array('class' => "control-label",'style'=>"float:left;margin-left:10px") ); ?>
  <div class="controls">
     
      <select name ="type" style="margin-left: 20px" id="selectid"> 
           <option>Select</option>
          <option>String</option>
           <option>Integer</option>
          </select>
  </div>
        </div>
            
        <div class="control-group">
       <?php echo form_label('Value:', 'value', array('class' => "control-label",'style'=>"float:left;margin-left:10px") ); ?>
  <div class="controls">
      <input type="text" style="margin-left: 20px"  class = "control-label" value="<?php if(isset($value)){echo $value;} ?>" name="value"  id="texoval">
  </div>
        </div>
        
        <div class="control-group"> 
  <div class="controls">
      <input type="button" style="float: left; margin-left:170px;  " name="save" class="btn btn-primary" value="Update Taxonomy" onclick="savefun()" />
      <input type="button" style="float: left;" id="close"  class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close">      
     
        </div>
  </div> 
        
    </div>
    
    </div>

<script>
 function savefun()
    {
     var taxonomyname = $('#name').val();
     var taxonomytype =$('#selectid').val();
     var taxonomyvalue = $('#texoval').val();
     var id=$("#id").val();
     
    var dataval ={
        taxonomyname : taxonomyname,
        taxonomytype : taxonomytype,
        taxonomyvalue : taxonomyvalue,
        id:id
    }

    $.ajax({
        type: "POST",
       url:"edit_taxonomy",
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