<div id="left">
    <?php $loop = 0;
    if (is_array($post) && isset($post['item'])):foreach ($post['item'] as $val): ?>       


            <div class="tuts" id="post-226"> 

                <div class="title">

                    <h1 style="padding-left:60px;"><?= $val->title; ?></h1>


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
                       
                    <div style="margin-top:20px">
                                        <?= $val->body ?>
                                    </div>
                        <div id="taxonomy" style="float: left;width: 45%">
                                        <h3> About </h3>
                                            <?php if (isset($post['taxonomy'][$loop])) : foreach ($post['taxonomy'][$loop] as $value) : ?>
                                                <div id="<?= $value->item_id; ?>">
                                                    <div style="float:left;width:  50%"><?= $value->name." :" ?></div>  <span style=""><?= html_entity_decode($value->value); ?></span>
                                                </div>
                                                <div style="clear: both"></div>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </div>
                        <div style=""> 
                    <?php
                     include 'gallary.php';
                    ?>
                    </div>
                            
                    </div>
                    
                    <div class="clear"></div>
                   
                </div>
            </div>
        </div>
        <?php $loop++;
    endforeach;
endif;
?>
    
