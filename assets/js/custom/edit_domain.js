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
           var old =  $('#old_name').val();
           var new_name = $('#name').val();
           var url = $('#url').val();
           if(old != new_name)
           {
           if(res=="")
           {
               $('#closebtn').click();
               window.location.href = url +'/admin/home/domain_management';
           }
           else
               {
                   $('#usererror').html('Name all ready exist');
                   $('#usererror').show();
               }
           }
           else
               {
                   $('#closebtn').click();
                   window.location.href = url +'/admin/home/domain_management';
               }
        }});
    
    $('#closebtn').click(function ()
     {
         var url = $('#url').val(); 
         window.location.href = url +'/admin/home/domain_management';
     });
    
}
