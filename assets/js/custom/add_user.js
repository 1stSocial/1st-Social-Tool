var values = 'no'; 
jQuery(document).ready()
{
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
                return  false;
        },
        success: function(data) {
            if(data=="")
                {
                    $('#closebtn').click();
                }
        }
    });
   
}
function val(i)
{
    values = i;
}


function domain_new()
{
    var id = $('#domain').val();

    if(id=='0')
        {
            var site_url = $('#url').val();
    
                $.ajax({
                    type: "POST",
                    url: site_url+'/admin/home/create_domin',
                    success: function(res) {
//                        alert(res);
                     $('#create_dom').html(res);
                      setTimeout(function(){
                         //    $("#username12").prop("disabled", false);
                          //   $("#username12").removeAttr( "readonly" );
                    
                      
                          $('#dom').click();
                              
    
   },100);  
    setTimeout(function(){
         var inputboxhtml =     '<textarea>asdf</textarea><input type="text" style="float: left" id="username12"  placeholder="Domain Name" name="domainname" required="Please Enter Domain name" >';
      
        $("#inputbox").html(inputboxhtml);},300);
                    },
                    error:function (res)
                    {
                        alert(res);  
                    }
                }); 
        }
    
    
}