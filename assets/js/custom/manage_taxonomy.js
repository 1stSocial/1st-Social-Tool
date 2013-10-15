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
//       $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});
});
function deletbox(urllink)
{
    bootbox.confirm('Are you sure?', function(val){
        if(val){ document.location.href = urllink;}
    });
}
function savefun()
{
    var taxonomyname = $('#name').val();
    var type = $('#type').val();
    var parentid = $('#parentTag').val();
    
    if(taxonomyname == "")
        {
            $('#taxoname').show();
        }
    else
        {
            $('#taxoname').hide();
        }
    
    if(type == "select")
        {
            $('#type_error').show();
        }
    else
        {
            $('#type_error').hide();
        }
    
    if(parentid == "0")
        {
            $('#tag_error').show();
        }
    else
        {
            $('#tag_error').hide();
        }
    
    if (taxonomyname != "" && type !="select" && parentid !="0") {

        var dataval = {
            taxonomyname: taxonomyname,
            type: type,
            parentid: parentid
        }
        show();
        $.ajax({
            type: "POST",
            url: "../add_taxonomy",
//       contentType: 'json',
            data: dataval,
            success: function(res) {
                if (res == '')
                {
                    setTimeout(function() {
                        $('#close').click();
                        window.location.href = '../';
                    }, 200);

                }hide();
            },
            error: function(res)
            {
                hide();
                alert(res);
            }
        });
    }
   
}
function c()
{
    window.location.href = '../';
}

function edit(val)
{
    var newurl = document.URL.toString().split("/index/addtaxonomy");

    $.ajax({
        url: newurl[0] + '/get_taxonomy',
        type: 'POST',
        data: {'id': val},
        success: function(res)
        {
            $('#edit').html(res);
        }
    });
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


