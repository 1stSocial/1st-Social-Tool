function refine()
{
    var siteurl = $('#side_url').val();
    var value = '';
    var i = 0;
    var b_name = $('#board_name').val();
   
    $('#lct-widget-locations-container :checked').each(function() {
        value += $(this).val() + ',';

    });
    var dataval = {
        val: value
    };

     if(b_name == 'home')
        {
            tempurl =  siteurl + '/user/user/index';
        }
     else
     {
         tempurl = siteurl + '/'+b_name;
     }

    $.ajax({
        type: "POST",
        url: tempurl,
        data: dataval,
        success: function(res)
        {
            $('#left').fadeOut('slow',
                    function() {
                        $('#left').html("");
                    }).fadeIn('slow');
            $('#left').fadeOut('slow',
                    function() {
                        $('#left').html(res);
                    }).fadeIn('slow');
        },
        error: function(res)
        {
            alert(res);
        }
    })

}

function change()
{
    var value = $('#val').val();
    less.modifyVars({
        '@theme': value
    });
}

function footer_refine(id)
{
    var siteurl = $('#side_url').val();
    var b_name = $('#board_name').val();
//    alert(b_name);
    var dataval = {
        val: id,
        b_name:b_name
    };


    $.ajax({
        type: "POST",
        url: siteurl + '/user/user/footer_refine',
        data: dataval,
        success: function(res)
        {
            $('#left').fadeOut('slow',
                    function() {
                        $('#left').html("");
                    }).fadeIn('slow');
            $('#left').fadeOut('slow',
                    function() {
                        $('#left').html(res);
                    }).fadeIn('slow');
        },
        error: function(res)
        {
            alert(res);
        }
    });
}


$(document).ready(function() {

    var siteurl = $('#side_url').val();
    //  alert('test');
    var nj = jQuery.noConflict();
    nj(function() {
        nj("#slider-range").slider({
            range: true,
            min: $('#min_sal').val()/1000,
            max: $('#max_sal').val()/1000,
            values: [$('#min_sal').val()/1000, $('#max_sal').val()/1000],
            slide: function(event, ui) {
                nj('#min_sal').val(ui.values[ 0 ] + '000');
                nj('#max_sal').val(ui.values[ 1 ] + '000');
                nj("#amount").val("$" + ui.values[ 0 ] + "k - $" + ui.values[ 1 ] + "k");
            }
        });
        nj("#amount").val("$" + nj("#slider-range").slider("values", 0) +
                "k - $" + nj("#slider-range").slider("values", 1) + "k");
    });

    
    
    $('#searchsubmit').click(function()
    {
        var b_name = $('#board_name').val();
        var search = $('#s').val();
//        alert(b_name);
        if (search != "search")
        {

            var dataval = {
                'search': search,
                'b_name':b_name
            };
            
            $.ajax({
                type: "POST",
                url: siteurl + "/user/user/keyword_search",
                data: dataval,
                 beforeSend:function(){
                $('#searchsubmit').unbind('click');
            },    
                success: function(res)
                {
//                    alert(res);
                    
                    $('#left').fadeOut('slow',
                            function() {
                                $('#left').html("");
                            }).fadeIn('slow');
                    $('#left').fadeOut('slow',
                            function() {
                                $('#left').html(res);
                            }).fadeIn('slow');
                },
                error: function(res)
                {
                    aler('error');
                }
            });
        }
    });

    $('#navigation1 a').click(function (){
        
         var id = $(this).text();
         var b_name = $('#board_name').val();
         var pagename = $('#pagename').val();
         var uri = siteurl;
         
         switch (pagename)
         {
             case 'keyword_search':
                 {
                     uri = uri + "/user/user/keyword_search";
                 }
                 break;
             case 'salary_refine':
                {
                    uri = uri + '/user/user/salary_refine';
                }break;
             case 'footer_refine':
                {
                    uri = uri + '/user/user/footer_refine';
                }
         }
         
        var search = $('#s').val();
//           alert(id);
        if (search != "job search")
        {

            var dataval = {
                'search': search,
                'page' :  id,
                'b_name' :b_name
            };

            $.ajax({
                type: "POST",
                url: uri ,
                data: dataval,
                 beforeSend:function(){
                $('#refine_btn').unbind('click');
            },    
                success: function(res)
                {
//                    alert(res);
                    
                    $('#left').fadeOut('slow',
                            function() {
                                $('#left').html("");
                            }).fadeIn('slow');
                    $('#left').fadeOut('slow',
                            function() {
                                $('#left').html(res);
                            }).fadeIn('slow');
                            
                },
                error: function(res)
                {
                    aler('error');
                }
            });
        }
        return false;
    });

    $('#refine_btn').click(function() {
//  alert("tt34");

    var taxoid =  $('#taxo_id').val()
    if(taxoid == "")
        {
            taxoid = 2;
        }
   var b_name = $('#board_name').val();
        var dataval = {
            min: $('#min_sal').val(),
            max: $('#max_sal').val(),
            b_name : b_name,
            taxoid : taxoid
        };
        alert(taxoid);
        var siteurl = $('#side_url').val();

        $.ajax({
            type: 'POST',
            url: siteurl + '/user/user/salary_refine',
                data: dataval,           
            beforeSend:function(){
                $('#refine_btn').unbind('click');
            },           
            success: function(res)
            {
                clickflag = 0 ;
                $('#left').fadeOut('slow',
                        function() {
                            $('#left').html("");
                        }).fadeIn('slow');
                $('#left').fadeOut('slow',
                        function() {
                            $('#left').html(res);
                        }).fadeIn('slow');
//                        alert('s');
            },
            error: function(res)
            {
                alert('error');
            }
        });
    

    });

});


