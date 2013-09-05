</div>
</div>
<div id="bottom">
    <div class="botcover">
        <ul>

            <li class="botwid widget_pages"><h3 class="bothead">Pages</h3>		
                <ul>
                    <li class="page_item page-item-124"><a href="">About Us</a></li>
                    <li class="page_item page-item-128"><a href="">Become A Member</a></li>
                    <li class="page_item page-item-129"><a href="">Help</a></li>
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