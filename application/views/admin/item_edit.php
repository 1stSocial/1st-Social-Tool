<script>
   setTimeout(function(){
       $('#mod1').click();
   },100);
   
   $('#body').redactor();
</script>
<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>


<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php echo form_open(); ?>
<div class="modal-header">
<h3>Edit Item <?=$name?></h3>
</div>
<div class="modal-body">
    <div class="control-group">
<div class="controls">
    <label style=" float: left;" class="control-label"  >Name :</label>
    <input type="text" name="name" id="name" class="control-label" value="<?=$name?>">
</div> 
    </div>
    
    <div class="control-group">
<div class="controls">
    <label style="float: left;" class="control-label" >Title :</label>
    <input type="text" name="title" id="title" class="control-label" value="<?=$title?>" >
</div>
    </div>
    
    <div class="control-group">
<div class="controls">
    <label style="float: left;" class="control-label " >body :</label>
    <div style="height: 200px; width: auto; overflow: scroll" >
    <textarea id="body" name="body"><?=$body?></textarea>
    <input type="hidden" value="<?=$item_id?>" name="id" id="item_id">
</div>
</div>
    </div>
<div class="control-group">
<div class="modal-footer">
    <input type="button" class="btn btn-primary " value="Update Item" onclick="savefun('<?php echo site_url("/admin/item/update_item/"); ?>')" />
    <input type="button" style="float: right" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn">
</div>
</div>
    </div>
</div>

<script>

function savefun(ur)
    { var id = $('#item_id').val();
     var itemname = $('#name').val();
     var title = $('#title').val();
     var body = $('#body').val();
    if(itemname != ""){
     
    var dataval ={
        id:id, // its to be change ;.l;l;l;l;===
        name : itemname,
        title:title,
        body:body
    }

    $.ajax({
        type: "POST",
       url:ur,
//       contentType: 'json',
       data:dataval,
       success:function(res){
           if(res == '')
               {
                   setTimeout(function (){
                    $('#closebtn').click();
                    window.location.href ='./';
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
    function _close()
    {
        window.location.href ='./';   
    }
</script>