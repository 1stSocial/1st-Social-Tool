<div id="left">
    <div id="latestjob"><li class="botwid widget_text">			
            <div class="textwidget">Jobs</div>
        </li></div>

    <div id="navigation" class="clearfix" >

    </div>

    <?php $loop = 0; if(is_array($post) && isset($post['item']) ):foreach ($post['item'] as $val): ?>
        <div class="post" id="post-<?php echo $val->id; ?>">
            <div class="title">
                <h2><a href="" class="title_link" rel="" title="Permanent Link to <?= $val->name; ?>"><?= $val->name; ?></a></h2>
                <div class="postmeta"> 	
                    <span class="user">Posted by <a href="" title="Posts by " rel="author"><?php echo $val->user_name; ?></a></span>  
                    <span class="clock"><?php $dt = human_to_unix($val->createdTime); $formate="%l,%d %M %Y"; echo mdate($formate,$dt); ?></span>  
                    <span class="tags sallery_tag">85000 per year</span>
                                <?php if(isset($post['parent'][$loop])) : foreach ($post['parent'][$loop] as $value) : ?>
                                <span class="tags">
                                    <?php if(isset($post['child'][$loop])):
                                        foreach($post['child'][$loop] as $val1) :
                                            if($val1->parent_tag_id == $value->parent_tag_id):
                                        ?>
                                    <a href="javascript:footer_refine(<?=$val1->id?>)" rel="tag"><?=$val1->name?></a>
                                    <?php endif; endforeach; endif;?>
                                </span>
                                <?php endforeach; endif;?>
                
                </div>
            </div>
            <div class="entry">

                <p><?=$val->title;?></p>
                
                
                <p><?php $str_val = $val->body ;$val_new = str_split($str_val,300); echo $val_new[0].'[..]'; ?></p>
              <a class="readmore" href="<?=site_url()?>/user/user/detail/<?=$val->id?>">Read More </a>
                <div class="clear"></div>
            </div>
        </div>
    <?php $loop++; endforeach;endif; ?>;
    <div class="clear"></div>
</div>