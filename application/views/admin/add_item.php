<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/create_item.js"></script>
<script>
   setTimeout(function(){
       $('#mod1').click();
   },100);
   
   $('#body').redactor();
   
   function _close()
    {
        window.location.href ='./';   
    }
</script>
<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>


<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

 <?php echo form_open('admin/Item/fill_value','additem');?>
<div class="modal-header">

    <h3> Create Item </h3>
</div>
    <div class="modal-body" style=" ">   

<br/>
<label class="control-label" style="float: left">Choose Board :</label>
    <?php // echo form_label('Choose Board :', 'Boardlbl', array('class' => "control-label") ); ?>

    <select data-placeholder="Choose a Board..." class="chosen-select" style="width:350px;" tabindex="4" id="board" name="board" >
        <option></option>
        <?  if(!empty($boards)): foreach($boards as $val): ?>
        <option value="<?=$val['board_id']?>"><?=$val['name']?></option>
       
        <?php endforeach;endif;?>
    </select>
<br/><br/>
<div class="control-group">
<div class="modal-footer">
<input type="submit" value="Create" id="sub" name="sub" class="btn btn-primary " >
<input type="button" style="float: right" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn" onclick="_close()">
</div>
</div>
<?php echo form_close();?>
</div>
</div>

<table class="table table-striped ">
        <thead>
          <tr>
            <th>Name</th> 
            <th>Title</th>
            <th>Body</th>
            <th>Created By</th>
            <th>Status</th>
            <th>Created Time</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
            <?php if(is_array($items) && !empty($items)): 
                foreach ($items as $val): ?>
          <tr>
           
            <td><?=$val->name?></td>
             <td><?=$val->title?></td>  
             <td><div style=" height:70px;   overflow: scroll;"><?=$val->body?></div></td> 
              <td><?=$val->created_by?></td>  
               <td><?=$val->status?></td>  
               <td><?=$val->createdTime?></td>  <? /*  href=".$val->id) ?>"  , */?>
               <td><div class="btn-group"> <a onclick="edit('<?php echo site_url('/admin/item/edit_item/'); ?>','<?php echo $val->id; ?>')" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a><a onclick="return confirm('Are you sure?')" href="<?php echo site_url('/admin/item/delete_item/'.$val->id) ?>"class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
   </tr>
          <? endforeach;endif;?>
        </tbody>
      </table>