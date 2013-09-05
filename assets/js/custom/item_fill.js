$(document).ready()
{
    setTimeout(function() {
        $('#mod1').click();
    }, 100);

    $('#body').redactor();
}
function _close()
{
    window.location.href = './';
}
function savefun(ur)
{
    ur = ur + '/';

    var tag_id = $('#tag_id').val();
    var name = $('#item_name').val();
    var title = $('#item_title').val();
    var body = $('#body').val();
    var board_id = $('#bord_id').val();
    var taxo = [];
    $('#taxodiv').find('input:text')
            .each(function() {
        taxo[this.id] = $(this).val();
    });


    if (name != "" && title != "" && body != "") {

        var dataval = {
            tag_id: tag_id, // its to be change ;.l;l;l;l;===
            name: name,
            title: title,
            body: body,
            board_id: board_id,
            taxo: taxo
        }

        $.ajax({
            type: "POST",
            url: ur,
            data: dataval,
            success: function(res) {
                if (res == '')
                {
                    setTimeout(function() {
                        $('#closebtn').click();
                        window.location.href = './';
                    }, 200);

                }
                else
                {
                    var obj = jQuery.parseJSON(res);
                    for (var i = 0; i < obj.length; i++)
                    {
                        var val = obj[i].split(":");
                        $id = "#" + val[0] + "d";
                        $($id).html(val[1]);

                    }
                }
            },
            error: function(res)
            {

            }
        });
    }
    else
    {
        $("#error").show();
    }
}
function _close()
{
    window.location.href = './';
}
