<div id="left">
    <?php $loop = 0;
    if (is_array($post) && isset($post['item'])):foreach ($post['item'] as $val): ?>       


            <div class="tuts" id="post-226"> 

                <div class="title">

                    <h1 style="padding-left:60px;"><a style="font-size:28px;" href="" rel="bookmark" title="Permanent Link to <?= $val->title; ?>"><?= $val->title; ?></a></h1>


                    <!--end date-->

                    <div class="postmeta"> 	

                        <span class="user">Posted by <a href="" title="Posts by admin" rel="author"><?php echo $val->user_name; ?></a></span>  

                        <span class="clock"><?php
                            $dt = human_to_unix($val->createdTime);
                            $formate = "%l,%d %M %Y";
                            echo mdate($formate, $dt);
                            ?></span>  

                        <?php if (isset($post['salary'][$loop][0]->val)) : ?>
                            <span class="tags sallery_tag"><?= $post['salary'][$loop][0]->val; ?> per year</span>
                            <?php endif; ?>
                            <?php if (isset($post['parent'][$loop])) : foreach ($post['parent'][$loop] as $value) : ?>
                                <span class="tags">
                                    <?php
                                    if (isset($post['child'][$loop])):
                                        foreach ($post['child'][$loop] as $val1) :
                                            if ($val1->parent_tag_id == $value->parent_tag_id):
                                                ?>
                                                <a href="javascript:footer_refine(<?= $val1->tag_id ?>)" rel="tag"><?= $val1->name ?></a>
                        <?php endif;
                    endforeach;
                endif; ?>
                                </span>
                            <?php endforeach;
                        endif; ?>

                    </div>

                </div>
                <div class="entry" style="padding:0 60px;">
                    <div style="text-align: justify">
        <?= $val->body ?>
                        <div></div>
                        <div><a href="http://youtu.be/AGsYz2YTExg">&nbsp;</a></div>
                        <div></div>
                        <div></div>
                    </div>

                    <div class="clear"></div>
                    <a class="readmore" href="">Apply Now</a>		
                </div>
            </div>
        </div>
        <?php $loop++;
    endforeach;
endif;
?>
    
