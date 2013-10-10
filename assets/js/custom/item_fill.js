$(document).ready(
        function()
        {
            $('#body1').redactor({
                imageUpload: 'temp'
            });
        $('.redactor_box').css('height','400px');
        $('.redactor_ redactor_editor').css('height','400px');
       $('.uploadify').css('margin-left','20%');
        }
        
        
);

function temp()
{
    alert('temp');
}
function temp1()
{
    alert('temp1');
}
$(document).ready()
{
    setTimeout(function() {
        jQuery('#mod1').click();
    }, 100);

    $('form').ajaxForm({
        beforeSubmit: function() {
            show();
        },
        success: function(data) {
          
            savefun(data);
        }
    });
    $("#redactor_file_link").attr("disabled", "");
}



                function _close()
                { 

                    window.location.href = './';
                }

function change_fun()
{
    var val = $('#img').val();
    var ext = /^.+\.([^.]+)$/.exec(val);
    if (ext[1] != 'jpg')
    {
        $('#img_msg').html('Warning : Please Select jpg image.');
        $('#clo').click();
    }
    else
    {
        $('#img_msg').hide();
    }
}


function savefun(image)
{
    ur = $('#url_temp').val();
    ur = ur + '/';
    var tag_id = $('#tag_id').val();
//    var name = $('#item_name').val();
    var title = $('#item_title').val();
    var body = $('#body1').val();
    var board_id = $('#bord_id').val();
    var taxoid = $('#taxoid').val();
    var folder_name = $('#folder_name').val();
    var abc = [];
    
    var taxo = [];
    var ids = [];
    $('#taxodiv').find('input:text')
            .each(function() {
        taxo[this.id] = $(this).val();
    });
    var i = 0;
    $('#taxodiv').find('input:hidden')
            .each(function() {
        ids[i] = $(this).val();
        i++;
    });
    
    var j=0;
     $('#tagdiv').find('input:hidden')
            .each(function() {
       
        abc[j] = $(this).val();
        j++;
    });

    var imgval;

    $('#imgdiv').find('img')
            .each(function() {
        imgval = $(this).attr('src');
    });

    if (image == 'not uploaded')
    {
        $('#img_msg').html('Image not uploaded ...');
        $('#img_msg').show();
    }

    if (title != "" && body != "" && image != 'not uploaded') {

        var dataval = {
            tag_id: tag_id, // its to be change ;.l;l;l;l;===
            name: title,
            title: title,
            body: body,
            board_id: board_id,
            taxo: taxo,
            ids: ids,
            img: imgval,
            image: image,
            folder_name : folder_name,
            abc : abc
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
                hide();
            },
            error: function(res)
            {
                hide();
                alert('error');
            }
        });
    }
    else
    {
        hide();
        $("#error").show();
    }
}


                function _close()
                { 

                    window.location.href = './';
                }
function show()
{
    $("#load").show();
    $('#fad').css({'background': 'white', 'opacity': 0.2});
}
function hide()
{
    $("#load").hide();
    $('#fad').css({'background': '', 'opacity': 1});
}
