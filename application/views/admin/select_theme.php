<style>
    .my_wrapper
    {
         text-align:0px auto;
         margin:0 auto;
         height: 100px;
    }
    .modal-body
    {
        height: auto;
    }
</style>
<?php echo form_open(site_url().'/admin/setting/theme'); ?> 
<table id="tab_id" class="table table-striped ">
        <thead>
          <tr>
              <th>Theme Id</th> 
            <th>Name</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
             <?  if(!empty($theme_data)): foreach($theme_data as $Theme): ?>
               
          <tr>
            <td><?=$Theme->id?></td>  
            <td><?=$Theme->theme_name?></td>
            <td><div class="btn-group"> <a href="<?php echo site_url('/admin/setting/edit_theme/' . $Theme->id) ?>" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a><a onclick="return confirm('Are you sure?')" href="<?php echo site_url('/admin/home/delete_parenttag/'.$Theme->id) ?>"class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
   </tr>
          <? endforeach;endif;?>
        </tbody>
      </table>  
<input type="submit" id="create" name="create" class="btn btn-primary" value="Create Theme" style="display: none">

<?php echo form_close();?>
<script type="text/javascript" src="<?= base_url();?>assets/js/custom/select_theme.js"> </script>

<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>


<div id="myModal1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-header">
    <h3 style="margin-left:5px;">Select Theme</h3>
    <!--<p> <? // if(isset($success)) echo $success;?> </p>-->
</div>
<div class="modal-body">
    <div class="my_wrapper">
<!-- Password input-->
<div style="height: 30px"></div>
<div class="control-group">
   <?php echo form_label('Theme :', 'name', array('class' => "control-label",'style'=>'margin-left:106px;margin-right:10px;float:left') ); ?>
  <div class="controls">
     <!-- <select id="parentTag" name="parentTag" onselect="call()">-->
     
 <select data-placeholder="Choose a theme..." class="chosen-select" tabindex="4" id="theme" name="theme" >
  <option value='none'></option>
  <option value='0'>Default</option>
  <?  if(!empty($theme_data)): foreach($theme_data as $Theme): ?>
  <option value="<?=$Theme->id?>"><?=$Theme->theme_name?></option>
  <?php endforeach;endif;?>
</select>
   </div>
</div>
    <!--<div style="height: 50px"></div>-->
</div>
</div>
<div class="modal-footer">
    <div class="control-group">
        <input type="button" style="float: right;margin-left: 0%" class="close btn btn-primary" data-dismiss="modal" aria-hidden="true" value="Close" name="closebtn" id="closebtn">
      <input type="button" style="float: right;position: relative" id="selectbtn" name="add" class="btn btn-primary" value="Select Theme" />
 
    </div>     
  
</div>
    <input type ="hidden" id="ur" value="<?php echo site_url(); ?>">
</div>
    
 