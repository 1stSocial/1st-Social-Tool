jQuery(document).ready(function(){
     jQuery('.chosen-select').chosen(); 
   setTimeout(function(){
       
       jQuery('#mod1').click();
       
   },100);
    jQuery('#theme_chosen').css('width','49%');
     jQuery('#taxo_chosen').css('width', '49%');
     change();
     jQuery('#domain_chosen').css('width','49%');
     
    jQuery('#parentTag1').change(function()
    {
        $('#selected_tag').val(this.value);
        change();
    });
    
});
 
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
                
                var val = "<select data-placeholder='Choose a Filterable Taxonomy...' class=chosen-select style=width:350px; tabindex=4 id=taxo name=taxo>";
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
                     jQuery('.chosen-select').chosen();
                     jQuery('#taxo_chosen').css('width', '49%');

            }
        });
}

jQuery('#update').click(function(){ 
   
    var name = jQuery('#name1').val();
     var parentTag = jQuery('#parentTag1').val();
     var domain = jQuery('#domain').val();
     var id = jQuery('#mainid').val();
     var taxo_id = jQuery('#taxo').val();
      var theme_id = jQuery('#theme').val();
      
    if(name=="")
        {
             $('#berror').show();
        }
        else
            {
                $('#berror').hide();
            }
    if(parentTag=="0")
        {
             $('#perror').show();
        }
        else
            {
                $('#perror').hide();
            }        
     
   if (name != "" && parentTag!="0"  && domain != "0") {   
     
     var dataval ={
        name : name,
        parentTag : parentTag,
        domain:domain,
        id:id,
        theme_id:theme_id,
         filterable_taxo :taxo_id
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
                   
               }
       },
       error:function(res)
       {
           alert(res);
       }
    });
   }
});