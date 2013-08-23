<script>
   setTimeout(function(){
       $('#mod1').click();
   },100);
</script>


<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>
<?php// echo form_open('','class="horizontal-form"');?>
<input type="hidden" id="id" value="<?php echo $id ; ?>" name="id" >
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <h3 style="margin-left:5px;">Edit Taxonomy</h3>
    <p> <? if(isset($success)) echo $success;?> </p>
</div>
    <div class="modal-body"><!-- Password input-->
        <div class="control-group">
     <?php echo form_label('Name:', 'name', array('class' => "control-label",'style'=>"float:left;margin-left:10px") ); ?>
  <div class="controls" style="float:left;">
      <input type="text" style="margin-left: 55px"  class = "control-label" value="<?php if(isset($name)){echo $name;} ?>" name="name" id="name" >
  </div> <div id="error" style ="color:red; display: none;  ">Enter Taxonomy Name</div> 
            </div>
       <div style="clear: both;"></div> 
    <div class="control-group">
   <?php echo form_label('Type:', 'type', array('class' => "control-label",'style'=>"float:left;margin-left:10px;") ); ?>
  <div class="controls">
      <select id="type" name="type" style="margin-left: 60px;">
  <option value="select">Select</option>
  <option value="string">String</option>
  <option value="Integer">Intreger</option>
</select>
   </div>
</div>    
       
    <div class="control-group">
   <?php echo form_label('Parent Tag:', 'parent_tag', array('class' => "control-label",'style'=>"float:left;margin-left:10px;") ); ?>
  <div class="controls">
      <select id="parentTag" name="parentTag"  style="margin-left: 22px;">
  <option>Select</option>
  <?  if(!empty($parenTag)): foreach($parenTag as $key => $Tag): ?>
  <option value="<?=$key?>"><?=$Tag?></option>
  <?php endforeach;endif;?>
</select>
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
<input type ="hidden" id ="ur" value="<? echo site_url('/taxonomy/edit_taxonomy'); ?>"/>
<input type ="hidden" id ="ur2" value="<? echo site_url('/taxonomy'); ?>"/>
<script>
 function savefun()
    {
     var taxonomyname = $('#name').val();
     var type = $('#type').val();
     var tag_id = $('#parentTag').val();
      if(taxonomyname != ""){
     var id=$("#id").val() ;
     var ur = $('#ur').val();
    var ur2 = $('#ur2').val();

    $.ajax({
        type: "POST",
       url:ur,
       data:{
        taxonomyname : taxonomyname, 
        type:type,
        tag_id:tag_id,
     
        id:id
    },
       success:function(res){
           if(res == '')
               {
                   setTimeout(function (){
                    $('#close').click();
                 
                   },200);
                   
               }
    window.location.href =ur2;    
       },
       error:function(res)
       {
           alert(res);
       }
    }); }
    else
    {
     $("#error").show();
    }
    
    
}   
</script>