jQuery(document).ready(function(){
  setTimeout(function(){
       jQuery('#mod1').click();
   },100);
 });
 
jQuery('#body').redactor();

function change_val()
{
    var id  = jQuery('#boardval').val();
    var url = jQuery('#url').val();
    
    var dataval = {
        'id':id
    };
    $('#add').html("");
    jQuery.ajax({
       type: "POST",
       url:url+'/admin/Item/childtag',
       data:dataval,
       success:function(res){
           
                var value = "";
                var val2 ="";
        var obj = jQuery.parseJSON(res);
//        alert(obj['tag']['Parent']['0']['id']);
        $.each(obj['tag']['Parent'], function(i, data) {
//            alert(data['name']);
            value = "";
            value = "<div style='magrin-top:33px;padding-top:8px;'><label class='control-label' style='float: left;width:165px'>"+data['name']+":</label>"+
                    "<select data-placeholder='Choose...' class=chosen-select multiple  style='width:350px;' tabindex=2 id="+ data['id'] + " name=tag[]>"
                        +    "<option> </option>" ;
                         val2 = "";
                        $.each(obj['tag']['child'], function(i, val){
                          if (val['parent_tag_id'] == data['id']) {
                       val2 += "<option value="+val['id']+">"+ val['name'] +"</option>";
                        }});
                        val2 +="</select></div>";
                    $('#add').append(value+val2);
                    $(".chosen-select").chosen({width: "50%"});
                     }) ;
            
             
            
           },
       error:function(res)
       {
           alert(res);
       }
    });
}

//<?php if(is_array($Parent)): foreach ($Parent as $data):?>
//            <li class="sidebox widget_lc_taxonomy">
//                <div id="lct-widget-locations-container" class="list-custom-taxonomy-widget">
//                    <h3 class="sidetitl"><?=$data['name']?></h3>
//                    <ul id="lct-widget">
//                        <?php foreach ($child as $val): if($val['parent_tag_id'] == $data['id']) :  ?>
//                        <li class="cat-item">
//                            <a href="<?= site_url();?>/user/user/index/<?=$val['parent_tag_id']?>" title="View all posts filed under <?=$val['name'];?>"><?=$val['name']?></a>
//                        </li>
//                        <?php endif;endforeach;?>
//                    </ul>
//                </div>
//            </li>
//            <?  endforeach;endif;?>


//jQuery('#boardval').click(function(){
//   
////    var id  = jQuery('#board').val();
//    
//    alert('id');
//    
////    jQuery('#taxonomy').show(function(){
//        
////    });
//    
//});

