<table class="table table-striped ">
        <thead>
          <tr>
            <th>Taxonomy Name</th>
           
            
            
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php
            if(is_array($taxonomy) && !empty($taxonomy)): 
                foreach ($taxonomy as $val): ?>
          <tr>
            <td><?=$val->name?></td>
         
            
         
            <td><div class="btn-group"><a onclick="edit(<?=$val->id?>)" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a><a onclick="return confirm('Are you sure?')" href="<?php echo site_url('taxonomy/delete_taxonomy/'.$val->id) ?>"class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
          </tr>
          <? endforeach;endif;?>
        </tbody>
      </table>
<div id="edit" style="position: absolute;left:-500px;top:-1000px;">
    
</div>
<script>
function edit(val)
{ 
                  var newurl =  document.URL.toString().split("/index/addtaxonomy");
                      
                        $.ajax({
                            url: newurl[0]+'/get_taxonomy',
                            type:'POST',
                            data:{'id':val},
                            success:function(res)
                            {
                                $('#edit').html(res);
                            }
                            });
}
</script>

<?php
if(isset($option))
switch ($option) 
{
    case 'addtaxonomy':
    {
        echo "<script>
   setTimeout(function(){
    $('#mod1').click();
   },100);</script>";
    }
        break;
    
    default:
        break;
}
?>
    <a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>

    
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php //echo form_open('','class="horizontal-form"');?>
<div class="modal-header">
    <h3 style="margin-left:5px;">Create Taxonomy</h3>
    <p> <? if(isset($success)) echo $success;?> </p>
</div>
    <div id="con" class="modal-body"><!-- Password input-->
        <div class="control-group">
     <?php echo form_label('Name:', 'name', array('class' => "control-label",'style'=>"float:left;margin-left:10px") ); ?> 
            </div>
  <div class="controls" style="float:left;">
      <input type="text" style="margin-left: 20px"  class = "control-label" placeholder="Taxonomy Name" id="name" name="name" >
  </div>
           
       <div id="error" style ="color:red; display: none;  ">Enter Taxonomy Name</div> 
        
            
        
        
        <div class="control-group"> 
  <div class="controls">
      <input type="button" style="float: left; margin-left:170px; " name="save" class="btn btn-primary" value="Create Taxonomy" onclick="savefun()" />
      <input type="button" id="close" style="float: left;" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close" onclick="c()">      
     
        </div>
  </div> 
        
    </div>
    </form>
<script>
 function savefun()
    {
     var taxonomyname = $('#name').val();
    if(taxonomyname != ""){
     
    var dataval ={
        taxonomyname : taxonomyname,
        
    }

    $.ajax({
        type: "POST",
       url:"../add_taxonomy",
//       contentType: 'json',
       data:dataval,
       success:function(res){
           if(res == '')
               {
                   setTimeout(function (){
                    $('#close').click();
                   window.location.href ='../';    
                   },200);
                   
               }
       },
       error:function(res)
       {
           alert(res);
       }
    });
    }
    else
    {
     $("#error").show();
    }
    }   
    function c()
    {
        window.location.href ='../';   
    }
</script>
    </div>
    