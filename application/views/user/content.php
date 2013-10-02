<div id="left">
    <div id="latestjob"><li class="botwid widget_text">			
               <div class="textwidget"><? if(isset($title) && $title !="") echo strtoupper($title); else {if (isset($board_name)) {
    echo strtoupper($board_name);
} else {
    echo "HOME";
               }}?></div>
        </li></div>

    <div id="navigation1" class="clearfix" >
        <div style='margin-left: 80%'><?php echo $this->pagination->create_links();?></div>
    </div>

    <?php $loop = 0; if(is_array($post) && isset($post['item']) ):foreach ($post['item'] as $val): ?>
        <div class="post" id="post-<?php echo $val->id; ?>">
            <div class="title">
                <input type="hidden" value='<?=$pagename;?>' id="pagename" name="pagename">
                <h2><a href="<?=site_url()?>/user/user/detail/<?=$val->id ;?>/<?php if(isset($board_name)) { echo $board_name;}else{echo "home";} ?>" class="title_link" rel="" title="Permanent Link to <?= $val->name; ?>"><?= $val->name; ?></a></h2>
                <div class="postmeta"> 	
                    <span class="user">Posted by <a href="" title="Posts by " rel="author"><?php echo $val->user_name; ?></a></span>  
                    <span class="clock"><?php $dt = human_to_unix($val->createdTime); $formate="%l,%d %M %Y"; echo mdate($formate,$dt); ?></span>  
                    
                    <?php if(isset($post['salary'][$loop][0]->val)) :?>
                                <span class="tags sallery_tag"><?=$post['salary'][$loop][0]->val;?></span>
                                <?php endif;?>
                                <?php if(isset($post['parent'][$loop])) : foreach ($post['parent'][$loop] as $value) : ?>
                                <span class="tags">
                                    <?php if(isset($post['child'][$loop])):
                                        foreach($post['child'][$loop] as $val1) :
                                            if($val1->parent_tag_id == $value->parent_tag_id):
                                        ?>
                                    <a href="javascript:footer_refine(<?=$val1->tag_id?>)" rel="tag"><?=$val1->name?></a>
                                    <?php endif; endforeach; endif;?>
                                </span>
                                <?php endforeach; endif;?>
                
                </div>
            </div>
            <div class="entry">

                <p><?=$val->title;?></p>
                
                
                <p><?php echo $val->body ?></p>
                <!--<a class="readmore" href="<?//=site_url()?>/user/user/detail/<?//=$val->id ;?>/<?php //  if(isset($board_name)) { echo $board_name;}else{echo "home";} ?>">Read More </a>-->
                <div class="clear"></div>
            </div>
        </div>
    <?php $loop++; endforeach;endif; ?>
    <div class="clear"></div>
      <input type="hidden" name ="b_name" id="board_name" value="<?php if(isset($board_name)) { echo $board_name;}else{echo "home";} ?>">
</div>
<script type="text/javascript" src="<?=  base_url();?>assets/js/user/custom/custom.js"></script>
<script>
//  
//$('#navigation1 a').click(function() {
//
//        var id = $(this).text();
//        var pageno = $('#pageno').val();
//
//        $('#pageno').val(id);
//        
//    });
//
//    $(document).ready()
//    {
//        var str = $('#navigation1 strong').html();
//        var value = $('#t').val();
//        var b_name = $('#board_name').val();
//        
//        
//        
//        if (b_name == 'home')
//        {
//            $('#navigation1').html($('#navigation1').html().replace('<strong>' + str + '</strong>', '<a href=' + str + '>' + str + '</a>'));
//
//            $('#navigation1').html($('#navigation1').html().replace('<a href='+ $('#pageno').val() +'>' + $('#pageno').val() + '</a>', '<strong>' + $('#pageno').val() + '</strong>'));
//            
//            
//        }
//        else
//        {
//            $('#navigation1').html($('#navigation1').html().replace('<strong>' + str + '</strong>', '<a href=' + str + '>' + str + '</a>'));
//
//            $('#navigation1').html($('#navigation1').html().replace('<a href=' + $('#pageno').val() +'>' + $('#pageno').val() + '</a>', '<strong>' + $('#pageno').val() + '</strong>'));
//        }
//    }
    </script>