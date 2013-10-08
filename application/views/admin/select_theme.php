<?php echo form_open(site_url() . '/admin/setting/theme'); ?> 
<table id="tab_id" class="table table-striped ">
    <thead>
        <tr>
            <th>Theme Id</th> 
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <? if (!empty($theme_data)): foreach ($theme_data as $Theme): ?>

                <tr>
                    <td><?= $Theme->id ?></td>  
                    <td><?= $Theme->theme_name ?></td>
                    <td><div class="btn-group"> <a href="<?php echo site_url('/admin/setting/edit_theme/' . $Theme->id) ?>" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a><a onclick="return confirm('Are you sure?')" href="<?php echo site_url('/admin/home/delete_parenttag/' . $Theme->id) ?>"class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
                </tr>
            <? endforeach;
        endif; ?> 
    </tbody>
</table>  
<input type="submit" id="create" name="create" class="btn btn-primary" value="Create Theme" style="display: none;float: left;">

<?php echo form_close(); ?>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/select_theme.js"></script>

<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>


<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
        <div class="modal-content"> 
    <div class="modal-header">
        <h3 style="margin-left:33%;">Select Theme</h3>

    </div>
    <div class="modal-body">
        <div class="div_wrapper">

            <div style="height: 30px"></div>
            <div class="control-group">
<?php echo form_label('Theme :', 'name', array('class' => "control-label",'style'=>'float:left')); ?>
                <div class="controls" style="margin-left: 20%">
                    <select data-placeholder="Choose a theme..." class="chosen-select" tabindex="4" id="theme" name="theme" >
                        
                        <option value='0'>Default</option>
                        <? if (!empty($theme_data)): foreach ($theme_data as $Theme): ?>
                                <option value="<?= $Theme->id ?>"><?= $Theme->theme_name ?></option>
    <?php endforeach;
endif; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <div class="control-group div_wrapper">
             <input type="button" style="margin-left: 20%" id="selectbtn" name="add" class="btn btn-primary footer_btn" value="Select Theme" />
            <input type="button" class=" btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn">
        </div>     

    </div>
    <input type ="hidden" id="ur" value="<?php echo site_url(); ?>">
</div>
</div>
    </div>
