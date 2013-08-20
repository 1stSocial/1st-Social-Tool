<script>
   setTimeout(function(){
       $('#mod1').click();
   },100);
</script>
<?php echo form_open('admin/home/update_tags',array('name' => 'myform')); ?>
<input type='hidden' id='par' name='par' value=<?php echo $parentTagid; ?>>
<a href="#myModal"  role="button" id="mod1"  class="btn" data-toggle="modal" value="add"></a>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="modal-header">
<h3 id="myModalLabel">Edit Tag</h3>
</div>
<div class="modal-body">
    
 <?php echo form_label('Parent Tag :', 'ptag', array('class' => "control-label")); ?>
    <input type="text" style="float: left" id="parenttag" value="<?=$parentTag?>" name="parenttag">
    <div><?php echo validation_errors(); ?></div>
    <label id="msg" class="control-label"></label>

  <?php echo form_label('Child Tags:', 'ctag', array('class' => "control-label",'style'=>"clear:both") ); ?>
  <div id="con">
    
 <?php $value1 = 0;
     if(is_array($child) && !empty($child)): 
     foreach ($child as $val): ?>
      <div class="control-group" id="d<?php echo $value1;?>">
      <input type="text"  placeholder="ChildTag" id="childid[]" name="childtag[]" value="<?=$val->name?>" >
      <input type="button" name="delete" id="<?php echo $value1; ?>" class="btn btn-primary" class="btn btn-primary" value="Delete" onclick="deltag(<?php echo $value1; ?>)">
    </div>
   
<?php $value1++; endforeach; endif; ?>
   </div>
 
</div>
    <div class="modal-footer">
        <input type="button" id="updatebtn" name="update" class="btn btn-primary" onclick="updatefun()" value="Update">
        <input type="button" id="close" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close">
    </div>
</div>

<script>
    function deltag(id)
    {
        var del = "#d"+id; 
        $(del).fadeOut(300,function () { $(del).remove();}).fadeIn(200);
    }
    
    function updatefun()
    {
     var parentid = $("#par").val();   
     var parenttag = $('#parenttag').val();
     var child ="";
     $('#con').find('input[type=text]').each(function() { 
          
        child += this.value+',';
    });
    var dataval ={
        parentTagid: parentid,
        parenttag : parenttag,
        child : child      
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
            alert(res);
    },
        
       error:function(res)
       {
           alert(res);
       }
    });
    }
</script>
