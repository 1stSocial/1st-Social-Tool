var values = 'no'; 
jQuery(document).ready()
{
//    alert('edit');  
     jQuery('.chosen-select').chosen(); 
     $('#access_level_chosen').css('width','220px');
     $('#domain_chosen').css('width','220px');
     setTimeout(function(){
       $('#mod1').click();
   },100);
   
   $('#myform').ajaxForm({
        beforeSubmit: function() {
            
           var name = $('#username').val(); 
           var url = $('#url').val(); 
           var name_default = $('#default').val();
           if(!name_default == name)
           {    
           $.ajax({
            type: "POST",
            url: url+'/admin/new_user/username_check',
            data: {username:name},
            success: function(res) {
               if(res == 'ok')
                   {
                        values = 'ok';
                        $('#usererror').html("");
                        val('ok');
//                        return bool;
                   }
               if(res == 'no')
               {
                   $('#usererror').html('Username allready exist.');
                   $('#usererror').show();
                   values = 'no';
                   val('no');
//                   return false;
               }
            },
            error: function(res)
            {
               
            }
        });
        
        if(values == 'ok')
            return true;
        if(values == 'no')
                return  false;}
        },
        success: function(data) {
            if(data=="")
                {
                    $('#closebtn').click();
                    
                }
        }
    });
    
     $('#closebtn').click(function ()
     {
         var url = $('#url').val(); 
         window.location.href = url +'/admin/new_user/index';
     });
   
   
}
function val(i)
{
    values = i;
}