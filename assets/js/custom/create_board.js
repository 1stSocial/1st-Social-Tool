jQuery(document).ready(function() {

 jQuery('.chosen-select').chosen();
//   jQuery('#parentTag1_chosen').css('margin-left','6%');
    
    jQuery('.chosen-select').css('width', '49%');
    
    jQuery('#theme_chosen').css('width', '69%');
    jQuery('#taxo_chosen').css('width', '49%');
    jQuery('#domain_chosen').css('width', '69%');
    jQuery('#templet_chosen').css('width', '69%');

//$("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});    
    
    setTimeout(function() {
        jQuery('#mod1').click();
    }, 100);
 
 
 
     jQuery('form').ajaxForm({
        beforeSubmit: function() {
            var template = jQuery('#templet').val();
   
             show();
            if(jQuery('#name1').val() =="" && jQuery('#parentTag1').val() =="" && jQuery('#domain').val()=="")
                {
                    return  false;
                   hide();
                }
        },
        success: function(data) {
          
            savefun(data);
        }
    });

   
    jQuery('#parentTag1').change(function()
    {
        var tag_val = jQuery('#parentTag1').val();
        
        show();
        var dataval = {
            'tag_id': tag_val
        };
        $('#taxo').empty();
        var site = $('#site').val() + '/admin/home/taxoval';
        jQuery.ajax({
            url: site,
            data: dataval,
            type: 'POST',
            success: function(res)
            {
                
               hide();
                var val = "<select class=chosen-select data-placeholder='Choose a Filterable Taxonomy...' style=width:350px; tabindex=4 id=taxo name=taxo>";
                        val += "<option value=0></option>";
                
                 var obj = jQuery.parseJSON(res);
                 $.each(obj,function (i,data){
                     val += "<option value="+data['id']+">"+data['name']+"</option>";
                    });
                 val +="</select>";
                 $('#select_box').html("");
                 $('#select_box').html(val);
//                 $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});
                     jQuery('.chosen-select').chosen();
                     jQuery('#taxo_chosen').css('width', '49%');
            },
             error: function(res)
            { 
            }
        });
    });


});

jQuery('#closebtn').click(function() {

    var ur = jQuery('#ur').val();
    window.location.href = ur;


});
    function show()
    {
        $("#load").show();
        $('#fad').css({'background': 'white', 'opacity':0.5 });
    }
    function hide()
    { 
        $("#load").hide();
        $('#fad').css({'background': '', 'opacity':1});
    }
//jQuery('#add').click(function() {
function savefun(image)
{
   
    var name = jQuery('#name1').val();
    var parentTag = jQuery('#parentTag1').val();
    var domain = jQuery('#domain').val();
    var theme_id = jQuery('#theme').val();
    var taxo_id = jQuery('#taxo').val();
    var title = jQuery('#title1').val();
    var call_to_action = jQuery('#call_to_action').val();
    var template = jQuery('#templet').val();
    
   
    
    if (name == "")
    {
        jQuery("#berror").css('padding-left:40%')
        jQuery("#berror").show();
    }
    else
    {
        jQuery("#berror").hide();
    }
    
    if (call_to_action == "")
    {
        jQuery("#call_error").css('padding-left:40%')
        jQuery("#call_error").show();
    }
    else
    {
        jQuery("#call_error").hide();
    }
    
    
    if (parentTag == "0")
    {
        jQuery("#perror").show();
    }
    else
    {
        jQuery("#perror").hide();
    }
    
    if(title == "")
        {
            jQuery("#terror").show();
        }
        else
            {
                jQuery("#terror").hide();
            }


    if (name != "" && parentTag != "0" && domain != "0" && title !="")
    {
        
        var dataval = {
            name: name,
            title:title,
            parentTag: parentTag,
            domain : domain,
            theme_id: theme_id,
            filterable_taxo :taxo_id,
            image : image,
            call_to_action :call_to_action,
            template:template
        };
        var ur = jQuery('#ur').val();
        jQuery.ajax({
            type: "POST",
            url: "../create_board",
            data: dataval,
            success: function(res) {
             
                if (res == '')
                {
                    
                    setTimeout(function() {
                        jQuery('#closebtn').click();
                        window.location.href = ur;
                          hide();
                    }, 200);
                   
                }
                else
                    {
//                    alert(res);
                        }
            },
            error: function(res)
            {
                hide();
                alert(res);
            }
        });
    }

}

function change_fun()
{
    var val = $('#img').val();
    var ext = /^.+\.([^.]+)$/.exec(val);
    if (ext[1] != 'jpg')
    {
        $('#img_msg').html('Warning : Please Select jpg image.');
        $('#clo').click();
    }
    else
    {
        $('#img_msg').hide();
    }
}
