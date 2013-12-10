
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

    <div id="navigation1" class="clearfix" >
        <div id="abc" style='margin-right: 0%!important;clear: both;float:right;'><?php echo $this->pagination->create_links(); ?></div>
    </div>
    <input type="hidden" name ="fb" id="fb" value="<?php
           if (isset($_SESSION['fb'])) {
               echo $_SESSION['fb'];
           } else {
               echo "";
           }
           ?>">
            <?php $loop = 0;
            if (is_array($post) && isset($post['item'])):foreach ($post['item'] as $val): ?>

            <div class="tuts"> 
                <div id="tt">
                    <div onclick="abc('<?= site_url() ?>/user/user/detail/<?= $val->id ?>/<?php
                         if (isset($board_name)) {
                             echo $board_name;
                         } else {
                             echo "home";
                         }
                         ?>/<?php if (isset($_SESSION['fb'])) {
                             echo $_SESSION['fb'];
                         } else {
                             echo "";
                         } ?>')" id="lpouter" class="<?php
                                    if ($loop % 2)
                                        echo 'odd';
                                    else
                                        echo'even';
                                    ?> job_head_custom test"> 

                        <div class="size_div" style="float:left;width:74%"> <!--start-->
                            <div class="title">

                                <h2><a rel="bookmark" href="<?= site_url() ?>/user/user/detail/<?= $val->id ?>/<?php
                                       if (isset($board_name)) {
                                           echo $board_name;
                                       } else {
                                           echo "home";
                                       }
                                       ?>/<?php if (isset($_SESSION['fb'])) {
                                           echo $_SESSION['fb'];
                                       } else {
                                           echo "";
                                       } ?>" title="Permanent Link to <?= $val->title; ?>"><?= $val->title; ?></a>
                                  
                                </h2>
                                <div id="outer">
        <!--                                    <span class="location">Location: <?php
//                                        if (isset($post['child'][$loop])):
//                                            foreach ($post['child'][$loop] as $val1) :
//                                                if ($val1->parent_tag_id == $post['Location'][0]->id):
//                                                    
                                        ?>
                                                    <a href="javascript:footer_refine(//<? //= $val1->id   ?>)" rel="tag"><? //= $val1->name   ?></a>
                                                //<?php
//                                                endif;
//                                            endforeach;
//                                        endif;
                                        ?></span><br>-->

                                    <div style=" text-align: justify; padding-right: 12px;"><?php
                            echo substr($val->body, '0', '150') . '...';
                            ?>    
                                    </div> 
                                </div>

                            </div>

                        </div> <!--end-->   
                        <div class="img_div" style="float:right; margin:5px;"> <!--start-->
                            
                           <?php 
                                   
                                    if($val->status != '0')
                                    {
                                    ?>
                                    <img class="imgdiv_status" src="<?php echo base_url().$val->status;?>" alt="" height="50" width="50">
                                    <?php
                                    }
                                    ?>
                            
                            <img src="<?php
                         if ($val->image != "")
                             echo base_url() . '/' . $val->image;
                         else
                             echo base_url() . '/assets/css/user/itemimage/default.png';
                         ?>" alt="admin" height="100" width="100">  

                        </div> <!--end-->
                        <div class="clear"></div>

                    </div> <!--endl pouter-->

                    <!--Start Jobs_Home-->

                    <!--End Jobs_home-->
                    <div class="entry">


                        <div style="margin: 1px;clear: both"></div>
                        <input type="hidden" value='<?= $pagename; ?>' id="pagename" name="pagename">
                    </div>
                </div>
            </div>

        <?php $loop++;
    endforeach;
endif; ?>
    <div class="clear"></div>
    <div id="navigation1" class="clearfix" >
        <div id="abc" style='margin-right: 0%!important;clear: both;float:right;'><?php echo $this->pagination->create_links(); ?></div>
    </div>
    <input type="hidden" name ="b_name" id="board_name" value="<?php if (isset($board_name)) {
    echo $board_name;
} else {
    echo "home";
} ?>">
    <input type="hidden" name ="tag_id" id="tag_id" value="<?php if (isset($tag_id)) {
    echo $tag_id;
} else {
    echo "";
} ?>">
</div>
<script type="text/javascript" src="<?= base_url(); ?>assets/js/user/custom/custom.js"></script>
<script>
                        function abc(link) {
                            sessionStorage.setItem('data', link);
//       <% Session["Test"] = "Welcome Mamu"; %>
                            window.location = link;

//        session.setAttribute("abc",link);
                        }


                        $(document).ready()
                        {
//       alert('abcx');
                            $('#abc a').attr('href', 'javascript:temp()');

                        }
                        ;
</script>
<style>
    .imgdiv_status {
        left: 103px;
        position: relative;
        top: -50px;
        z-index: 11;
    }
</style>