$(document).ready(function() {
     jQuery('.chosen-select').chosen(); 
    $('#tab_id').dataTable({
        "sPaginationType": "full_numbers",
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
function cl()
{
    var uri = $('#ur').val();
}
function savefun()
{
    var name = $('#name').val();
    var id = $('#parentTag').val();
    if (name != "") {
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
                        window.location.href = '../';
                    }, 200);
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
        $('#error').show();
    }
}
function edit(val)
{
    var newurl = document.URL.toString().split("/index/createbord");
    var edur = $('#editurl').val();
    $.ajax({
        type: "POST",
        url: newurl[0] + '/edit_board',
        data: {'bid': val},
        success: function(res) {
            $('#edit').html(res);
        },
        error: function(res)
        {
            alert(res);
        }
    });
}