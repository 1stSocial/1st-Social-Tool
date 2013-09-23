$(document).ready(function() {

$('#create_user').click(function ()
{
    var site_url = $('#siteurl').val();
    
        $.ajax({
            type: "POST",
            url: site_url+'/admin/new_user/create_user',
            success: function(res) {
                $('#create_user_div').html(res);
            },
            error:function (res)
            {
                alert(res);  
            }
        });
});

});

function edit(uri)
{
    $.ajax({
            type: "POST",
            url: uri,
            success: function(res) {
                $('#edit_user').html(res);
      
            },
            error:function (res)
            {
             
            }
        });
}