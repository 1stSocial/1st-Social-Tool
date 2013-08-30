function refine()
{
    var siteurl = $('#side_url').val();
    var value = '';
    var i = 0;

    $('#lct-widget-locations-container :checked').each(function() {
        value += $(this).val() + ',';

    });
    var dataval = {
        val: value
    };


    $.ajax({
        type: "POST",
        url: siteurl + '/user/user/index',
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

    var dataval = {
        val: id
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

$(document).ready(function(){
  //  alert('test');
var nj = jQuery.noConflict();
nj(function(){
    nj("#slider-range").slider({
        range: true,
        min: 0,
        max: 200,
        values: [0, 200],
        slide: function(event, ui) {
            nj('#min_sal').val(ui.values[ 0 ] + '000');
            nj('#max_sal').val(ui.values[ 1 ] + '000');
            nj("#amount").val("$" + ui.values[ 0 ] + "k - $" + ui.values[ 1 ] + "k");
        }
    });
    nj("#amount").val("$" + nj("#slider-range").slider("values", 0) +
            "k - $" + nj("#slider-range").slider("values", 1) + "k");
});


$('#refine_btn').click(function(){
   
   var dataval = {
     min:$('#min_sal').val(),
     max:$('#max_sal').val()
   };
   
   var siteurl = $('#side_url').val();
   
   $.ajax({
           type:'POST',
           url:siteurl+'/user/user/salary_refine',
           data:dataval,
           success:function (res)
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
           error:function (res)
           {
               alert('error');
           }
   });

});

});


