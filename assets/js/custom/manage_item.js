$(document).ready(function() {
    $('#tab_id').dataTable({
        "sPaginationType": "full_numbers"
       
    });
    
   $("#tab_id_info").css("width", "20%");
        $("#tab_id_info").css("float", "left");
        $("#tab_id_length").css("width", "20%");
        $("#tab_id_length").css("margin-left", "20%");
        $("#tab_id_info").attr("class", "btn btn-info");
    $('.dataTables_length').insertAfter($("#tab_id_info"));
    $('#tab_id_length').show();
    $('#tab_id_filter').css("margin-right",'1%');
    $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});
    $(".body_img img").css({
        'width': 100,
        'height': 100
    });
     $("iframe").css({
        'width': 300,
        'height': 300
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