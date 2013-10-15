
jQuery(document).ready(function(){
     
     jQuery('.chosen-select').chosen(); 
     jQuery('.btn-group select chosen-select select-multiple').hide();
//     $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});  
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
        show();
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
                hide();
    },
        error:function(res)
       {
           alert(res);
           hide();
       }
    });
   }
});
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