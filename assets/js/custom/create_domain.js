jQuery(document).ready()
{ 
//    jQuery.noConflict();
  

     setTimeout(function() {
        jQuery('#dom').click();
    }, 100);
    
    var regex = /^[\s]*$/ ;  
     $('#my').ajaxForm({
        beforeSubmit: function() {
           if (regex.test($('#name').val()))
               {
                   $('#usererror').html('Please enter name');
                   $('#usererror').show();
                   return false;
               }
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