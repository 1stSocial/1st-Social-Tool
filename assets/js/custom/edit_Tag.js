
jQuery(document).ready(function(){
     
//     jQuery('.chosen-select').chosen(); 
     
     $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});  
  setTimeout(function(){
       jQuery('#mod1').click();
   },100);
 });
jQuery('.selectpicker').selectpicker();
jQuery('#updatebtn').click(function(){
  var id = jQuery("#id").val();   
     var name = jQuery('#name').val();
     var pid = jQuery('#parentTag').val();
   
     if(name=="")
        {
             $('#error').show();
        }
        else
            {
                $('#error').hide();
            }
    if(pid=="0")
        {
             $('#perror').show();
        }
        else
            {
                $('#perror').hide();
            }        
     
   if (name != "") {  
    var dataval ={
        id: id,
        name : name,
        pid : pid     
    };
    jQuery.ajax({
        type: "POST",
       url:"update_Tag",
//       contentType: 'json',
       data:dataval,
       success:function(res){
           if(res == '')
               {
                   setTimeout(function (){
                    jQuery('#closebtn').click();
                    window.location.href ='tag_Management';    
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