$(document).ready(
        function()
        {
            $('#body1').redactor({
                imageUpload: 'temp'
            });
            $('.redactor_box').css('height', '400px');
            $('.redactor_ redactor_editor').css('height', '400px');
            $('.uploadify').css('margin-left', '20%');
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
    $('form').ajaxForm({
//        beforeSubmit: function() {
//            show();
//        },
//        success: function(data) {
//          
//            savefun(data);
//        }
        beforeSend: function()
        {
          
            $("#progress").show();
            //clear everything
            $("#bar").width('0%');
            $("#message").html("");
            $("#percent").html("0%");
        },
        uploadProgress: function(event, position, total, percentComplete)
        {
            $("#bar").width(percentComplete + '%');
            $("#percent").html(percentComplete + '%');
        },
        success: function(data)
        {
            if (data != "")
            {
                $('#image').val(data);
            }
            else
            {
                $('#img_msg').html('Please Select jpg image.');
                $('#img_msg').show();
            }
            $("#bar").width('100%');
            $("#percent").html('100%');
            $("#progress").hide();
        },
        complete: function(response)
        {
            $("#message").html("<font color='green'>" + response.responseText + "</font>");
        },
        error: function()
        {
            $("#message").html("<font color='red'> ERROR: unable to upload files</font>");
        }

    });
    $("#redactor_file_link").attr("disabled", "");
}
function _close()
{
    window.location.href = './';
}

function rem()
{
    $('#image').val("");
}
function change_fun()
{
    var val = $('#img').val();
    var ext = /^.+\.([^.]+)$/.exec(val);
    if (ext[1] == 'bmp')
    {
        $('#img_msg').html('Warning : bmp image not uploaded .');
        $('#img_msg').show();
        $('#clo').click();
    }
    else
    {
        $('#img_msg').hide();
        $('#btn_sub').click();

    }
}


function savefun()
{
      
    show();
    ur = $('#url_temp').val();
    ur = ur + '/';
    var tag_id = $('#tag_id').val();
//    var name = $('#item_name').val();
    var title = $('#item_title').val();
    var body = $('#body1').val();
    var board_id = $('#bord_id').val();
    var taxoid = $('#taxoid').val();
    var folder_name = $('#folder_name').val();
    var image = $('#image').val();
    var status = $('#status').val(); 
    var call_to_action = $('#call_to_action').val();
    
   
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

    var j = 0;
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
            status: status,
            body: body,
            board_id: board_id,
            taxo: taxo,
            ids: ids,
            img: imgval,
            image: image,
            folder_name: folder_name,
            abc: abc,
            call_to_action : call_to_action
        }

        $.ajax({
            type: "POST",
            url: ur,
            data: dataval,
            success: function(res) {
                if (res == '')
                {
                    window.location.href = './';
                }
                else
                {
                     hide();
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
                $("#progress").hide();
                hide();
                alert('error');
            }
        });
    }
    else
    {
        $("#progress").hide();
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
