$(document).ready(
		function()
		{
                    var url = $('#url').val();
             
			$('#body').redactor({
				imageUpload: url+'/admin/item/temp',
                                
			});
                        
                        
		}
	);
$(document).ready()
{
    setTimeout(function() {
        $('#mod1').click();
    }, 100);

    $('#body').redactor();
    
     $('.fileupload').fileupload();
     
    $(".chosen-select").chosen({width: "50%"});
 
    $('form').ajaxForm({
        beforeSubmit: function() {
            
        },
        success: function(data) {
         
            savefun(data);
        }
     });
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
    var id = $('#item_id').val();
//    var itemname = $('#name').val();
    var title = $('#title').val();
    var body = $('#body').val();
    var folder_name = $('#folder_name').val();
    var unlink = $('#imgsrc').attr('src');
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
                    setTimeout(function() {
                        $('#closebtn').click();
                        window.location.href = '../';
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
    window.location.href = '../';
}