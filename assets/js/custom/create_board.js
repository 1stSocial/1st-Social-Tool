jQuery(document).ready(function() {
     jQuery('.chosen-select').chosen(); 
    setTimeout(function() {
        jQuery('#mod1').click();
    }, 100);
    
    jQuery('#theme_chosen').css('width','49%');
    
});

jQuery('#closebtn').click(function() {

    var ur = jQuery('#ur').val();
    window.location.href = ur;


});

jQuery('#add').click(function() {

    var name = jQuery('#name1').val();
    var parentTag = jQuery('#parentTag1').val();
    var user_id = jQuery('#user_id').val();
    var theme_id = jQuery('#theme').val();

    if (name == "")
    {
        jQuery("#berror").css('padding-left:40%')
        jQuery("#berror").show();
    }
    else
    {
        jQuery("#berror").hide();
    }

    if (parentTag == "0")
    {
        jQuery("#perror").show();
    }
    else
    {
        jQuery("#perror").hide();
    }
   

    if (name != "" && parentTag != "0" && user_id != " ")
    {
        var dataval = {
            name: name,
            parentTag: parentTag,
            user_id: user_id,
            theme_id:theme_id
        };
        var ur = jQuery('#ur').val();
        jQuery.ajax({
            type: "POST",
            url: "../create_board",
            data: dataval,
            success: function(res) {
                if (res == '')
                {
                    setTimeout(function() {
                        jQuery('#closebtn').click();
                        window.location.href = ur;
                    }, 200);

                }
                else
                    alert(res);
            },
            error: function(res)
            {
                alert(res);
            }
        });
    }

});


