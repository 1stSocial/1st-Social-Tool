$(document).ready(function() {
    $('#tab_id').dataTable({
        "sPaginationType": "full_numbers"
    });
    $("#tab_id_info").css("width", "33%");
    $("#tab_id_length").css("width", "28%");
    $('.dataTables_length').insertAfter($("#tab_id_info"));
    $('#tab_id_length').show();
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
            },
            error: function(res)
            {
                alert(res);
            }
        });
    }
    else
    {
       
    }
}