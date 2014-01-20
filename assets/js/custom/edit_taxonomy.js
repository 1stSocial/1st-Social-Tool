jQuery(document).ready(function() {
     jQuery('.chosen-select').chosen(); 
//       $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});
    setTimeout(function() {
        jQuery('#mod1').click();
    }, 100);
    
    
     jQuery('form').ajaxForm({
         
        beforeSubmit: function() {
//             show();
                var taxonomyname = $('#name').val();
                var type = $('#type').val();
                var parentid = $('#parentTag2').val();
                var check;
                
               // alert($('#type').val());

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
                    
                if (type == 'Status')
                {
                    if($('#imgsrc1').val() == "")
                        {
                           
                            check = false;
                        }
                    else
                    {
                            check = false;
                    }

                }
                else{
                    check = false;
                }
              
                if (taxonomyname == "" || type =="select" || parentid == null || check) {
                return  false;
                   hide();
                }
        },
        success: function(data) {
            savefun(data);
        }
    });
   
    
    
});
function savefun(data_val)
{
    var taxonomyname = $('#name').val();
    var type = $('#type').val();
   // alert($('#type').val());
    var tag_id = $('#parentTag2').val();
    var check;
    
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
     if (type == 'Status')
    {
        if($('#link_val').val() == "")
            {
                $('#linkname').show();
                check = false;
            }
        else
        {
                $('#linkname').hide();
                check = true;
        }
        
    }
    else{
        check = true;
    }
    
    if (taxonomyname != "" && type !="select" && tag_id !=null && check) {
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
                id: id,
                value: data_val
            },
            success: function(res) {
            
                if (res == '')
                {
                    setTimeout(function() {
                        $('#close').click();

                    }, 200);

                }
                else{
                    
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