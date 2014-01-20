<input type="hidden" name ="fb" id="fb" value="<?php
if ($fb_val == 'fb') {
    echo 'fb';
} else {
    echo "";
}
?>">
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

    .title h1 {
        padding-left: 0px !important;
    }

</style>

<?php
//           print_r($post);
//die();
?>
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

 <div id="scroll">
    <div id="navigation" class="clearfix">


        <div style='margin-right: 0%!important;clear: both;float:right;'><?php echo $this->pagination->create_links(); ?></div>
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
                    <div onclick="abc('<?= site_url() ?>/user/user/detail/<?= $val->id ?>/<?php
        if (isset($board_name)) {
            echo $board_name;
        } else {
            echo "home";
        }
            ?>/<?php if ($fb_val == 'fb') {
                echo 'fb';
            } else {
                echo "";
            } ?>')" id="lpouter" class="<?php
                         if ($loop % 2)
                             echo 'odd';
                         else
                             echo'even';
                         ?> job_head_custom test"> 
                            <?php if ($fb_val == 'fb') { ?>
                            <div class="size_div" style="float:left;width:60%"> <!--start-->
                                    <?php
                                } else {
                                    ?>
                                <div class="size_div" style="float:left;width:74%"> <!--start-->
                                <?php } ?>

                                <?php
                                 if(isset($template))
                                            {
                                                if($template != "")
                                                {
                                ?>

                                <p class="usericon"><span class="sp_font"><b>
                                            <?php
                                            if (isset($post['salary'][$loop])):
                                            foreach ($post['salary'][$loop] as $val1) :
                                            ?>
                                            $<?= number_format($val1->val) ?>
                                            <?php
                                            endforeach;
                                            endif;
                                            ?>
                                        </b></span></p>
      
                                        
                                        <div class="calendericon">
                                             <?php if (isset($post['taxonomy'][$loop])) : foreach ($post['taxonomy'][$loop] as $value) : ?>
                                            <?php if(strtoupper($value->name) == 'BEDROOM' || strtoupper($value->name) == 'BEDROOMS' || strtoupper($value->name) == 'BED ROOM'||strtoupper($value->name) == 'BED ROOMS'){ ?>
                                            <span class="bedroom"><span class="taxo_data"><?php echo html_entity_decode($value->value);?></span></span>
                                             <?php
                                             } if(strtoupper($value->name) == 'BATHROOM' || strtoupper($value->name) == 'BATHROOMS' || strtoupper($value->name) == 'BATH ROOM'||strtoupper($value->name) == 'BATH ROOMS'){
                                             ?>
                                            <span class="bathroom"><span class="taxo_data"><?php echo html_entity_decode($value->value);?></span></span>
                                            <?php
                                             } if(strtoupper($value->name) == 'CAR PARKING SPACES' || strtoupper($value->name) == 'CARPARKINGSPACES' || strtoupper($value->name) == 'CAR PARKING'||strtoupper($value->name) == 'CAR PARKINGS'|| strtoupper($value->name) == 'CARPARKING'||strtoupper($value->name) == 'CARPARKINGS'){
                                             ?>
                                            <span class="car_parking"><span class="taxo_data"><?php echo html_entity_decode($value->value);?></span></span>
                                            <?php
                                            } if(preg_match('/TOTAL SIZE/',strtoupper($value->name)) || preg_match('/TOTALSIZE/',strtoupper($value->name))){
                                            ?>
                                            <span class="internal_size"><span class="taxo_data"><?php echo html_entity_decode($value->value);?></span></span>
                                            <?php
                                            }
                                            endforeach;
                                        endif;
                                        ?>
                                        </div>

                                <div class="location">Location: <?php
                                    if (isset($post['child'][$loop])):
                                    foreach ($post['child'][$loop] as $val1) :
                                    if ($val1->parent_tag_id == $post['Location'][0]->id):
                                    ?>
                                    <a href="javascript:footer_refine(<?= $val1->id ?>)" rel="tag"><?= $val1->name ?></a>
                                    <?php
                                    endif;
                                    endforeach;
                                    endif;
                                    ?></div>  
                                        <?php
                                            }}
                                        ?>
                                <div class="title">

                                    <h2><a rel="bookmark" href="<?= site_url() ?>/user/user/detail/<?= $val->id ?>/<?php
                            if (isset($board_name)) {
                            echo $board_name;
                        } else {
                            echo "home";
                        }
                                ?>/<?php if ($fb_val == 'fb') {
                                    echo 'fb';
                                } else {
                                    echo "";
                                } ?>" title="Permanent Link to <?= $val->title; ?>"><?= $val->title; ?></a>


                                </h2>
                                <div id="outer">


                                    <div  class="tagicon" style=" text-align: justify; padding-right: 12px;"><?php
                                echo substr(strip_tags($val->body), '0', '140') . '...';
                                ?>    
                                    </div> 
                                </div>

                            </div>

                        </div> <!--end-->   
                        <div class="img_div" style="float:right; margin:5px;"> <!--start-->
                            <?php
                            if ($val->status != '0') {
                                if ($val->status != '') {
                                    if ($val->status != '1') {
                                        
                                         if(!isset($template))
                                            {
                                                if(!$template != "")
                                                {
                                        
                                        ?>
                                        <img class="imgdiv_status" src="<?php echo base_url() . $val->status; ?>" alt="" height="50" width="50">
                                        <?php
                                            }}
                                    }
                                }
                            }
                            ?>

                            <img id="newabc" src="<?php
                            if ($val->image != "")
                                echo base_url() . '/' . $val->image;
                            else
                                echo base_url() . '/assets/css/user/itemimage/default.png';
                            ?>" alt="admin" height="100" width="100">  

                        </div> <!--end-->

                    </div> <!--endl pouter-->

                    <!--Start Jobs_Home-->

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
        <div id="navigation" class="clearfix">


            <div style='margin-right: 0%!important;clear: both;float:right;'><?php echo $this->pagination->create_links(); ?></div>
            <!--</div>-->
            <input type="hidden" value="<?= $pageno; ?>" id="pageno" name="pageno">
            <input type="hidden" value="<?= site_url(); ?>" id="t" name="t">

        </div>
        <input type="hidden" name ="b_name" id="board_name" value="<?php
    if (isset($board_name)) {
        echo $board_name;
    } else {
        echo "home";
    }
    ?>">


        <input type="hidden" value="<?php
    if (isset($total_row)) {
        echo $total_row;
    } else {
        echo "0";
    }
    ?>">
    </div>
</div>
    <script>

                            sessionStorage.setItem('fun_name', 'temp');

                            function abc(link) {
                                window.location = link;
                            }
                            ;


                            $('#navigation a').click(function() {

                                var id = $(this).text();
                                var pageno = $('#pageno').val();

                                $('#pageno').val(id);

                            });

    </script>
    <style>
        .imgdiv_status {
            left: 103px;
            position: relative;
            top: -50px;
            z-index: 11;
        }
    </style>