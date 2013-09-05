jQuery(document).ready(function(){

 
   $(document).ready(function() {
                    $('#tab_id').dataTable({
                        "sPaginationType": "full_numbers",
                        });
                    $("#tab_id_info").css("width", "550px");
                    $("#tab_id_length").css("width", "500px");
                    $("#create").insertBefore($('#tab_id_filter'));
                    $('.dataTables_length').insertAfter($("#tab_id_info"));
                    $('#create').show();
                    $('#tab_id_length').show();
                });
         
    $(".chosen-select").chosen({width: "50%"});
  $('#theme_chosen').width('50%');
  
        setTimeout(function(){
       jQuery('#mod1').click();
   },200);
   
   $('#selectbtn').click(function (){
      
       var val = $('#theme').val();
       var siteurl = $('#ur').val();
       $.ajax({
          data:{'select':val},
          url : siteurl + '/admin/setting/set_theme',
          type:'POST',
          success:function(res){
                                if(res == '')
                                    {
                                        setTimeout(function (){
                                         jQuery('#closebtn').click();
                                         window.location.href =siteurl + '/admin/setting/index';    
                                        },200); 

                                    }
                                }
       
            });
   
   
 });
 jQuery('#closebtn').click(function(){
 var siteurl = $('#ur').val();
//    var ur =jQuery('#ur').val();
   window.location.href =siteurl + '/admin/setting/index';  


});
 
});