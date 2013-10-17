<style type="text/css">
    .butun{
        float: right;
       color:#fff;
       text-align:center;
        border-radius:5px;
        padding:10px;
        color:#fff;
        background: rgb(186,96,0); /* Old browsers */
background: -moz-linear-gradient(top, rgba(186,96,0,1) 0%, rgba(253,223,205,1) 3%, rgba(245,139,77,1) 6%, rgba(232,126,65,1) 52%, rgba(225,93,15,1) 55%, rgba(212,80,3,1) 88%, rgba(210,79,1,1) 94%, rgba(218,113,52,1) 97%, rgba(186,96,0,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(186,96,0,1)), color-stop(3%,rgba(253,223,205,1)), color-stop(6%,rgba(245,139,77,1)), color-stop(52%,rgba(232,126,65,1)), color-stop(55%,rgba(225,93,15,1)), color-stop(88%,rgba(212,80,3,1)), color-stop(94%,rgba(210,79,1,1)), color-stop(97%,rgba(218,113,52,1)), color-stop(100%,rgba(186,96,0,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(186,96,0,1) 0%,rgba(253,223,205,1) 3%,rgba(245,139,77,1) 6%,rgba(232,126,65,1) 52%,rgba(225,93,15,1) 55%,rgba(212,80,3,1) 88%,rgba(210,79,1,1) 94%,rgba(218,113,52,1) 97%,rgba(186,96,0,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(186,96,0,1) 0%,rgba(253,223,205,1) 3%,rgba(245,139,77,1) 6%,rgba(232,126,65,1) 52%,rgba(225,93,15,1) 55%,rgba(212,80,3,1) 88%,rgba(210,79,1,1) 94%,rgba(218,113,52,1) 97%,rgba(186,96,0,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(186,96,0,1) 0%,rgba(253,223,205,1) 3%,rgba(245,139,77,1) 6%,rgba(232,126,65,1) 52%,rgba(225,93,15,1) 55%,rgba(212,80,3,1) 88%,rgba(210,79,1,1) 94%,rgba(218,113,52,1) 97%,rgba(186,96,0,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(186,96,0,1) 0%,rgba(253,223,205,1) 3%,rgba(245,139,77,1) 6%,rgba(232,126,65,1) 52%,rgba(225,93,15,1) 55%,rgba(212,80,3,1) 88%,rgba(210,79,1,1) 94%,rgba(218,113,52,1) 97%,rgba(186,96,0,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ba6000', endColorstr='#ba6000',GradientType=0 ); /* IE6-9 */
    }
    
</style>
<div id="left">
    <div id="latestjob"><li class="botwid widget_text">			
               <div class="textwidget"><? if(isset($title) && $title !="") echo strtoupper($title); else {if (isset($board_name)) {
    echo strtoupper($board_name);
} else {
    echo "HOME";
               }}?></div>
        </li></div>

    <div id="navigation1" class="clearfix" >
        <div id="abc" style='margin-right: 0%!important;clear: both;float:right;'><?php echo $this->pagination->create_links();?></div>
    </div>

    <?php $loop = 0; if(is_array($post) && isset($post['item']) ):foreach ($post['item'] as $val): ?>
        <div class="post" id="post-<?php echo $val->id; ?>">
            <div class="title">
                <input type="hidden" value='<?=$pagename;?>' id="pagename" name="pagename">
                <h2><a href="<?=site_url()?>/user/user/detail/<?=$val->id ;?>/<?php if(isset($board_name)) { echo $board_name;}else{echo "home";} ?>/<?php if(isset($_SESSION['fb'])) { echo $_SESSION['fb'];} else{echo "";} ?>" class="title_link" rel="" title="Permanent Link to <?= $val->name; ?>"><?= $val->name; ?></a></h2>
                <div class="postmeta"> 	
                    <span class="user">Posted by <a href="" title="Posts by " rel="author"><?php echo $val->user_name; ?></a></span>  
                    <span class="clock"><?php $dt = human_to_unix($val->createdTime); $formate="%l,%d %M %Y"; echo mdate($formate,$dt); ?></span>  
                    
                    <?php if(isset($post['salary'][$loop][0]->val)) :?>
                                <span class="tags sallery_tag"><?= is_numeric($post['salary'][$loop][0]->val) ? number_format((int)$post['salary'][$loop][0]->val) : $post['salary'][$loop][0]->val; ?></span>
                                <?php endif;?>
                                <?php if(isset($post['parent'][$loop])) : foreach ($post['parent'][$loop] as $value) : ?>
                                <span class="tags">
                                    <?php if(isset($post['child'][$loop])):
                                        foreach($post['child'][$loop] as $val1) :
                                            if($val1->parent_tag_id == $value->parent_tag_id):
                                        ?>
                                    <a href="javascript:footer_refine(<?=$val1->tag_id?>)" rel="tag"><?=$val1->name?></a>
                                    <?php endif; endforeach; endif;?>
                                </span>
                                <?php endforeach; endif;?>
                
                </div>
            </div>
            <div class="entry">

                <p><?=$val->title;?></p>
                <p><?php echo $val->body ?></p>
                <div id="taxonomy">
                                        <h3> About </h3>
                                            <?php if (isset($post['taxonomy'][$loop])) : foreach ($post['taxonomy'][$loop] as $value) : ?>
                                                <div id="<?= $value->item_id; ?>">
                                                    <div style="float: left;width:  20%"><?= $value->name." :" ?></div>  <span style="margin-right: 10%"><?= is_numeric($value->value) ? number_format((int)$value->value) : html_entity_decode($value->value); ?></span>
                                                </div>
                                                <div style="clear: both"></div>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>

                                    </div>
                
                <!--<a class="readmore" href="<?//=site_url()?>/user/user/detail/<?//=$val->id ;?>/<?php //  if(isset($board_name)) { echo $board_name;}else{echo "home";} ?>">Read More </a>-->
                <div class="clear"></div>
                <?php if($val->call_to_action != "")
                                {?>
                                <a href="<?=$val->call_to_action;?>" class="butun"><?php if($btn_name!="") echo $btn_name; else echo 'Click Me!'?></a>	
                                <?}?>
                                <div style="margin: 1px;clear: both"></div>
            </div>
        </div>
    <?php $loop++; endforeach;endif; ?>
    <div class="clear"></div>
      <input type="hidden" name ="b_name" id="board_name" value="<?php if(isset($board_name)) { echo $board_name;}else{echo "home";} ?>">
      <input type="hidden" name ="tag_id" id="tag_id" value="<?php if(isset($tag_id)) { echo $tag_id;}else{echo "";} ?>">
</div>
<script type="text/javascript" src="<?=  base_url();?>assets/js/user/custom/custom.js"></script>
<script>
  

    $(document).ready()
    {
//       alert('abcx');
       $('#abc a').attr('href','javascript:temp()');
       
    };
    </script>