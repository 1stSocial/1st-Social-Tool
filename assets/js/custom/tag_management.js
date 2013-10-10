$(document).ready(function() {
//     jQuery('.chosen-select').chosen(); 
    $('#tab_id').dataTable({
        "sPaginationType": "full_numbers"
    });
        $("#tab_id_info").css("width", "20%");
        $("#tab_id_info").attr("class", "btn btn-info");
        $("#tab_id_info").css("float", "left");
        $("#tab_id_length").css("width", "20%");
        $("#tab_id_length").css("margin-left", "20%");
        
      jQuery("#tab_id_paginate").css('width',"40%");
    $('.dataTables_length').insertAfter($("#tab_id_info"));
    $('#tab_id_length').show();
    $('#tab_id_filter').css("margin-right",'1%');
    $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});
});
function deletbox(urllink)
{
    bootbox.confirm('Are you sure?', function(val){
        if(val){ document.location.href = urllink;}
    });
}

function edit(val)
{
    edit_url = $('#edit_url').val();
    $.ajax({
        url: edit_url,
        type: 'POST',
        data: {'id': val},
        success: function(res)
        {
            $('#edit').html(res);
        }
    });
}
function cl()
{
    setTimeout(function() {
    var uri = $('#ur').val();
    window.location.href = uri;},300);
}

function savefun()
{
    var uri = $('#ur').val();

    var name = $('#name').val();
    var id = $('#parentTag').val();
    
    if(name=="")
        {
             $('#error').show();
        }
        else
            {
                $('#error').hide();
            }
    if(id=="0")
        {
             $('#perror').show();
        }
        else
            {
                $('#perror').hide();
            }        
            
    if (name != "" ) {
        
        show();
        
        var dataval = {
            parenttag: name,
            Parentid: id
        }
        $.ajax({
            type: "POST",
            url: "../create_Tags",
            data: dataval,
            success: function(res) {
                if (res == '')
                {
                    setTimeout(function() {
                        $('#close').click();
                        window.location.href = uri;
                    }, 300);

                }
                else
                    $('#msg').text(res);
                hide();
            },
            error: function(res)
            {
                hide();
                alert(res);
            }
        });
    }
    else
    {
       
    }
}
     function show()
{
    $("#load").show();
    $('#fad').css({'background': 'black', 'opacity': 0.2});
}
function hide()
{
    $("#load").hide();
    $('#fad').css({'background': '', 'opacity': 1});
}