jQuery(document).ready(function(){
//   $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});
   setTimeout(function(){
       
       jQuery('#mod1').click();
       
   },100);
   
   $('form').ajaxForm({
        beforeSubmit: function() {
            if(jQuery('#name1').val() =="" && jQuery('#parentTag1').val() =="0" && jQuery('#domain').val()=="0")
                {
                    return  false;
                }
             show();  
        },
        success: function(data) {
            update(data);
        }
    });
   
jQuery('.chosen-select').chosen();
    jQuery('#theme_chosen').css('width','69%');
     jQuery('#taxo_chosen').css('width', '49%');
//     change();
     jQuery('#domain_chosen').css('width','69%');
        jQuery('#templet_chosen').css('width', '69%');
        
    jQuery('#parentTag1').change(function()
    {
        $('#selected_tag').val(this.value);
        change();
    });
    
});
 
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
    
function change()
{
     var val = $('#selected_tag').val();
     var selecttaxo = $('#selected_taxo').val();
        var dataval = {
            'tag_id': val
        };
        $('#taxo').empty();
       
        var site = $('#site').val() + '/admin/home/taxoval';
        jQuery.ajax({
            url: site,
            data: dataval,
            type: 'POST',
            success: function(res)
            {
                
                var val = "<select class=chosen-select data-placeholder='Choose a Filterable Taxonomy...'  style=width:350px; tabindex=4 id=taxo name=taxo>";
                        val += "<option value=0></option>";
                
                 var obj = jQuery.parseJSON(res);
                 $.each(obj,function (i,data){
                     if(data['id'] == selecttaxo)
                     val += "<option selected value="+data['id']+">"+data['name']+"</option>";
                     else
                     val += "<option value="+data['id']+">"+data['name']+"</option>";    
                    });
                 val +="</select>";
                 $('#select_box').html("");
                 $('#select_box').html(val);
//                 $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});
                     jQuery('.chosen-select').chosen();
                     jQuery('#taxo_chosen').css('width', '49%');
//                     jQuery('#taxo_chosen').css('margin-left', '2.6%');
               
            }
        });
}

    function update(img)
    {
    var name = jQuery('#name1').val();
     var parentTag = jQuery('#parentTag1').val();
     var domain = jQuery('#domain').val();
     var id = jQuery('#mainid').val();
     var taxo_id = jQuery('#taxo').val();
      var theme_id = jQuery('#theme').val();
       var title = jQuery('#title1').val();
        var call_to_action = jQuery('#call_to_action').val();
       var template = jQuery('#templet').val();
       
       show();
    if(name=="")
        {
             $('#berror').show();
        }
        else
            {
                $('#berror').hide();
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
            
    if(parentTag=="0")
        {
             $('#perror').show();
        }
        else
            {
                $('#perror').hide();
            }        
     if(title == "")
        {
            jQuery("#terror").show();
        }
        else
            {
                jQuery("#terror").hide();
            }


   if (name != "" && parentTag!="0"  && domain != "0" && title !="") {   
     
     var dataval ={
        name : name,
        parentTag : parentTag,
         title:title,
        domain:domain,
        id:id,
        theme_id:theme_id,
         filterable_taxo :taxo_id,
         image:img,
          call_to_action :call_to_action,
           template:template
       };
    jQuery.ajax({
       type: "POST",
       url:"home/update_board",
       data:dataval,
       success:function(res){
           if(res == '')
               {
                   setTimeout(function (){
                    jQuery('#cl').click();
                    window.location.href ="home";    
                   },200);
                   
               }hide();
       },
       error:function(res)
       {
                hide();
           alert(res);
       }
    });
   }
};
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