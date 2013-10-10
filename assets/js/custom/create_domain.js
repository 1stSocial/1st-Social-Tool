$(document).ready()
{ 
//    jQuery.noConflict();
//    alert('abc');

     setTimeout(function() {
        $('#dom').click();
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
               show();
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
               hide();
        }});
    
  
    
}

 function close_fun()
     {
         var url = $('#url').val(); 
         window.location.href = './'+'domain_management';
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