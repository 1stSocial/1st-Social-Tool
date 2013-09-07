jQuery(document).ready(function() {
    setTimeout(function() {
        jQuery('#mod1').click();
    }, 100);
 
jQuery('#body').redactor();

jQuery('#sub1').click(function (){
    var id = jQuery('#boardval').val();
   if(id==0)
       {
           
       }
   else
       {
           jQuery('#sub').click();
       }
});    
});





function change_val()
{
    var id = jQuery('#boardval').val();
    var url = jQuery('#url').val();
    
    var dataval = {
        'id': id
    };
    $('#add').html("");
    
  
    jQuery.ajax({
        type: "POST",
        url: url + '/admin/Item/childtag',
        data: dataval,
        success: function(res) {

            var value = "";
            var val2 = "";
            var obj = jQuery.parseJSON(res);
            $.each(obj['tag']['Parent'], function(i, data) {
               value = "";
                value = "<div style='magrin-top:33px;padding-top:8px;'><label class='control-label' style='float: left;width:165px'>" + data['name'] + ":</label>" +
                        "<select data-placeholder='Choose...' class=chosen-select multiple  style='width:350px;' tabindex=2 id=" + data['tag_id'] + " name=tag[]>"
                        + "<option> </option>";
                val2 = "";
                $.each(obj['tag']['child'], function(i, val) {
                    if (val['parent_tag_id'] == data['tag_id']) {
                        val2 += "<option value=" + val['tag_id'] + ">" + val['name'] + "</option>";
                    }
                });
                val2 += "</select></div>";
                $('#add').append(value + val2);
                $(".chosen-select").chosen({width: "50%"});
            });



        },
        error: function(res)
        {
            alert(res);
        }
   
    });
 
}
function _close()
{
    window.location.href = './';
}
