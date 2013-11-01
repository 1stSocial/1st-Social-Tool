function refine_a()
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

    if (b_name == 'home')
    {
        tempurl = siteurl + '/user/user/index';
    }
    else
    {
        var fb = $('#fb').val();
        
        if(fb == 'fb')
        tempurl = siteurl + '/user/user/fb/' + b_name;
        else
        tempurl = siteurl + '/user/user/board/' + b_name;    
    
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
    localStorage.setItem("refine", 1);
    sessionStorage.setItem( 'abc', value);
    sessionStorage.setItem( 'fun_call', 'refine_a()');
    sessionStorage.setItem( 'fun_name', 'refine');
};
function change_det()
{
    $('#last_use').val('side_val');
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
        b_name: b_name
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
//    sessionStorage.setItem( 'abc', id);
    sessionStorage.setItem( 'fun_call', 'refine('+id+')');
    sessionStorage.setItem( 'fun_name', 'footer');
}

function num_refine(min, max)
{
    $('#min').val(min);
    $('#max').val(max);

    $('#refine_btn').click();
    sessionStorage.setItem( 'fun_call', 'num_refine('+min+','+max+')');
    
     sessionStorage.setItem('min_val',min);
        sessionStorage.setItem('max_val', max);
        sessionStorage.setItem( 'fun_name', 'num_refine');
//        alert(sessionStorage.getItem('fun_call'));
}

$(document).ready(function() {
    var str = $('#navigation1 strong').html();
    if (str)
        $('#navigation1').html($('#navigation1').html().replace('<strong>' + str + '</strong>', '<a href=' + str + '>' + str + '</a>'));

    var siteurl = $('#side_url').val();

    var nj = jQuery.noConflict();
    nj(function() {
        var min_start = 0;
        var max_start = 0;
        if(($('#min').val() / 1000000)>1)
                    {
                        var min_start = Math.round((($('#min').val() / 1000000)*10)/10) + 'm';
                    }
                    else
                        {
                            var min_start = Math.round((($('#min').val() / 1000)*10)/10) + ' k';
                        }
                        
                if(($('#max').val()/ 1000000)>1)
                {
                    var max_start =   Math.round((($('#max').val() / 1000000)*10)/10) + ' m';
                }
                else
                    {
                        var max_start =  Math.round((($('#max').val()/ 1000)*10)/10) +' k' ;
                    }
        nj("#slider-range").slider({
            
            range: true,
            min: $('#min_sal').val() / 1000,
            max: $('#max_sal').val() / 1000,
            values: [$('#min').val() / 1000,$('#max').val() / 1000],
            slide: function(event, ui) {
                nj('#min').val(ui.values[ 0 ] * 1000);
                nj('#max').val(ui.values[ 1 ] * 1000);
                min_start = ui.values[ 0 ] * 1000;
                max_start = ui.values[ 1 ] * 1000;
                
                if((ui.values[ 0 ]/1000)>1)
                    {
                        var min =  Math.round((ui.values[ 0 ]/1000) * 10)/10 + 'm';
                    }
                    else
                        {
                            var min =  Math.round((ui.values[ 0 ]) * 10)/10 + 'k';
                        }
                if((ui.values[ 1 ]/1000)>1)
                {
                    var max =  Math.round(ui.values[ 1 ]/1000) + 'm'
                }
                else
                    {
                        var max =  Math.round((ui.values[ 1 ]) * 10)/10 + 'k';
                    }
                nj("#amount").val("$" + min + " - $" + max );
                $('#last_use').val('abc');
            }
        });
        nj("#amount").val("$" + min_start +
                " - $" + max_start);
        
        
    });

    var temp = 0;

    localStorage.setItem("temp", 0);
    $('#searchsubmit').click(function()
    {
        var b_name = $('#board_name').val();
        var search = $('#s').val();
//        alert(b_name);
        if (search != "search")
        {

            var dataval = {
                'search': search,
                'b_name': b_name
            };
            var x = localStorage.getItem("temp");
            if (x == 0)
            {
                $.ajax({
                    type: "POST",
                    url: siteurl + "/user/user/keyword_search",
                    data: dataval,
                    beforeSend: function() {
                        temp = 1;
                        localStorage.setItem("temp", 1);
                        $('#searchsubmit').unbind('click');
//                $('#searchsubmit').unbind('click');
                    },
                    success: function(res)
                    {
//                    var x = localStorage.getItem("temp");
//                    alert('abc-'+x);

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
        }
    });



    $('#abc a').click(function() {
      
        var id = $(this).text();
        var b_name = $('#board_name').val();
        var pagename = $('#pagename').val();
        var taxoid = $('#taxo_id').val();
        var search = $('#s').val();
        var fb = $('#fb').val();
        
        if (taxoid == "")
        {
            taxoid = 2;
        }
        var uri = siteurl;
        switch (pagename)
        {
            case 'keyword_search':
                {
                    uri = uri + "/user/user/keyword_search/"+id;;
                    var dataval = {
                        'search': search,
                        'page': id,
                        'b_name': b_name
                    };
                }
                break;
            case 'salary_refine':
                {
                    uri = uri + '/user/user/salary_refine/'+id;;
                    var dataval = {
                        'page': id,
                        'b_name': b_name,
                        'min': $('#min').val(),
                        'max': $('#max').val(),
                        'taxoid': taxoid,
                         'fb' : fb
                    };
                }
                break;
            case 'footer_refine':
                {
                   
                    var tag_id = $('#tag_id').val();
                    uri = uri + '/user/user/footer_refine/'+id;
                    var dataval = {
                        'val': tag_id,
                        'page': id,
                        'b_name': b_name
                    };
                }
                break;
            case 'sidebar_refine':
                {
                    var value = "";
                    
                    $('#lct-widget-locations-container :checked').each(function() {
                        value += $(this).val() + ',';

                    });
                    var dataval = {
                        val: value,
                        pagename : 'sidebar_refine',
//                        'page': id,
                    };
                    uri = siteurl + '/user/user/board/' + b_name+'/'+id;
                }
                break;
        }


        if (search != "job search")
        {
            $.ajax({
                type: "POST",
                url: uri,
                data: dataval,
                beforeSend: function() {
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

    var refine = 0;

    localStorage.setItem("refine", 0);
    $('#refine_btn').click(function() {
//  alert("tt34");

var call_fun = $('#last_use').val();

var y = localStorage.getItem("refine");
        if (y == 0)
        {
      if(call_fun == 'side_val')      
        refine_a();
        else
            {
       var taxoid = $('#taxo_id').val()
        if (taxoid == "")
        {
            taxoid = 2;
        }
        var b_name = $('#board_name').val();
         var fb = $('#fb').val();
         
        var dataval = {
            min: $('#min').val(),
            max: $('#max').val(),
            b_name: b_name,
            taxoid: taxoid,
            fb : fb
        };
         sessionStorage.setItem( 'fun_call', 'num_refine('+ $('#min').val()+','+$('#max').val()+')');
         sessionStorage.setItem('min_val',$('#min').val());
        sessionStorage.setItem('max_val', $('#max').val());
        sessionStorage.setItem( 'fun_name', 'num_refine');
        
        var siteurl = $('#side_url').val();
        
            $.ajax({
                type: 'POST',
                url: siteurl + '/user/user/salary_refine',
                data: dataval,
                beforeSend: function() {
                    refine = 1;
                    localStorage.setItem("refine", 1);
                    $('#refine_btn').unbind('click');
                },
                success: function(res)
                {
                    clickflag = 0;
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
        }
        }

    });

});


