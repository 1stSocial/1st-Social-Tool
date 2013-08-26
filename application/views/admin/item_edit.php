<?php echo form_open('admin/Item/update_item'); ?>
<div class="heading">
<h3>Edit Item <?=$name?></h3>
</div>

<div class="controls">
    <label style="font-size : 20px" class="label input-mini" >Name :</label><br>
    <input type="text" name="name" class="input-medium" value="<?=$name?>">
</div> 
<div class="controls">
    <label style="font-size : 20px" class="label input-mini" >Title :</label><br>
    <input type="text" name="title" class="input-medium" value="<?=$title?>">
</div>
<div class="controls">
    <label style="font-size : 20px" class="label " >body :</label><br>
    <div style="height: 200px; width: auto; overflow: scroll" >
    <textarea id="body" name="body"><?=$body?></textarea>
    <input type="hidden" value="<?=$item_id?>" name="id" id="item_id">
</div>
</div>
</div>
<div class="footer">
    <input type="submit" class="btn btn-primary" value="Update Item">
    
</div>