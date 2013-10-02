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
           <? if(isset($latestjob)):?> 
            <li class="sidebox super_recent_posts"><h3 class="sidetitl"><a href="">Latest <?php if(isset($board_name)) if($board_name == 'home') echo 'job';else echo $board_name ?></a></h3>                
                <?php if (is_array($latestjob)): foreach ($latestjob as $val) : ?>
                        <div class="super_recent_posts_item">
                            <b> <a href="<?= site_url() ?>/user/user/detail/<?= $val['id'] ?><?php if(isset($board_name)) { echo '/'.$board_name;}else{echo "/home";} ?>" title="<?= $val['title'] ?>" class="super_recent_posts_item_title"><?= $val['title'] ?></a> </b> 
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
                                            <input onchange="refine()" type="checkbox" name="child" id="child" value="<?= $val['tag_id']; ?>"/><?= $val['name'] ?>
                                        </li>
            <?php endif;
            endforeach; ?>
                            </ul>
                        </div>
                    </li>
    <? endforeach;
endif; ?>

                    <li class="sidebox widget_text"><h3 class="sidetitl"><?php if(isset($max_min['name'])) echo $max_min['name'];else echo 'Salary'; ?></h3><div class="textwidget">
                        <ul id="lct-widget">  
                          <?php if(isset($max_min['name'])){
                          $temp = (($max_min['max']*1000) - ($max_min['min']*1000))/4;
                                $val=0; 
                          for($i=1;$i<5;$i++){?>
                            <li>    
                                <?php 
                                    $t1 = number_format($val);
                                    $t2 = number_format(($val+$temp)-1)
                                ?>
                                <input onchange="num_refine(<?=$val?>,<?=($val+$temp)-1?>)" type="radio" name="salref" id="salref" value="<?php echo $val ."-".  ($val+$temp)-1?>"/><?php echo $t1; echo "&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;&nbsp;&nbsp;";  echo $t2 ;?>   
                          </li>
                                <?php 
                            $val = $val + $temp;
                          } }
                          else
                          {
                              echo "<br><br>";
                          }
                          ?>
                        </ul>    
                            <br>
                    <div aria-disabled="false" class="ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="slider-range" style="width:240px;">
                        <div style="left: 0%; width: 100%;" class="ui-slider-range ui-widget-header ui-corner-all"></div>
                        <a style="left: 0%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a>
                        <a style="left: 100%;" class="ui-slider-handle ui-state-default ui-corner-all" href="#"></a>
                    </div>
                    <div class="price_skale">  
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|

                        &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|

                        &nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;&nbsp;|</div>
                    <div class="price_range_footer">
                        <div class="price_range_footer_left"><?php if(isset($max_min['min'])) echo "$".$max_min['min']."k+"; else echo '$0k+'; ?></div>
                     <p class="price_range_p"><input value="<?php if(isset($max_min['min'])) echo $max_min['min']."k"; else echo '0'; ?> - <?php if(isset($max_min['max'])) echo $max_min['max']."k"; else echo '200'; ?>" id="amount" type="text">
                  </p>
                        <div class="price_range_footer_right"><?php if(isset($max_min['max'])) echo "$".$max_min['max']."k+"; else echo '$200k+'; ?></div>
                    </div>
                    <input id="min_sal" value="<?php if(isset($max_min['min'])) echo $max_min['min']*1000;else echo '0'; ?>" type="hidden">
                    <input id="max_sal" value="<?php if(isset($max_min['max'])) echo $max_min['max']*1000;else echo '200000'; ?>" type="hidden">
                    <input id="min" value="<?php if(isset($max_min['min'])) echo $max_min['min']*1000;else echo '0'; ?>" type="hidden">
                    <input id="max" value="<?php if(isset($max_min['max'])) echo $max_min['max']*1000;else echo '200000'; ?>" type="hidden">
                    <input id="taxo_id" type="hidden" value="<?php if(isset($max_min['taxoid'])) echo $max_min['taxoid']; else echo ""?>">
                    <input class="refine_btn" value="Refine" id="refine_btn" type="button"></div>
            </li>
        </ul>
    </div>
    <div class="clear"></div>

    <div class="squarebanner ">
        <h3 class="sidetitl"> Sponsors </h3>
        <ul>
<!--            <li>
                <a href="<?= site_url() ?>/user/user/detail/<?= $val['id'] ?>" title=""><img src="" alt="" style="vertical-align:bottom;"></a>
            </li>			-->

            <li class="rbanner">
                <a href="" title=""><div class="rimg"></div></a>
            </li>

<!--            <li>
                <a href="" title=""><img src="" alt="" style="vertical-align:bottom;"></a>
            </li>-->

            <li class="rbanner">
                <a href="" title=""><div class="limg"></div></a>
            </li>
        </ul>
    </div>
</div>
<div class="clear"></div>
<input type="hidden" name ="b_name" id="board_name" value="<?php if(isset($board_name)) { echo $board_name;}else{echo "home";} ?>">
<input type="hidden" value="<?= site_url(); ?>" id="side_url">