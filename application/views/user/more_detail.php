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
<script>
    
   $(document).ready(function() 
    {
       switch(sessionStorage.getItem('fun_name'))
       {
           
           case 'refine':
               {
                  
                     var val = sessionStorage.getItem('abc');
                     alert(val);
                            $("input:checkbox:not(:checked)").each(function() {
                                if(val.search($(this).val()) != -1)
                               {
                                   $(this).attr('checked','checked');
                               }
                    //       alert($(this).val());
                           
                        }); $('#back').attr('onclick',sessionStorage.getItem('fun_call'));
                        $('#back2').attr('onclick',sessionStorage.getItem('fun_call'));
               }break;
           case 'footer':
               {
                   $('#back').attr('onclick',sessionStorage.getItem('fun_call'));
                   $('#back2').attr('onclick',sessionStorage.getItem('fun_call'));
               }break;
           case 'num_refine':
               {
                  
                    $('#min').val(sessionStorage.getItem('min_val'));
                    $('#max').val(sessionStorage.getItem('max_val'));
                    
                    $('#back').attr('onclick',sessionStorage.getItem('fun_call'));
                    $('#back2').attr('onclick',sessionStorage.getItem('fun_call'));
               }break;
          case 'temp':
               {
                    $('#back').attr('onclick','window.history.back()');
                    $('#back2').attr('onclick','window.history.back()');
               }break;
           
       }
    });
   
</script>
<?php
if(isset($fb) && $fb == 1)
{
?>
<input  type="hidden" value="fb" id='fb' name ='fb'>
<?php
}
?>
<div>
    <input id="back" type="button" style="margin-left: 5%" class="btn " value="Back" onclick="" />   </div> 
<div id="left">
    <?php $loop = 0;
    if (is_array($post) && isset($post['item'])):foreach ($post['item'] as $val): ?>       


            <div class="tuts" id="post-226"> 

                <div class="title">

                    <h1 style="padding-left:3%!important;"><?= $val->title; ?></h1>
                    
            </div>
                    <!--end date-->

                    <div class="postmeta" style="margin-left:3%;"> 	

                        <!--<span class="user">Posted by <a href="" title="Posts by admin" rel="author"><?php echo $val->user_name; ?></a></span>-->  

<!--                        <span class="clock"><?php
//                            $dt = human_to_unix($val->createdTime);
//                            $formate = "%l,%d %M %Y";
//                            echo mdate($formate, $dt);
                            ?></span>  -->

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

                
                <div class="entry" style="margin-left:0%">
                    <div style="text-align: justify">
                       
                    <div style="margin-top:20px">
                                        <?= $val->body ?>
                                    </div>
                        <div id="taxonomy" style="width: 49%;margin-left: 0%">
                                        <h3> About </h3>
                                            <?php if (isset($post['taxonomy'][$loop])) : foreach ($post['taxonomy'][$loop] as $value) : ?>
                                                <div id="<?= $value->item_id; ?>">
                                                    <div style="float:left;width:  60%"><?= $value->name." :" ?></div>  <span style=""><?php if(preg_match('/Price/',$value->name) == FALSE) echo html_entity_decode($value->value); else echo '$ '.number_format($value->value); ?></span>
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
                    
                    <div>
                        
                         <?php if($val->call_to_action != "")
                                {?>
                                <a href="<?=$val->call_to_action;?>" class="butun"><?php if($btn_name!="") echo $btn_name; else echo 'Click Me!'?></a>	
                                <?}?>
                        
                        <input id="back2" type="button" style="margin-left: 2%;margin-top: 10%" class="btn " value="Back" onclick="" />   </div>  
                </div>
            </div>
        </div>
        <?php $loop++;
    endforeach;
endif;
?>
