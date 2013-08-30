</div>
</div>
<div id="bottom">
    <div class="botcover">
        <ul>

            <li class="botwid widget_pages"><h3 class="bothead">Pages</h3>		
                <ul>
                    <li class="page_item page-item-124"><a href="http://localhost/1stworld/about-us/">About Us</a></li>
                    <li class="page_item page-item-128"><a href="http://localhost/1stworld/become-a-member/">Become A Member</a></li>
                    <li class="page_item page-item-129"><a href="http://localhost/1stworld/help/">Help</a></li>
                </ul>
            </li>
            <?php if(is_array($Parent)): foreach ($Parent as $data):?>
            <li class="botwid widget_lc_taxonomy">
                <div id="lct-widget-locations-container" class="list-custom-taxonomy-widget">
                    <h3 class="bothead"><?=$data['name']?></h3>
                    <ul id="lct-widget-locations">	
                        <?php foreach ($child as $val): if($val['parent_tag_id'] == $data['id']) :  ?>
                        <li class="cat-item cat-item-20"><a href="javascript:footer_refine(<?=$val['id'];?>);" title="View all posts filed under <?=$val['name'];?>"><?=$val['name'];?></a>
                        
                        </li>
                        <?php endif;endforeach;?>
                    </ul>
                </div>
            </li>
            <?  endforeach;endif;?>
<!--m-103"><a href="http://localhost/1stworld/work-types/fifo/" title="View all posts filed under FIFO">FIFO</a> (1)
                        </li>
                    </ul></div>
            </li>	-->
        </ul>
        <div class="clear"></div>
    </div>
</div>

<div id="footer">
    <div class="fcred">
        Copyright © 2013 <a href="http://localhost/1stworld" title="1stWorld">1stWorld</a> - 1stExecutive Job Board Development Site.	<!--<a href="http://www.designcontest.com/website-design/" title="Website Design">Website Design</a> by <a href="http://www.fabthemes.com/" title="WordPress Themes - FabThemes.com">Fab Themes</a>.-->
    </div>	
    <div class="clear"></div>	
    <div style="display:none">

    </div>
</div>
<div class="clear"></div>	



<script>
    var options = {"publisher": "1fa5a027-fa11-4b80-b07b-c50f52e3bc15", "position": "left", "ad": {"visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": {"items": ["twitter", "facebook", "google", "rss", "delicious", "linkedin"]}};
    var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
</script>

<script>
//    jQuery('.sidebar #lct-widget a').each(function() {
//        var current_html = jQuery(this).html();
//        jQuery(this).html('<input type="checkbox" id=child[] />' + current_html);
//    });
//    jQuery('.sidebar #lct-widget-industries-container a').each(function() {
//        var current_html = jQuery(this).html();
//        jQuery(this).html('<input type="checkbox" />' + current_html);
//    });
//    jQuery('.sidebar #lct-widget-work-types-container a').each(function() {
//        var current_html = jQuery(this).html();
//        jQuery(this).html('<input type="checkbox" />' + current_html);
//    });
//    jQuery('.sidebar #lct-widget-occupations-container a').each(function() {
//        var current_html = jQuery(this).html();
//        jQuery(this).html('<input type="checkbox" />' + current_html);
//    });
//    jQuery('.sidebar input[type="checkbox"]').live("click", function() {
//        var check_url = jQuery(this).parent().attr('href');
//        document.location.href = check_url;
//    });
//    jQuery('.sidebar input[type="checkbox"]').each(function() {
//        var this_url = jQuery(this).parent().attr('href');
//        var cur_page_url = document.URL;
//        if (cur_page_url == this_url) {
//            jQuery(this).attr('checked', 'checked');
//        }
//    });

</script>

<script>
//    var nj = jQuery.noConflict();
//    nj(function() {
//        nj("#slider-range").slider({
//            range: true,
//            min: 0,
//            max: 200,
//            values: [0, 200],
//            slide: function(event, ui) {
//                nj('#min_sal').val(ui.values[ 0 ] + '000');
//                nj('#max_sal').val(ui.values[ 1 ] + '000');
//                nj("#amount").val("$" + ui.values[ 0 ] + "k - $" + ui.values[ 1 ] + "k");
//            }
//        });
//        nj("#amount").val("$" + nj("#slider-range").slider("values", 0) +
//                "k - $" + nj("#slider-range").slider("values", 1) + "k");
//    });
//    nj('.refine_btn').click(function() {
//        var site_url_nj = 'http://localhost/1stworld?min_sal=' + nj('#min_sal').val() + '&max_sal=' + nj('#max_sal').val();
//        document.location.href = site_url_nj;
//    });




    /*$(document).ready(function(){
     
     $("#jobs_home").hide();
     $("#lpouter").show();
     
     $('#lpouter').click(function(){ 
     $(this).toggleClass("active"); $(this).next("#jobs_home").stop('true','true').slideToggle("slow");
     //$('#jobs_home').toggle("slow");
     // jQuery.prev()
     $(this).prev('#jobs_home').toggle();
     
     // jQuery.next()
     $(this).next('#jobs_home').toggle();
     });
     
     });
     */
</script>
<script>
//    jQuery('.page').each(function(index, element) {
//        jQuery(this).attr('href', 'http://localhost/1stworld/?page=' + jQuery(this).html());
//    });
//    var current_page = jQuery('.current').html();
//    previous_page = current_page - 1;
//    var next_page = ++current_page;
//    jQuery('.previouspostslink').attr('href', "http://localhost/1stworld/?page=" + previous_page);
//    jQuery('.nextpostslink').attr('href', 'http://localhost/1stworld/?page=' + next_page);
//    jQuery('.next_job').each(function() {
//        var next_link = jQuery(this).next().children('a').attr('href');
//        jQuery(this).attr('href', next_link);
//    });
//    $(".view_list").click(function() {
//        $("#jobs_home").hide();
//        jQuery('.jobs_home_cont').hide();
//
//    });
//    jQuery('.job_head_custom').click(function() {
//        jQuery('.jobs_home_cont').hide();
//    });
</script>

<div style="position: absolute; top: -1999px; left: -1988px;" id="stcpDiv">ShareThis Copy and Paste</div>
<iframe style="display:none;" src="" name="stSegmentFrame" id="stSegmentFrame" frameborder="0" height="0px" scrolling="no" width="0px"></iframe>
<div style="visibility: hidden; top: -999px; left: -999px; width: 500px; z-index: 89999999;" class="stwrapper" id="stwrapper">
    <div class="stCloseNew2"></div>
    <iframe src="1stWorld%20_%201stExecutive%20Job%20Board_files/index.htm" style="top: 0px; left: 0px;" name="stLframe" class="stLframe" id="stLframe" allowtransparency="true" frameborder="0" height="430px" scrolling="no" width="500px">

    </iframe>
</div>
<div id="stOverlay" style="height: 100%; width: 100%; background-color: rgb(0, 0, 0); opacity: 0.6; position: fixed; display: none; left: 0px; top: 0px; z-index: 89999990;">

</div>
</body>
</html>