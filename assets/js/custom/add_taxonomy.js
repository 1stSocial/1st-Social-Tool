jQuery(document).ready()
{
//     jQuery('.chosen-select').chosen(); 
     setTimeout(function(){
       $('#mod1').click();
   },100);
}
 $('#parentTag').change(function()
    {
     $.ajax({
         url:'../child_tag_list',
         type:"post",
         data:{'parent':this.value},
         success:function(res)
         {
             $("#childTagsId").html(res);
         }
     });
        
    });