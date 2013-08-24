<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/create_item.js"></script>
<?php echo form_open('admin/Item/fill_value','additem');?>
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
<input type="submit" value="Create" id="sub" name="sub" class="btn btn-primary">
<?php echo form_close();?>