jQuery(document).ready(function(){
   setTimeout(function(){
       jQuery('#mod1').click();
   },100);
});


jQuery('#update').click(function(){ 
   
    var name = jQuery('#name1').val();
     var parentTag = jQuery('#parentTag1').val();
     var user_id =jQuery('#user_id').val();
     var id = jQuery('#mainid').val();
     
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
     
   if (name != "" && parentTag!="0") {   
     
     var dataval ={
        name : name,
        parentTag : parentTag,
        user_id:user_id,
        id:id
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