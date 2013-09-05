<?php
$str =array();
if(is_array($val))
{
foreach ($val as $a)
{
    $str[$a['key']]=$a['value'];
}
}
?>

<?php  echo form_open('admin/setting/theme_update','class="horizontal-form"');  ?>
<input type="hidden" value="<?php if(isset($id)) echo $id;?>" id='id' name='id'> 
<div class="col-md-3">
<div class="bs-sidebar hidden-print affix" style="margin-left: 40px; width: 20%;background: transparent;float: left; font-size: 20px">
    
          <ul class="nav bs-sidenav">
              <li class=""><a href="#variables-body">Body</a></li>
              <li class=""><a href="#variables-head">Head</a></li>
              <li class=""><a href="#variables-theme">Theme</a></li>
              <li class=""><a href="#variables-blog">Blog</a></li>
              <li class=""><a href="#variables-menu">Menu</a></li>
              <li class=""><a href="#variables-search">Search</a></li>
              <li class=""><a href="#variables-latest">Latest Job Div</a></li>
              <li class=""><a href="#variables-a_tag">Anchor Tag</a></li>
              <li class=""><a href="#variables-title">Title</a></li>
              <li class=""><a href="#variables-priceslider">Price Slider</a></li>
              <li class=""><a href="#variables-bottom">Bottom</a></li>
              
          </ul>
    
    <input type="submit" id="save" name="btn" value="Update" class='btn btn-primary'/>
    
</div>
<div id="data" style="margin-left: 30%; width: 60%;background: transparent;float: left;">
    <div id="variables-body">
        <div class="control-group">
            <div class="controls">
            <h2>Theme Name</h2>
                <?php echo form_label('Theme Name :', 'font_size', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                    <input type="text" style="width: 100%" class = "control-label" placeholder="Theme Name" value="<?php if(isset($name)) echo $name;?>" name="themename" >
                    <?php echo validation_errors(); ?>
                </div>
            </div>
        
        </div>
    </div>    
    <div id="variables-body">
        <div class="control-group">
            <div class="controls">
            <h2>Body</h2>
                <?php echo form_label('@body_font_size :', 'font_size', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                    <input type="text" style="width: 100%" class = "control-label" value="<?php if(isset($str['body_font_size'])) { echo $str['body_font_size'];}?>" placeholder="@body_font_size" id="body_font_size" name="body_font_size" ></div>
                
                <?php echo form_label('@background_color :', 'bg_color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@background_color" id="background_color" value="<?php if(isset($str['background_color'])) { echo $str['background_color'];}?>" name="background_color" ></div>
                
                <?php echo form_label('@body_font_family :', 'font_family', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@body_font_family" id="body_font_family" value="<?php if(isset($str['body_font_family'])) { echo $str['body_font_family'];}?>" name="body_font_family" ></div>
                
                <?php echo form_label('@body_font_color :', 'font_color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@body_font_color" id="body_font_color" value="<?php if(isset($str['body_font_color'])) { echo $str['body_font_color'];}?>" name="body_font_color" ></div>
            </div>
        
        </div>
    </div>
    
    <div id="variables-head">
        <div class="control-group">
            <div class="controls">
            <h2>Head</h2>
                <?php echo form_label('@head_border_color :', 'font_family', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@head_border_color" id="head_border_color" value="<?php if(isset($str['head_border_color'])) { echo $str['head_border_color'];}?>" name="head_border_color" ></div>
            </div>
        
        </div>
    </div>
    
    
    <div id="variables-theme">
        <div class="control-group">
            <div class="controls">
            <h2>Theme-Color</h2>
                <?php echo form_label('@theme :', 'theme', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@theme_color" id="theme_color" value="<?php if(isset($str['bg'])) { echo $str['bg'];}?>" name="bg" ></div>
            </div>
        
        </div>
    </div>
    <div id="variables-blog">
        <div class="control-group">
            <div class="controls">
            <h2>Blog</h2>
                <?php echo form_label('@blog_bg_color :', 'bg_color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@blog_bg_color" id="blog_bg_color" value="<?php if(isset($str['blog_bg_color'])) { echo $str['blog_bg_color'];}?>" name="blog_bg_color" ></div>
                
                <?php echo form_label('@blog_name_color :', 'text_color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@blog_name_color" id="blog_name_color" value="<?php if(isset($str['blog_name_color'])) { echo $str['blog_name_color'];}?>" name="blog_name_color" ></div>
            </div>
        
        </div>
    </div>
    
     <div id="variables-menu">
        <div class="control-group">
            <div class="controls">
            <h2>Menu</h2>
                <?php echo form_label('@menu_bg_color :', 'bg_color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@menu_bg_color" id="menu_bg_color" value="<?php if(isset($str['menu_color'])) { echo $str['menu_color'];}?>" name="menu_color" ></div>
            </div>
        
        </div>
    </div>
    
    <div id="variables-search">
        <div class="control-group">
            <div class="controls">
            <h2>Search Box</h2>
                <?php echo form_label('@search_border :', 'border', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@border ex:- 1px solid black" id="search_border" value="<?php if(isset($str['border'])) { echo $str['border'];}?>" name="border" ></div>
            
                <?php echo form_label('@search_bg_color :', 'dg_color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@search_bg_color" id="search_bg_color" value="<?php if(isset($str['search_bg_color'])) { echo $str['search_bg_color'];}?>" name="search_bg_color" ></div>
                   
                <?php echo form_label('@searchbtn_color :', 'dg_color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@searchbtn_color" id="searchbtn_color" value="<?php if(isset($str['searchbtn_color'])) { echo $str['searchbtn_color'];}?>" name="searchbtn_color" ></div>
      
                
            </div>
        
        </div>
    </div>
    
    <div id="variables-latest">
        <div class="control-group">
            <div class="controls">
            <h2>Latest job div</h2>
                <?php echo form_label('@latestjob_font_size :', 'latestjob_size', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@latestjob_font_size" id="latestjob_font_size" value="<?php if(isset($str['latest_font_style'])) { echo $str['latest_font_style'];}?>" name="latest_font_style" ></div>
            
                <?php echo form_label('@latestjob_text_color :', 'text_color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@latestjob_text_color" id="latestjob_text_color" value="<?php if(isset($str['latestjob_text_color'])) { echo $str['latestjob_text_color'];}?>" name="latestjob_text_color" ></div>
                
            </div>
        
        </div>
    </div>
    
    <div id="Evenjobdiv">
        <div class="control-group">
            <div class="controls">
            <h2>Job div</h2>
                <?php echo form_label('@jobdiv_top_border :', 'top_border', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@jobdiv_top_border" id="jobdiv_top_border" value="<?php if(isset($str['jobdiv_top_border'])) { echo $str['jobdiv_top_border'];}?>" name="jobdiv_top_border" ></div>
            
                <?php echo form_label('@jobdiv_bottom_border :', 'bottom_border', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@jobdiv_bottom_border" id="jobdiv_bottom_border" value="<?php if(isset($str['jobdiv_bottom_border'])) { echo $str['jobdiv_bottom_border'];}?>" name="jobdiv_bottom_border" ></div>
                
                <?php echo form_label('@job_bg_color :', 'bg_color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@job_bg_color" id="job_bg_color" value="<?php if(isset($str['job_bg_color'])) { echo $str['job_bg_color'];}?>" name="job_bg_color" ></div>
                
                <?php echo form_label('@saperator_color :', 'color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@saperator_color" id="saperator_color" value="<?php if(isset($str['saperator_color'])) { echo $str['saperator_color'];}?>" name="saperator_color" ></div>
                
                <?php echo form_label('@date_color :', 'date', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@date_color" id="date_color" value="<?php if(isset($str['date_color'])) { echo $str['date_color'];}?>" name="date_color" ></div>
                
            </div>
        
        </div>
    </div>
    
    <div id="variables-a_tag">
        <div class="control-group">
            <div class="controls">
            <h2>Anchor Tag</h2>
                <?php echo form_label('@anchore_color :', 'color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@anchore_color" id="anchore_color" value="<?php if(isset($str['anchor_color'])) { echo $str['anchor_color'];}?>" name="anchor_color" ></div>
            
                <?php echo form_label('@anchore_size :', 'size', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@anchore_size" id="anchore_size" value="<?php if(isset($str['anchor_size'])) { echo $str['anchor_size'];}?>" name="anchor_size" ></div>
                
            </div>
        
        </div>
    </div>
    
    <div id="variables-title">
        <div class="control-group">
            <div class="controls">
            <h2>Title heading1,heading2</h2>
                <?php echo form_label('@title_color :', 'color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@title_color" id="title_color" value="<?php if(isset($str['title_color'])) { echo $str['title_color'];}?>" name="title_color" ></div>
            
            </div>
        
        </div>
    </div>
        
    
      <div id="variables-priceslider">
        <div class="control-group">
            <div class="controls">
            <h2>Price slider</h2>
                <?php echo form_label('@range_color :', 'color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@range_color" id="range_color" value="<?php if(isset($str['price_range_color'])) { echo $str['price_range_color'];}?>" name="price_range_color" ></div>
                    
                <?php echo form_label('@slider_color :', 'color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@slider_color" id="slider_color" value="<?php if(isset($str['slider_color'])) { echo $str['slider_color'];}?>" name="slider_color" ></div>
           
            </div>
        </div>
      </div>
    
        
        <div id="variables-bottom">
        <div class="control-group">
            <div class="controls">
            <h2>Bottom</h2>
                <?php echo form_label('@bottombg_color :', 'color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="bottombg_color" id="bottombg_color" value="<?php if(isset($str['bottombg_color'])) { echo $str['bottombg_color'];}?>" name="bottombg_color" ></div>
                    
                <?php echo form_label('@topborder_color :', 'color', array('class' => "control-label",'style'=>"width: 100%") ); ?><div style="clear: both;margin-top: 50px">
                <input type="text" style="width: 100%" class = "control-label" placeholder="@topborder_color" id="topborder_color" value="<?php if(isset($str['topborder_color'])) { echo $str['topborder_color'];}?>" name="topborder_color" ></div>
           </div>
        </div>
      </div>
</div>