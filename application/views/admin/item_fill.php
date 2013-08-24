<?php echo form_open('admin/Item/insert_item'); ?>
<div class="heading">
<h3>Add Item <?=$board_name?></h3> 
</div>
<div class="controls">
    <label style="font-size : 20px" class="label input-mini" >Name :</label><br>
    <input type="text" name="name" class="input-medium">
</div> 
<div class="controls">
    <label style="font-size : 20px" class="label input-mini" >Title :</label><br>
    <input type="text" name="title" class="input-medium">
</div>
<div class="controls">
    <label style="font-size : 20px" class="label " >body :</label><br>
    <div style="height: 200px; width: auto; overflow: scroll" >
    <textarea id="body" name="body"></textarea>
</div>
</div>
<!--<div class="controls" id="taxonomydiv">
    <div>
    <? //  if(!empty($Taxonomy)): foreach($Taxonomy as $val): ?>
    <label style="font-size : 20px" class="label input-mini" >//<?=$val->name?> :</label><br>
    <input type="text" class="input-medium" id="taxo[//<?=$val->name?>]" name="taxo[]"/><br>
    <?php // endforeach;endif;?>
    </div>
</div>-->

<div class="footer">
    <input type="submit" class="btn btn-primary" value="Create Item">
    <input type="reset" class="btn btn-primary" value="Reset">
</div>

</form>
