$(document).ready(
		function()
		{
			$('#body1').redactor({
				imageUpload: 'temp'
			});
		}
	);
$(document).ready()
{
    setTimeout(function() {
        jQuery('#mod1').click();
    }, 100);
 
   $('.fileupload').fileupload();
   
     $('form').ajaxForm({
        beforeSubmit: function() {
            
        },
        success: function(data) {
            
            savefun(data);
        }
     });



  $("#redactor_file_link").attr("disabled","");
// var nj = jQuery.noConflict();
//  nj(function() {
//    nj('#body1').redactor(function (){
//         
//        $('#redactor_content').redactor({
//            imageUpload: '/modules/upload.php'
//        });
//    });
//   });
}



function _close()
{
    window.location.href = './';
}
function savefun(image)
{ 
    alert(image);
    ur = $('#url_temp').val();
    ur = ur + '/';
    var tag_id = $('#tag_id').val();
    var name = $('#item_name').val();
    var title = $('#item_title').val();
    var body = $('#body').val();
    var board_id = $('#bord_id').val();
    var taxoid =  $('#taxoid').val();
//    var imgval = $('#imgsrc').attr('src');
//    alert(imgval); 
//    alert(img);
    
    var taxo = [];
    var ids=[];
    $('#taxodiv').find('input:text')
            .each(function() {
        taxo[this.id] = $(this).val();
    });
    var i =0;
    $('#taxodiv').find('input:hidden')
            .each(function() {
        ids[i] = $(this).val();
        i++;
    });
    
    var imgval;
    
     $('#imgdiv').find('img')
            .each(function() {
        imgval = $(this).attr('src');
       
    });
    
    if (name != "" && title != "" && body != "") {

        var dataval = {
            tag_id: tag_id, // its to be change ;.l;l;l;l;===
            name: name,
            title: title,
            body: body,
            board_id: board_id,
            taxo: taxo,
            ids : ids,
            img : imgval,
            image : image
        }

        $.ajax({
            type: "POST",
            url: ur,
            data: dataval,

       
            success: function(res) {
//                alert('cl');
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
                    alert('dsdss');
            }
        });
    }
    else
    {
        alert('else');
        $("#error").show();
    }
}
function _close()
{
    window.location.href = './';
}
