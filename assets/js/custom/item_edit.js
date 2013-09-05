$(document).ready()
{
    setTimeout(function() {
        $('#mod1').click();
    }, 100);

    $('#body').redactor();
    $(".chosen-select").chosen({width: "50%"});
}

function savefun(ur)
{
    var id = $('#item_id').val();
    var itemname = $('#name').val();
    var title = $('#title').val();
    var body = $('#body').val();
    var tag = [];
    var taxo = [];
    $('#taxodiv').find('input:text')
            .each(function() {
        taxo[this.id] = $(this).val();
    });

    $('#maintaddiv').find('select').find(":selected")
            .each(function() {
        tag[$(this).val()] = $(this).val();

    });

    if (itemname != "") {

        var dataval = {
            id: id, // its to be change ;.l;l;l;l;===
            name: itemname,
            title: title,
            body: body,
            taxo: taxo,
            tag_id: tag
        };

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
                alert(res);
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