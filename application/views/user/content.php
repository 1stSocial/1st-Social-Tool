<style type="text/css">
    .butun{
        float: right;
       color:#fff;
       margin-right: 23px;
       text-align:center;
        border-radius:5px;
        padding:8px;
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
      <input type="hidden" name ="fb" id="fb" value="<?php
           if (isset($_SESSION['fb'])) {
               echo $_SESSION['fb'];
           } else {
               echo "";
           }
           ?>">
    <?php $loop = 0; if(is_array($post) && isset($post['item']) ):foreach ($post['item'] as $val): ?>

                  <div class="tuts"> 
                <div id="tt">
                    <div onclick="abc('<?= site_url() ?>/user/user/detail/<?= $val->id ?>/<?php
                                    if (isset($board_name)) {
                                        echo $board_name;
                                    } else {
                                        echo "home";
                                    }
                                    ?>/<?php if(isset($_SESSION['fb'])) { echo $_SESSION['fb'];} else{echo "";} ?>')" id="lpouter" class="<?php
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
                                    ?>/<?php if(isset($_SESSION['fb'])) { echo $_SESSION['fb'];} else{echo "";} ?>" title="Permanent Link to <?= $val->title; ?>"><?= $val->title; ?></a></h2>
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
                                    
                                <div style=" text-align: justify; padding-right: 12px;"><?php
                                        echo substr($val->body, '0','150').'...';
                                    ?>    
                                    </div> 
                                </div>

                            </div>
                           
                        </div> <!--end-->   
                        <div class="img_div" style="float:right; margin:5px;"> <!--start-->
                            <img src="<?php
                            if ($val->image != "")
                                echo base_url() . '/' . $val->image;
                            else
                                echo base_url() . '/assets/css/user/itemimage/default.png';
                            ?>" alt="admin" height="100" width="100">  

                        </div> <!--end-->
                            <div class="clear"></div>
                            <?php if($val->call_to_action != "")
                                {?>
                                <a href="<?=$val->call_to_action;?>" class="butun"><?php if($btn_name!="") echo $btn_name; else echo 'Click Me!'?></a>	
                                <?}?>
                    </div> <!--endl pouter-->

                    <!--Start Jobs_Home-->

                    <!--End Jobs_home-->
                    <div class="entry">

                      
                                <div style="margin: 1px;clear: both"></div>
 <input type="hidden" value='<?=$pagename;?>' id="pagename" name="pagename">
                    </div>
                </div>
            </div>
      
    <?php $loop++; endforeach;endif; ?>
    <div class="clear"></div>
      <input type="hidden" name ="b_name" id="board_name" value="<?php if(isset($board_name)) { echo $board_name;}else{echo "home";} ?>">
      <input type="hidden" name ="tag_id" id="tag_id" value="<?php if(isset($tag_id)) { echo $tag_id;}else{echo "";} ?>">
</div>
<script type="text/javascript" src="<?=  base_url();?>assets/js/user/custom/custom.js"></script>
<script>
   function abc(link) {
       sessionStorage.setItem( 'data',link );
//       <% Session["Test"] = "Welcome Mamu"; %>
        window.location = link;
       
//        session.setAttribute("abc",link);
    }


    $(document).ready()
    {
//       alert('abcx');
       $('#abc a').attr('href','javascript:temp()');
       
    };
</script>