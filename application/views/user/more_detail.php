<script>
    
   $(document).ready(function() 
    {
       switch(sessionStorage.getItem('fun_name'))
       {
           
           case 'refine':
               {
                     var val = sessionStorage.getItem('abc');
       
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

                        <span class="user">Posted by <a href="" title="Posts by admin" rel="author"><?php echo $val->user_name; ?></a></span>  

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
                    
                    <div >
                        <input id="back2" type="button" style="margin-left: 50%;margin-top: 5%" class="btn " value="Back" onclick="" />   </div>  
                </div>
            </div>
        </div>
        <?php $loop++;
    endforeach;
endif;
?>
