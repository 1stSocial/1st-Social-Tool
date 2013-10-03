<div id="left">
    <div id="latestjob"><li class="botwid widget_text">	
            <div class="textwidget"><?
                if (isset($title) && $title != "")
                    echo strtoupper($title); else {
                    if (isset($board_name)) {
                        echo strtoupper($board_name);
                    } else {
                        echo "HOME";
                    }
                }
                ?></div>
        </li></div>


    <div id="navigation" class="clearfix">


        <div style='margin-left: 80%'><?php echo $this->pagination->create_links(); ?></div>
        <!--</div>-->
        <input type="hidden" value="<?= $pageno; ?>" id="pageno" name="pageno">
        <input type="hidden" value="<?= site_url(); ?>" id="t" name="t">

    </div>
    <?php
    $loop = 0;
    if (is_array($post) && isset($post['item'])):foreach ($post['item'] as $val):
            ?>       
            <div class="tuts"> 
                <div id="tt">
                    <div id="lpouter" class="<?php
                    if ($loop % 2)
                        echo 'odd';
                    else
                        echo'even';
                    ?> job_head_custom test"> <!--start lpouter-->

                        <div style="float:left;"> <!--start-->
                            <div class="title">

                                <h2><a rel="bookmark" title="Permanent Link to <?= $val->name; ?>"><?= $val->name; ?></a></h2>
                                <div id="outer">
        <!--                                    <span class="location">Location: <?php
//                                        if (isset($post['child'][$loop])):
//                                            foreach ($post['child'][$loop] as $val1) :
//                                                if ($val1->parent_tag_id == $post['Location'][0]->id):
//                                                    
                                    ?>
                                                    <a href="javascript:footer_refine(//<? //= $val1->id  ?>)" rel="tag"><? //= $val1->name  ?></a>
                                                //<?php
//                                                endif;
//                                            endforeach;
//                                        endif;
                                    ?></span><br>-->
                                    <span class="posted">Posted: <?php
                                        $dt = human_to_unix($val->createdTime);
                                        $formate = "%d %M %Y";
                                        echo mdate($formate, $dt);
                                        ?></span> 
                                </div>

                            </div>

                        </div> <!--end-->   
                        <div style="float:right; margin:5px;"> <!--start-->
                            <img src="<?php
                            if ($val->image != "")
                                echo base_url() . '/' . $val->image;
                            else
                                echo base_url() . '/assets/css/user/itemimage/default.png';
                            ?>" alt="admin" height="100" width="100">  

                        </div> <!--end-->

                    </div> <!--endl pouter-->

                    <!--Start Jobs_Home-->

                    <div id="jobs_home1" style="display: none;" class="jobs_home_cont">

                        <div class="tuts" id="post-226"> 

                            <div class="title">

                                <h1 style="padding-left:60px;"><a style="font-size:28px;" href="<?= site_url() ?>/user/user/detail/<?= $val->id ?>/<?php
                                    if (isset($board_name)) {
                                        echo $board_name;
                                    } else {
                                        echo "home";
                                    }
                                    ?>" rel="bookmark" title="Permanent Link to <?= $val->title; ?>"><?= $val->title; ?></a></h1>


                                <div id="date"> <!--start date-->
                                    <span id="date1"><?php
                                        $dt = human_to_unix($val->createdTime);
                                        $formate = "%d";
                                        echo mdate($formate, $dt);
                                        ?></span><br><span id="year"><?php
                                        $dt = human_to_unix($val->createdTime);
                                        $formate = "%M, %Y";
                                        echo mdate($formate, $dt);
                                        ?></span> 
                                </div> <!--end date-->


                                <div class="postmeta"> 	
                                    <span class="user">Posted by <a href="" title="Posts by admin" rel="author"><?php echo $val->user_name; ?></a></span>  

                                    <span class="clock"><?php
                                        $dt = human_to_unix($val->createdTime);
                                        $formate = "%l,%d %M %Y";
                                        echo mdate($formate, $dt);
                                        ?></span>  

                                    <?php if (isset($post['salary'][$loop][0]->val)) : ?>
                                        <span class="tags sallery_tag"><?= $post['salary'][$loop][0]->val; ?></span>
                                        <?php endif; ?>
                                        <?php if (isset($post['parent'][$loop])) : foreach ($post['parent'][$loop] as $value) : ?>
                                            <span class="tags">
                                                <?php
                                                if (isset($post['child'][$loop])):
                                                    foreach ($post['child'][$loop] as $val1) :
                                                        if ($val1->parent_tag_id == $value->parent_tag_id):
                                                            ?>
                                                            <a href="javascript:footer_refine(<?= $val1->id ?>)" rel="tag"><?= $val1->name ?></a>
                                                            <?php
                                                        endif;
                                                    endforeach;
                                                endif;
                                                ?>
                                            </span>
                                            <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>
                            </div>
                            <div class="entry" style="padding:0 60px;">
                                <div>
                                    
        
                                    <div style="margin-top:20px">
                                        <?= $val->body ?>
                                    </div>
                                    
                                    <div id="taxonomy">
                                        <h3> About</h3>
                                            <?php if (isset($post['taxonomy'][$loop])) : foreach ($post['taxonomy'][$loop] as $value) : ?>
                                                <div id="<?= $value->item_id; ?>">
                                                    <div style="float: left;width:  20%"><?= $value->name." :" ?></div>  <span style="margin-right: 10%"><?= $value->value; ?></span>
                                                    <div style="clear: both"></div>
                                                </div>
                                                
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>

                                    </div>
                                </div>

                                <div class="clear"></div>

                            </div>
                            
                            <!--<span id="list">-->
                            <!--<a id="viewlist" class="view_list">VIEW LIST</a>--> 
                            <!--<a href="http://1stworld.1stsocial.com.au/jobs/inside-sales-consultant-3/" id="nextjob" class="next_job">NEXT JOB</a>-->
                            <!--                                <div class="link_hidden" style="display:none;">
                                                                <a href="http://1stworld.1stsocial.com.au/jobs/inside-sales-consultant-3/" rel="prev">Inside Sales Consultant</a>            </div>
                                                        </span>-->

                        </div>
                             <div class="orange_saperator"> </div>
                    </div>
               
                    <!--End Jobs_home-->
                    <div class="entry">

                        <div class="clear"></div>

                    </div>
                </div>
            </div>

            <?php
            $loop++;
        endforeach;
    endif;
    ?>
    <input type="hidden" name ="b_name" id="board_name" value="<?php
           if (isset($board_name)) {
               echo $board_name;
           } else {
               echo "home";
           }
           ?>">
</div>

<script>

    var shflag = 0;
    $("div#lpouter").click(function() {

        $var = $(this).parent().find("#jobs_home1");

        $var.slideToggle('slow');
    });


    $('#navigation a').click(function() {

        var id = $(this).text();
        var pageno = $('#pageno').val();

        $('#pageno').val(id);

    });

    $(document).ready()
    {
        var str = $('#navigation strong').html();
        var value = $('#t').val();
        var b_name = $('#board_name').val();
        if (b_name == 'home')
        {
            $('#navigation').html($('#navigation').html().replace('<strong>' + str + '</strong>', '<a href=' + value + '/user/user/index/' + str + '>' + str + '</a>'));

            $('#navigation').html($('#navigation').html().replace('<a href=' + value + '/user/user/index/' + $('#pageno').val() + '>' + $('#pageno').val() + '</a>', '<strong>' + $('#pageno').val() + '</strong>'));
        }
        else
        {
            $('#navigation').html($('#navigation').html().replace('<strong>' + str + '</strong>', '<a href=' + value + '/user/user/board/' + b_name + '/' + str + '>' + str + '</a>'));

            $('#navigation').html($('#navigation').html().replace('<a href=' + value + '/user/user/board/' + b_name + '/' + $('#pageno').val() + '>' + $('#pageno').val() + '</a>', '<strong>' + $('#pageno').val() + '</strong>'));
        }
    }
</script>