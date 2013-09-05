<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/item_edit.js"></script>

<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>
<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<?php echo form_open(); ?>
<div class="modal-header">
<h3>Edit Item <?=$item['0']['name']?></h3>
</div>
    <div class="modal-body" style="overflow: auto ! important;">
    <div class="control-group">
<div class="controls">
    <label style=" float: left;" class="control-label"  >Name :</label>
    <div style='magrin-top:33px;padding-left:31%;'><input type="text" name="name" id="name" class="control-label" value="<?=$item['0']['name']?>"></div>
</div> 
    </div>
    <div class="control-group">
<div class="controls">
    <label style="float: left;" class="control-label" >Title :</label>
    <div style='magrin-top:33px;padding-left:31%;'><input type="text" name="title" id="title" class="control-label" value="<?=$item['0']['title']?>" ></div>
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
<div class="controls" id="maintaddiv">
    <div id="taddiv">
        <?php 
        $selectArr = array();
        
        foreach($Tag['Parent'] as $data): ?>
        <div style='magrin-top:33px;padding-top:8px;'>
            <label class="control-label" style="float: left;width:165px"> <?=$data['name'];?>  </label>
             <select data-placeholder='Choose...' class=chosen-select multiple  style='width:350px;' id = '<?=$data['id']?>' name=tag[]>
                 <?php if(!empty($Tag['child'])): foreach($Tag['child'] as $val):  if($val['parent_tag_id'] == $data['id']):?>
                    <?php var_dump($item); foreach($item as $maindata):  if($maindata['tag_id'] == $val['id']):
                        $selectArr[]  = $val['id'] ;
                        ?>
                 <option value='<?=$val['id']?>' selected="selected"><?=$val['name']?></option> 
                 <?php else :?>
            <?php endif;endforeach;
            
            if(!in_array($val['id'], $selectArr)):
            ?>
                
                 <option value='<?=$val['id']?>'><?=$val['name']?></option>
                
                     <?php endif; endif;endforeach;endif;?> 
            </select>
        <?php endforeach;?>        
        </div>
    </div>
</div>    
 
<div class="controls" id="taxonomydiv">
    <div id="taxodiv" style="padding-top: 5px">
    <? if(!empty($Taxonomy)): foreach($Taxonomy as $val): ?>
    <label style=" float: left;" class="control-label" ><?=$val['name']?> :</label>
    <div style='magrin-top:33px;padding-left:31%;'><input type="text" style="float:left;width:69%" class="control-label" id="<?=$val['id']?>" name="taxo" value="<?=$val['ival']?>"/><div id="<?=$val['id']?>d"></div><div style="clear: both"></div></div>
    <?php endforeach;endif;?>
    
</div>    
</div>
</div>   
<div class="modal-footer">
    <div class="control-group div_wrapper">
    <input type="button" style="margin-left: 13%" class="btn btn-primary footer_btn" value="Update Item" onclick="savefun('<?php echo site_url("/admin/item/update_item/"); ?>')" />
    <input type="button" class="close btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn">
</div>
</div>
   
</div>

