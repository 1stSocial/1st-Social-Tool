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
        $("#tab_id_info").css("width", "20%");
        $("#tab_id_info").css("float", "left");
        $("#tab_id_length").css("width", "20%");
        $("#tab_id_length").css("margin-left", "20%");
        $("#tab_id_info").attr("class", "btn btn-info");
        $("#create").insertBefore($('#tab_id_filter'));
        $('.dataTables_length').insertAfter($("#tab_id_info"));
        $('#create').show();
        $('#tab_id_length').show();
        $('#tab_id_filter').css("margin-right",'1%');
           $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});  
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

<div id="domain1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="myModalLabel" style="margin-left: 33%">Create Domain</h3>
                </div>

    <div class="modal-body " style="height:100px "><!-- Password input-->
        <div class="div_wrapper">
            <div style="margin-top: 4%" ></div>
        <div class="control-group">
            <?php // echo form_label('Domain name :', 'domain', array('class' => "control-label", 'style' => "float:left;padding-right:41px")); ?>
            <span style="float: left;padding: 0.6em 0.7em 0.7em;margin-right: 5%;margin-top: 0.52%" class="label label-info">Domain name :</span>
            <input type="text" class="form-control" id="name" style="width: 50%" placeholder="Name" name="name" title="Please Enter Name" required="Please Enter Name">
                <div style =" color: red; display: none;" id="usererror"></div>
            
        </div>
    </div>
    </div>
   <div class="modal-footer">
        <div class="control-group">  
            <div class="div_wrapper" style="margin-left: 10%!important">
                <input type="submit" id="updatebtn" class="btn btn-primary footer_btn" value="Create Domain">
                <input type="button" id="closebtn" class="btn footer_btn" data-dismiss="modal" aria-hidden="true" onclick="close_fun()" value="Close">
            </div>
        </div>
    </div>
    <input type="hidden" value="<?=  site_url();?>" id="url"> 
    </div>
        </div>
</div>
<?php
echo form_close();
?>