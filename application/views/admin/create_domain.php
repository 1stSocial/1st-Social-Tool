<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/create_domain.js"></script>
<table id="tab_id" class="table table-striped ">
    <thead>
        <tr>
            <th>Domain Id</th> 
            <th>Name</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <? if (!empty($domain)): foreach ($domain as $val): ?>
                <tr>
                    <td><?= $val->id ?></td>  
                    <td><?= $val->name ?></td>
                    <td><div class="btn-group"> <a href="<?php echo site_url('/admin/home/edit_domain/' . $val->id) ?>" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a>
                            <a href="javascript:deletbox('<?php echo site_url('/admin/home/delete_domain/' . $val->id)  ?>')" class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
                </tr>
            <?
            endforeach;
        endif;
        ?>
    </tbody>
</table>  

<input type ="hidden" id ="edit_url" value="<?= site_url(); ?>"/>

<div id="create_domian_div">
    
    
    
</div>


<script>
    $(document).ready(function() {
        $('#tab_id').dataTable({
            "sPaginationType": "full_numbers",
        });
        $("#tab_id_info").css("width", "550px");
        $("#tab_id_length").css("width", "500px");
        $("#create").insertBefore($('#tab_id_filter'));
        $('.dataTables_length').insertAfter($("#tab_id_info"));
        $('#create').show();
        $('#tab_id_length').show();
        $('#tab_id_filter').css("margin-right",'1%');
    });

    function deletbox(urllink)
    {
        bootbox.confirm('Are you sure?', function(val) {
            if (val) {
                document.location.href = urllink;
            }
        });
    }
</script>

<?php echo form_open('admin/home/create_domin', array('name' => 'my','id'=>'my')); 
// var_dump($domain);
?>

<a href="#domain1" style="display: none" role="button" id="dom"  class="btn" data-toggle="modal" value="add"></a>

<div id="domain1" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Create Domain</h3>
    </div>

    <div class="modal-body " style="height:100px "><!-- Password input-->
        <div class="div_wrapper">
            <div style="margin-top: 5%" ></div>
        <div class="control-group">
            <?php echo form_label('Domain name :', 'domain', array('class' => "control-label", 'style' => "float:left;padding-right:41px")); ?>
            <div class="controls">
            <input type="text" style="float: left" id="name" placeholder="Name" name="name" title="Please Enter Name" required="Please Enter Name">
                <div style =" color: red; display: none;" id="usererror"></div>
            </div>
        </div>
    </div>
    </div>
   <div class="modal-footer">
        <div class="control-group">  
            <div class="div_wrapper" style="padding-left: 33%">

                <input type="submit" id="updatebtn" class="btn btn-primary footer_btn" value="Create Domain">
                <input type="button" id="closebtn" class="close btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" onclick="close_fun()" value="Close">
            </div>
        </div>
    </div>
    <input type="hidden" value="<?=  site_url();?>" id="url"> 
    
</div>
<?php
echo form_close();
?>