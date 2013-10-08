<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/user_manegement.js"></script>
<?php echo form_open(site_url() . '/admin/new_user/'); ?>
<table id="tab_id" class="table table-striped ">
    <thead>
        <tr>
            <th>User Id</th> 
            <th>Name</th>
            <th>Username</th>
            <th>Domain</th>
            <th>Type</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <? if (!empty($user)): foreach ($user as $val): ?>
                <tr>
                    <td><?= $val->id ?></td>  
                    <td><?= $val->name ?></td>
                    <td><?= $val->username ?></td>
                    <td><?= $val->domain_name ?></td>
                    <td><?= $val->access_level ?></td>
                    <td>
                     <div class="btn-group"> <a href="javascript:edit('<?php echo site_url('/admin/new_user/edit_user/' . $val->id) ?>')" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a>
                     <a href="javascript:deletbox('<?php echo site_url('/admin/new_user/delete_user/' . $val->id) ?>')" class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div>
                    </td>
                </tr>
            <?
            endforeach;
        endif;
        ?>
    </tbody>
</table>  
<input type="button" id="create_user" name="create" class="btn btn-primary" value="Create User" style="display: none;float: left;">
<input type ="hidden" id ="siteurl" value="<?= site_url(); ?>"/>


<div id="create_user_div">
    
</div>

<div id="edit_user">

</div>


<?php echo form_close(); ?>
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
        $("#create_user").insertBefore($('#tab_id_filter'));
        $('.dataTables_length').insertAfter($("#tab_id_info"));
        $('#create_user').show();
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
