<div id="left">
    <div id="latestjob"><li class="botwid widget_text">			<div class="textwidget">Latest Jobs</div>
        </li></div>

    <div id="navigation" class="clearfix">
    </div>
    <div id="navigation" class="clearfix">


                                <!--<div class="wp-pagenavi">-->
                                    <!--<span class="pages">Page 1 of 4</span><span class="current">1</span><a href="http://1stworld.1stsocial.com.au/?page=2" class="page larger">2</a><a href="http://1stworld.1stsocial.com.au/?page=3" class="page larger">3</a><a href="http://1stworld.1stsocial.com.au/?page=4" class="page larger">4</a><a href="http://1stworld.1stsocial.com.au/?page=2" class="nextpostslink">»</a>-->
                                    <div style='margin-left: 80%'><?php echo $this->pagination->create_links();?></div>
                                <!--</div>-->



    </div>
    <?php $loop = 0; if (is_array($post) && isset($post['item'])):foreach ($post['item'] as $val): ?>       
            <div class="tuts"> 
                   <div id="tt">
                <div id="lpouter" class="<?php if($loop%2) echo 'odd'; else echo'even'; ?> job_head_custom test"> <!--start lpouter-->
                
                    <div style="float:left;"> <!--start-->
                        <div class="title">

                            <h2><a rel="bookmark" title="Permanent Link to <?= $val->name; ?>"><?= $val->name; ?></a></h2>
                            <div id="outer">
                                <span class="location">Location: <?php if(isset($post['child'][$loop])):
                                        foreach($post['child'][$loop] as $val1) :
                                            if($val1->parent_tag_id == $post['Location'][0]->id):
                                        ?>
                                    <a href="javascript:footer_refine(<?=$val1->id?>)" rel="tag"><?=$val1->name?></a>
                                    <?php endif; endforeach; endif;?></span><br>
                                <span class="posted">Posted: <?php $dt = human_to_unix($val->createdTime);
        $formate = "%d %M %Y";
        echo mdate($formate, $dt); ?></span> 
                            </div>

                        </div>

                    </div> <!--end-->   
                    <div style="float:right; margin-right: 10px; margin-top: 22px;"> <!--start-->
                        <!--<img class="job-image" src="1stWorld%20_%201stExecutive%20Job%20Board_files/1stexecutive-125x125.png" border="0" height="50" width="50">-->

                    </div> <!--end-->

                </div> <!--endl pouter-->

                <!--Start Jobs_Home-->

                <div id="jobs_home1" style="display: none;" class="jobs_home_cont">

                    <div class="tuts" id="post-226"> 

                        <div class="title">

                            <h1 style="padding-left:60px;"><a style="font-size:28px;" href="<?=  site_url()?>/user/user/detail/<?=$val->id?>" rel="bookmark" title="Permanent Link to <?= $val->title; ?>"><?= $val->title; ?></a></h1>


                            <div id="date"> <!--start date-->
                                <span id="date1"><?php $dt = human_to_unix($val->createdTime);
        $formate = "%d";
        echo mdate($formate, $dt); ?></span><br><span id="year"><?php $dt = human_to_unix($val->createdTime);
        $formate = "%M, %Y";
        echo mdate($formate, $dt); ?></span> 
                            </div> <!--end date-->


                            <div class="postmeta"> 	

                                <span class="user">Posted by <a href="" title="Posts by admin" rel="author"><?php echo $val->user_name; ?></a></span>  

                                <span class="clock"><?php $dt = human_to_unix($val->createdTime);
        $formate = "%l,%d %M %Y";
        echo mdate($formate, $dt); ?></span>  


                                <span class="tags sallery_tag"><?=$post['salary'][$loop][0]->val;?>per year</span>
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
                                
                                <div></div>
                                <div></div>
                            </div>


                            <a class="readmore" href="">Apply Now</a>			
                            <!--<a class="readmore" href="http://1stworld.1stsocial.com.au/jobs/truck-drivers-hc-and-mc-2/"> View Tutorial </a>-->

                            <div class="clear"></div>
                        </div>
                        <div class="orange_saperator"> </div>
                        <span id="list">
                            <a id="viewlist" class="view_list">VIEW LIST</a> 
                            <a href="http://1stworld.1stsocial.com.au/jobs/inside-sales-consultant-3/" id="nextjob" class="next_job">NEXT JOB</a>
                            <div class="link_hidden" style="display:none;">
                                « <a href="http://1stworld.1stsocial.com.au/jobs/inside-sales-consultant-3/" rel="prev">Inside Sales Consultant</a>            </div>
                        </span>

                    </div>
                </div>
                <!--End Jobs_home-->
                <div class="entry">
                   
                    <div class="clear"></div>
                    
                </div>
                </div>
            </div>
    
    <?php $loop++; endforeach;
endif; ?>

</div>

<script>

var shflag = 0 ;
$("div#lpouter").click(function() {
//    alert('tets');
                //$(this).toggleClass("active");
            
    $var = $(this).parent().find("#jobs_home1");
               
                $var.slideToggle('slow');
            });

</script>