<!--<script src="js/jquery/jquery.tablesorter.min.js"></script>
<script >
  $(function() {
    $("table#sortTableExample").tablesorter({ sortList: [[1,0]] });
  });
</script> -->
<script>
    function addchildtag()
    {
        var add ="<div><input type=button name=add id=addnew class='btn btn-primary' value=+ onclick=addchildtag()>"
      +"<input type=text id='childid[]'  placeholder=ChildTag name='childtag[]' ></div>";
               
        $('#con').append(add); 
    }
    
   
    function savefun()
    {
     var parenttag = $('#parenttag').val();
     var child ="";
     $('#con').find('input[type=text]').each(function() { 
          
        child += this.value+',';
    });
    var dataval ={
        parenttag : parenttag,
        child : child      
    }
//    alert(childtag);
    $.ajax({
        type: "POST",
       url:"../create_Tags",
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
        else
        $('#msg').text(res);
        },
       error:function(res)
       {
//           alert(res);
       }
    });
    }
</script>

<table class="table table-striped ">
        <thead>
          <tr>
            <th>Board Name</th>
            <th>Board Parent Tag</th>
            <th>Created By</th>
            <th>Created Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php if(is_array($boards) && !empty($boards)): 
                foreach ($boards as $val): ?>
          <tr>
            <td><?=$val->board_name?></td>
            <td><?=$val->parent_tags?></td>
            <td><?=$val->user_name?></td>
            <td><? echo date('d-m-Y',  strtotime($val->createdTime));?></td>
            <td><div class="btn-group"> <a href="<?php echo site_url('/admin/home/edit_board/'.$val->board_id) ?>"class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a><a onclick="return confirm('Are you sure?')" href="<?php echo site_url('/admin/home/delete_board/'.$val->board_id) ?>"class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
          </tr>
          <? endforeach;endif;?>
        </tbody>
      </table>
</table>
<?php
switch ($option) 
{
    case 'createtag':
    {
        echo "<script>
   setTimeout(function(){
       $('#mod').click();
   },100);
</script>";
    }
        break;
    case 'createbord':
    {
        echo "
            <script>
    $.ajax({
       url:'../create_board',
       type:'POST',
       success:function(res)
       {
           $('#createboard').html(res);
       }
    });
</script>    
            ";
    }
    break;
    default:
        break;
}
?>

<a href="#myModal" role="button" id="mod" style="display: none" class="btn" data-toggle="modal"></a>


<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php echo form_open('admin/home/create_tags',array('name' => 'myform')); ?>

<div class="modal-header">
<h3 id="myModalLabel">Create Tag</h3>
</div>
<div class="modal-body">
    
 <?php echo form_label('Parent Tag :', 'ptag', array('class' => "control-label") ); ?>
    <input type="text" style="float: left" id="parenttag" placeholder="ParentTag" name="parenttag" onblur="check()">
    <div><?php echo validation_errors(); ?></div>
    <label id="msg" class="control-label"></label>

  <?php echo form_label('Child Tags:', 'ctag', array('class' => "control-label",'style'=>"clear:both") ); ?>
  <div id="con">
     <div><input type="button" name="add" id="addnew" class="btn btn-primary" class="btn btn-primary" value="+" onclick="addchildtag()"/>
      <input type="text"  placeholder="ChildTag" id="childid[]" name="childtag[]" value="" >
      </div>
   </div>


    <div class="modal-footer">
        <input type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true" value="Close">
        <input type="button" id="savebtn" name="save" class="btn btn-primary" value="Create Tag" onclick="savefun()">
    </div>
</div>
<?php form_close();?>
</div>


<div id="createboard"></div>

