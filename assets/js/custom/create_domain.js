jQuery(document).ready()
{ 
     setTimeout(function() {
        jQuery('#dom').click();
    }, 100);
    
    
     $('#my').ajaxForm({
        beforeSubmit: function() {
           
        },
        success:function (res)
        {
           if(res=="")
           {
               $('#closebtn').click();
           }
           else
               {
                   $('#usererror').html('Name all ready exist');
                   $('#usererror').show();
               }
        }});
    
  
    
}

 function close_fun()
     {
         var url = $('#url').val(); 
         window.location.href = './'+'domain_management';
     };