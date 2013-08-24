<?php echo form_open('admin/Item','additem');?>
<div class="heading">
    <h3> Create Item </h3>
</div>

<br>

<label class="control-label" style="float: left">Choose Board :</label>
    <?php // echo form_label('Choose Board :', 'Boardlbl', array('class' => "control-label") ); ?>

    <select data-placeholder="Choose a Board..." class="chosen-select" style="width:350px;" tabindex="4" id="board" name="board" >
        <option></option>
        <?  if(!empty($boards)): foreach($boards as $val): ?>
        <option value="<?=$val->board_id?>"><?=$val->board_name?></option>
        <?php endforeach;endif;?>
    </select>

<div class="control-group">
    
</div>
<?php echo form_close();?>