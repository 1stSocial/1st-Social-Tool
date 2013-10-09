<?php echo form_open(site_url() . '/admin/setting/theme'); ?>
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
                    <td><div class="btn-group"> <a href="<?php echo site_url('/admin/home/edit_domain/' . $val->id) ?>" class="btn btn-primary fui-new"><i class="icon-edit icon-white"></i> Edit</a>
                            <a href="javascript:deletbox('<?php echo site_url('/admin/home/delete_domain/' . $val->id) ?>')" class="btn btn-danger fui-trash"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
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