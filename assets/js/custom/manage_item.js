$(document).ready(function() {
    $('#tab_id').dataTable({
        "sPaginationType": "full_numbers"
    });
    $("#tab_id_info").css("width", "33%");
    $("#tab_id_length").css("width", "28%");
    $('.dataTables_length').insertAfter($("#tab_id_info"));
    $('#tab_id_length').show();
    $("img").css({
        'width': 50,
        'height': 50
    });
     $("iframe").css({
        'width': 100,
        'height': 100
    });
});

function deletbox(urllink)
{
    bootbox.confirm('Are you sure?', function(val){
        if(val){ document.location.href = urllink;}
    });
}

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