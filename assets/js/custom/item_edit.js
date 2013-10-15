$(document).ready(
        
		function()
		{
                    var url = $('#url').val();
//                     $("select").selectpicker({style: 'active btn-inverse', menuStyle: 'dropdown-inverse'});
			$('#body').redactor({
				imageUpload: url+'/admin/item/temp',
                                
			});
                        
                        
		}
                
	); 
$(document).ready()
{
    $('#body').redactor();
    
     $('.fileupload').fileupload();
     
    $(".chosen-select").chosen();
 
    $('form').ajaxForm({

        
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
    	$("#bar").width(percentComplete+'%');
    	$("#percent").html(percentComplete+'%');

    
    },
    success: function(data) 
    {
       $('#image').val(data);
         $("#bar").width('100%');
        $("#percent").html('100%');
        $("#progress").hide();
    },
    complete: function(response) 
    {
	$("#message").html("<font color='green'>"+response.responseText+"</font>");
    },
    error: function()
    {
    	$("#message").html("<font color='red'> ERROR: unable to upload files</font>");

    }
        
     });
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
    var id = $('#item_id').val();
//    var itemname = $('#name').val();
    var title = $('#title').val();
    var body = $('#body').val();
    var folder_name = $('#folder_name').val();
    var unlink = $('#imgsrc').attr('src');
    var image = $('#image').val();
    var tag = [];
    var taxo = [];
    var ids=[];
    $('#taxodiv').find('input:text')
            .each(function() {
        taxo[this.id] = $(this).val();
    });

    $('#maintaddiv').find('select').find(":selected")
            .each(function() {
        tag[$(this).val()] = $(this).val();

    });
    var i=0;
    $('#taxodiv').find('input:hidden')
            .each(function() {
        ids[i] = $(this).val();
        i++;
    });
    
    if (title != "") {

        var dataval = {
            id: id, // its to be change ;.l;l;l;l;===
            name: title,
            title: title,
            body: body,
            taxo: taxo,
            tag_id: tag,
             ids : ids,
             image : image,
             unlink : unlink,
             folder_name:folder_name
        };

        $.ajax({
            type: "POST",
            url: ur,
            data: dataval,
            success: function(res) {
//                if (res == '')
//                {
//                    setTimeout(function() {
//                        $('#closebtn').click();
//                        window.location.href = './';
//                    }, 200);
//
//                }
//                else
//                {
//                    var obj = jQuery.parseJSON(res);
//
//                    for (var i = 0; i < obj.length; i++)
//                    {
//                        var val = obj[i].split(":");
//                        $id = "#" + val[0] + "d";
//                        $($id).html(val[1]);
//
//                    }
//                }
                    if (res == '')
                {
                   
//                        $('#closebtn').click();
                        window.location.href = '../';
                       
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
                alert(res);
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
    window.location.href = '../';
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
