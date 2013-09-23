jQuery(document).ready(function() {
    jQuery('.chosen-select').chosen();
    setTimeout(function() {
        jQuery('#mod1').click();
    }, 100);
 
    jQuery('#theme_chosen').css('width', '49%');
    jQuery('#taxo_chosen').css('width', '49%');
    jQuery('#domain_chosen').css('width', '49%');
    jQuery('#parentTag1').change(function()
    {
        var dataval = {
            'tag_id': this.value
        };
        $('#taxo').empty();
        
        var site = $('#site').val() + '/admin/home/taxoval';
        jQuery.ajax({
            url: site,
            data: dataval,
            type: 'POST',
            success: function(res)
            {
                
                var val = "<select data-placeholder='Choose a Filterable Taxonomy...' class=chosen-select style=width:350px; tabindex=4 id=taxo name=taxo>";
                        val += "<option value=0></option>";
                
                 var obj = jQuery.parseJSON(res);
                 $.each(obj,function (i,data){
                     val += "<option value="+data['id']+">"+data['name']+"</option>";
                    });
                 val +="</select>";
                 $('#select_box').html("");
                 $('#select_box').html(val);
                     jQuery('.chosen-select').chosen();
                     jQuery('#taxo_chosen').css('width', '49%');

            }
        });
    });


});

jQuery('#closebtn').click(function() {

    var ur = jQuery('#ur').val();
    window.location.href = ur;


});

jQuery('#add').click(function() {

    var name = jQuery('#name1').val();
    var parentTag = jQuery('#parentTag1').val();
    var domain = jQuery('#domain').val();
    var theme_id = jQuery('#theme').val();
    var taxo_id = jQuery('#taxo').val();
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


    if (name != "" && parentTag != "0" && domain != "0")
    {
        var dataval = {
            name: name,
            parentTag: parentTag,
            domain : domain,
            theme_id: theme_id,
            filterable_taxo :taxo_id
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


