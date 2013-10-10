var tag_id = [];

jQuery(document).ready(function() {
    $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});
    setTimeout(function() {
        jQuery('#mod1').click();
    }, 100);

    jQuery('#body').redactor();

    jQuery('#sub1').click(function() {

        var id = jQuery('#boardval').val();
        var parent_id = jQuery('#parent_id').val();

        if (id == 0)
        {

        }
        else
        {
            if (parent_id != 0)
                jQuery('#sub').click();
        }
    });
});


function get_parent_change_val()
{
    var id = jQuery('#boardval').val();
    var url = jQuery('#url').val();
    show();
    var dataval = {
        'id': id
    };
    $('#parent_tag').html("");
    $('#add').html("");

    jQuery.ajax({
        type: "POST",
        url: url + '/admin/Item/parenttag',
        data: dataval,
        success: function(res) {
            hide();
            value = "";
            value = "<div style='magrin-top:33px;padding-top:8px;'><label class='control-label label label-info' style='float: left;padding: 0.6em 0.7em 0.7em;margin-right: 5%;margin-top: 0.52%;width: 23%;'>" + "Select Parent Tag" + ":</label>" + res + '</div>'
            $('#parent_tag').html(value);
            $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});

        },
        error: function(res)
        {
            hide();
            alert(res);
        }
    });
}


function change_val()
{
    var id = jQuery('#parent_id').val();
    var url = jQuery('#url').val();
    
    show();

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
            var j = 0;
            $.each(obj['tag']['Parent'], function(i, data) {
                tag_id[j] = data['tag_id'];
                value = "";
                value = "<div style='magrin-top:33px;padding-top:8px;'><label class='control-label label label-info' style='float: left;padding: 0.6em 0.7em 0.7em;margin-right: 5%;margin-top: 0.52%;width: 23%;'>" + data['name'] + ":</label>" +
                        "<select required='' data-placeholder='Choose...' multiple  style='width:350px;margin-right:5px!important' tabindex=2 id=" + data['tag_id'] + " name=tag[]>"
                        + "<option> </option>";
                val2 = "";
                $.each(obj['tag']['child'], function(i, val) {
                    if (val['parent_tag_id'] == data['tag_id']) {
                        val2 += "<option value=" + val['tag_id'] + ">" + val['name'] + "</option>";
                    }
                });
                val2 += "</select></div>";
                $('#add').append(value + val2);
                $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});
//                $(".chosen-select").chosen({width: "50%"});
                j++;
            });

            hide();

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
function show()
{
    $("#load").show();
    $('#fad').css({'background': 'white', 'opacity': 0.5});
}
function hide()
{
    $("#load").hide();
    $('#fad').css({'background': '', 'opacity': 1});
}