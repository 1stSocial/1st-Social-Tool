<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/edit_user.js"></script>
<?php echo form_open('admin/new_user/edit_user', array('name' => 'myform','id'=>'myform')); 
// var_dump($domain);
?>

<a href="#myModal" style="display: none" role="button" id="mod1"  class="btn" data-toggle="modal" value="add"></a>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Edit <?=$val['0']['access_level'];?></h3>
    </div>

    <div class="modal-body div_wrapper" style="height: 200px">
        <div style="height: 15px;clear: both"></div>
        <div class="control-group">
            <?php echo form_label('Name :', 'nametag', array('class' => "control-label", 'style' => "float:left;padding-right:69px")); ?>
            <div class="controls">
                <input type="text" style="float: left" id="name" placeholder="Name" name="name" value='<?=$val['0']['name'];?>' title="Please Enter Name" required="Please Enter Name">
                <input type="hidden" name="parent_user_id" value="<?=$parent_user_id?>" id="parent_user_id">
                <input type="hidden" name="id" value="<?=$val['0']['id']?>" id="id">
                 <input type="hidden" id ="default" value="<?=$val['0']['username']?>">
                <input type="hidden" name="type" value="" id="type">
            </div>
        </div>
        <div style="clear: both"></div>
         <div class="control-group">
            <?php echo form_label('Username :', 'username', array('class' => "control-label", 'style' => "float:left;padding-right:41px")); ?>
            <div class="controls">
                <input type="text" style="float: left" id="username" value='<?=$val['0']['username'];?>' placeholder="User Name" name="username" required="Please Enter Username" onabort="check()">
                <div style =" color: red; display: none;" id="usererror"></div>
            </div>
        </div>
        <div style="clear: both"></div>
           <div class="control-group">
            <?php echo form_label('Password :', 'pass', array('class' => "control-label", 'style' => "float:left;padding-right:43px")); ?>
            <div class="controls">
                <input type="password" style="float: left" id="inputPassword"  placeholder="******" name="password">
                <div style =" color: red; display: none;" id="usererror"></div>
            </div>
        </div>
        
<!--        <div class="control-group">    
            <?php echo form_label('access_level :', 'level', array('class' => "control-label", 'style' => "clear:both;float:left;padding-right:24px")); ?>
            <div class="controls" style="float: left">
                <select data-placeholder="Choose a access_level..." class="chosen-select" style="width:350px;" tabindex="4" id="access_level" name="access_level" onselect="call()" required="*">
                   <?php // if($val['0']['access_level'] == 'partner')
//                    { ?>
                    <option value="partner" selected>Partner</option>
                    <?php 
//                    }
//                    else
//                    {
                        ?>
                         <option value="partner">Partner</option>
                            <?php
//                    }
//                    if($val['0']['access_level'] == 'client')
//                    {
                            ?>
                         
                    <option value="client" selected>Client</option>
                    <?php
//                    }
//                    else
//                    {
                        ?>
                         <option value="client">Client</option>
                            <?php
//                    } 
                    ?>
                </select>
            </div><div style =" color: red; display: none;" id="perror"> Select access level </div>-->
        <!--</div><div style="height: 15px;clear: both"></div>-->
    
        <?php 
        if($val['0']['access_level'] == 'partner')
        {
        if(isset($session['access_level']) &&  $session['access_level']=='admin')
        {
            ?>
        <div class="control-group" >    
            <?php echo form_label('Select Domain :', 'level', array('class' => "control-label", 'style' => "clear:both;float:left;padding-right:13px")); ?>
            <div class="controls" style="float: left">
                <select data-placeholder="Choose a domain..." class="chosen-select" style="width:350px;" tabindex="4" id="domain" name="domain_id" onselect="" required="please">
                    <option></option>
                    
                    <?php
                    if(is_array($domain) && !is_null($domain))
                    {
                        foreach ($domain as $val1)
                        {
                            ?>
                    <option value="<?=$val1->id?>" <?php if($val1->id == $val['0']['domain_id']) echo "selected" ;?>><?=$val1->name?></option>
                    <?php 
                        }
                    }
                    ?>
                </select>
            </div><div style =" color: red; display: none;" id="perror"> Select access level </div>
        </div><div style="height: 15px;clear: both"></div>
        <?php
        }
        }
        if($val['0']['access_level'] == 'client')
        {?>
            <input type="hidden" value="<?php echo $val['0']['domain_id'];?>" id="domain_new" name="domain_id">
            <div id="partner_div"  class="control-group">    
            <?php echo form_label('Select Partner :', 'level', array('class' => "control-label", 'style' => "clear:both;float:left;padding-right:13px")); ?>
            <div class="controls" style="float: left;">
                <select data-placeholder="Choose a partner..." class="chosen-select" name="parent_user_id" style="width:350px;" tabindex="4" id="parent_user" onchange="change_partner()">
                    <option></option>
                   
                    <?php
                    if(is_array($partner) && !is_null($partner))
                    {
                        foreach ($partner as $val1)
                        {
                            ?>
                    <option value="<?php echo $val1->id;?>" <?php if($val1->id == $val['0']['parent_user_id']) echo 'selected';passs?>><?=$val1->name?></option>
                    <?php 
                        }
                    }
                    ?>
                </select>
            </div><div style =" color: red; display: none;" id="perror"> Select access level </div>
        </div><div style="height: 15px;clear: both"></div>
            
        <?php
        
        }
        ?>
        
        
    </div>
    <div class="modal-footer">
        <div class="control-group">  
            <div class="div_wrapper" style="padding-left: 33%">

                <input type="submit" id="updatebtn" class="btn btn-primary footer_btn" value="Update User">
                <input type="button" id="closebtn" class="close btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close">
            </div>
        </div>
    </div>
    <input type="hidden" value="<?=  site_url();?>" id="url">
</div>