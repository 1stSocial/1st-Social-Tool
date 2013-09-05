$(document).ready(function() {
    $('#tab_id').dataTable({
        "sPaginationType": "full_numbers"
    });
    $("#tab_id_info").css("width", "550px");
    $("#tab_id_length").css("width", "500px");
    $('.dataTables_length').insertAfter($("#tab_id_info"));
    $('#tab_id_length').show();
});

function edit(ur, id) {
    ur = ur + '/' + id;
    // alert(ur+id+";");


    $.ajax({url: ur,
        type: 'POST',
        success: function(res)
        { //alert(res);
            $('#item_edit').html(res);
        }
    });
}