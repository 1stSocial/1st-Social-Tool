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
<h3>Edit Item <?=$item['0']['name']?></h3>
</div>
<div class="modal-body">
    <div class="control-group">
<div class="controls">
    <label style=" float: left;" class="control-label"  >Name :</label>
    <input type="text" name="name" id="name" class="control-label" value="<?=$item['0']['name']?>">
</div> 
    </div>
    
    <div class="control-group">
<div class="controls">
    <label style="float: left;" class="control-label" >Title :</label>
    <input type="text" name="title" id="title" class="control-label" value="<?=$item['0']['title']?>" >
</div>
    </div>
    
    <div class="control-group">
<div class="controls">
    <label style="float: left;" class="control-label " >body :</label>
    <div style="height: 200px; width: auto; overflow: scroll" >
        <textarea id="body" name="body"><?=$item['0']['body']?></textarea>
        <input type="hidden" value="<?=$item['0']['item_id']?>" name="id" id="item_id">
    </div>
</div>
 </div>
 
<div class="controls" id="taxonomydiv">
    <div id="taxodiv">
    <? if(!empty($Taxonomy)): foreach($Taxonomy as $val): ?>
    <label style=" float: left;" class="control-label" ><?=$val['name']?> :</label>
    <div> <input type="text" style="float:left" class="control-label" style="margin-left: 20px;" id="<?=$val['id']?>" name="taxo" value="<?=$val['ival']?>"/><div id="<?=$val['id']?>d"></div><div style="clear: both"></div><br>
    <?php endforeach;endif;?>
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
     var taxo = [];
//var arrayB = new Array();
     $('#taxodiv').find('input:text')
        .each(function() {
             taxo[this.id] = $(this).val();
        });
        
    if(itemname != ""){
     
    var dataval ={
        id:id, // its to be change ;.l;l;l;l;===
        name : itemname,
        title:title,
        body:body,
        taxo : taxo
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
               else
               {
                 var obj = jQuery.parseJSON(res);
//                 alert(obj);
                 for(var i=0;i<obj.length;i++)
                     {
                         var val = obj[i].split(":");
                         $id = "#"+val[0]+"d";
                         $($id).html(val[1]);
						 
                     }
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