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
                    <td><div class="btn-group"> <a href="<?php echo site_url('/admin/setting/edit_theme/' . $Theme->id) ?>" class="btn btn-primary"><i class="icon-edit icon-white"></i> Edit</a>
                            <a href="javascript:deletbox('<?php echo site_url('/admin/setting/delete_theme/' . $Theme->id) ?>')" class="btn btn-danger"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
                </tr>
            <?
            endforeach;
        endif;
        ?>
    </tbody>
</table>  
<input type="submit" id="create" name="create" class="btn btn-primary" value="Create Theme" style="display: none;float: left;">
<input type ="hidden" id ="edit_url" value="<?= site_url(); ?>"/>
<?php echo form_close(); ?>
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