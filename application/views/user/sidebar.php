<div id="left" >
    <?php
    if (isset($content))
        echo $content;
    ?>
</div>

<div id="right">

    <!-- Sidebar widgets -->
    <div class="sidebar">
        <ul>
           <? if(isset($latestjob)): ?> 
            <li class="sidebox super_recent_posts"><h3 class="sidetitl"><a href="">Latest Jobs</a></h3>                
                <?php if (is_array($latestjob)): foreach ($latestjob as $val) : ?>
                        <div class="super_recent_posts_item">
                            <b> <a href="<?= site_url() ?>/user/user/detail/<?= $val['id'] ?>" title="<?= $val['title'] ?>" class="super_recent_posts_item_title"><?= $val['title'] ?></a> </b> 
                            <!--<span>(<a href="" rel="tag">Regional TAS</a>)</span>-->
                        </div>
                    <?php endforeach;
                endif; ?>
            </li>
            <? endif;?>
        <?php if (is_array($tag['Parent'])): foreach ($tag['Parent'] as $data): ?>
                    <li class="sidebox widget_lc_taxonomy">
                        <div id="lct-widget-locations-container" class="list-custom-taxonomy-widget">
                            <h3 class="sidetitl"><?= $data['name'] ?></h3>
                            <ul id="lct-widget">
        <?php foreach ($tag['child'] as $val): if ($val['parent_tag_id'] == $data['tag_id']) : ?>
                                        <li class="cat-item">
                                            <a href="javascript:refine();" title="View all posts filed under <?= $val['name']; ?>"><input type="checkbox" name="child" id="child" value="<?= $val['tag_id']; ?>"/><?= $val['name'] ?></a>
                                        </li>
            <?php endif;
            endforeach; ?>
                            </ul>
                        </div>
                    </li>
    <? endforeach;
endif; ?>

            <li class="sidebox widget_text"><h3 class="sidetitl">salary</h3>			<div class="textwidget"><p class="price_range_p">
                        <input value="$0k - $200k" id="amount" type="text"> per year
                    </p>
                    <div aria-disabled="false" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="slider-range" style="width:240px;"><div style="left: 0%; width: 100%;" class="ui-slider-range ui-widget-header ui-corner-all"></div><a style="left: 0%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a><a style="left: 100%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a></div>
                    <div class="price_skale">  
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|

                        &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|

                        &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|</div>
                    <div class="price_range_footer">
                        <div class="price_range_footer_left">$0</div>
                        <div class="price_range_footer_right">$200k+</div>
                    </div>
                    <input id="min_sal" value="0" type="hidden">
                    <input id="max_sal" value="200000" type="hidden">
                    <input class="refine_btn" value="Refine" id="refine_btn" type="button"></div>
            </li>
        </ul>
    </div>
    <div class="clear"></div>

    <div class="squarebanner ">
        <h3 class="sidetitl"> Sponsors </h3>
        <ul>
            <li>
                <a href="<?= site_url() ?>/user/user/detail/<?= $val['id'] ?>" title=""><img src="" alt="" style="vertical-align:bottom;"></a>
            </li>			

            <li class="rbanner">
                <a href="" title=""><div class="rimg"></div></a>
            </li>

            <li>
                <a href="" title=""><img src="" alt="" style="vertical-align:bottom;"></a>
            </li>

            <li class="rbanner">
                <a href="" title=""><div class="limg"></div></a>
            </li>
        </ul>
    </div>
</div>
<div class="clear"></div>
<input type="hidden" value="<?= site_url(); ?>" id="side_url">