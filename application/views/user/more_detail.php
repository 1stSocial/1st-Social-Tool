<div id="left">
 <?php $loop = 0; if (is_array($post) && isset($post['item'])):foreach ($post['item'] as $val): ?>       
    
       
                    <div class="tuts" id="post-226"> 

                        <div class="title">

                            <h1 style="padding-left:60px;"><a style="font-size:28px;" href="" rel="bookmark" title="Permanent Link to <?= $val->title; ?>"><?= $val->title; ?></a></h1>


                            <!--end date-->


                            <div class="postmeta"> 	

                                <span class="user">Posted by <a href="" title="Posts by admin" rel="author"><?php echo $val->user_name; ?></a></span>  

                                <span class="clock"><?php $dt = human_to_unix($val->createdTime);
        $formate = "%l,%d %M %Y";
        echo mdate($formate, $dt); ?></span>  


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
                                <!--<span class="tags"><a href="" rel="tag">NSW</a><a href="" rel="tag">Regional NSW</a></span>-->


                            </div>

                        </div>
                        <div class="entry" style="padding:0 60px;">
                            <div>
                                <?= $val->body ?>
                                <div></div>
                                <div><a href="http://youtu.be/AGsYz2YTExg">&nbsp;</a></div>
                                <!--<p><iframe src="1stWorld%20_%201stExecutive%20Job%20Board_files/AGsYz2YTExg.htm" allowfullscreen="" frameborder="0" height="315" width="560"></iframe></p>-->
                                <div></div>
                                <div></div>
                            </div>


                            <a class="readmore" href="">Apply Now</a>			
                            <!--<a class="readmore" href="http://1stworld.1stsocial.com.au/jobs/truck-drivers-hc-and-mc-2/"> View Tutorial </a>-->

                            <div class="clear"></div>
                        </div>
                       
                    </div>
                </div>
    <?php $loop++; endforeach;
endif; ?>
    
