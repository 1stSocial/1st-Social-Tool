jQuery(document).ready(function() {
     jQuery('.chosen-select').chosen(); 
//       $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});
    setTimeout(function() {
        jQuery('#mod1').click();
    }, 100);
});
function savefun()
{
    var taxonomyname = $('#name').val();
    var type = $('#type').val();
    var tag_id = $('#parentTag2').val();
    
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
    
    if(tag_id == "0")
        {
            $('#tag_error').show();
        }
    else
        {
            $('#tag_error').hide();
        }
    
    if (taxonomyname != "" && type !="select" && tag_id !="0") {
        var id = $("#id").val();
        var ur = $('#ur').val();
        var ur2 = $('#ur2').val();
        show();
        $.ajax({
            type: "POST",
            url: ur,
            data: {
                taxonomyname: taxonomyname,
                type: type,
                tag_id: tag_id,
                id: id
            },
            success: function(res) {
                if (res == '')
                {
                    setTimeout(function() {
                        $('#close').click();

                    }, 200);

                }
                window.location.href = ur2;
                hide();
            },
            error: function(res)
            {
                hide();
                alert(res);
            }
        });
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