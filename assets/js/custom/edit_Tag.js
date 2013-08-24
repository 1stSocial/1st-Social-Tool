
jQuery(document).ready(function(){
  setTimeout(function(){
       jQuery('#mod1').click();
   },100);
 });

jQuery('#updatebtn').click(function(){
  var id = jQuery("#id").val();   
     var name = jQuery('#name').val();
     var pid = jQuery('#parentTag1').val();
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
});