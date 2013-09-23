<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/add_user.js"></script>
<?php echo form_open('admin/new_user/create_user', array('name' => 'myform','id'=>'myform')); ?>

<a href="#myModal" style="display: none" role="button" id="mod1"  class="btn" data-toggle="modal" value="add"></a>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <h3 id="myModalLabel">Create User</h3>
    </div>

    <div class="modal-body div_wrapper" style="height: 250px">
        <div class="control-group">
            <?php echo form_label('Name :', 'nametag', array('class' => "control-label", 'style' => "float:left;padding-right:69px")); ?>
            <div class="controls">
                <input type="text" style="float: left" id="name" placeholder="Name" name="name" title="Please Enter Name" required="Please Enter Name">
                <input type="hidden" name="parent_user_id" value="<?=$parent_user_id?>" id="parent_user_id" required="">
                <input type="hidden" name="type" value="" id="type">
                <input type="hidden" id="old_par" value="<?=$parent_user_id?>" id="type">
                <input type="hidden" name="domain_id" value="" id="domain_id">
            </div>
        </div>
        <div style="clear: both"></div>
         <div class="control-group">
            <?php echo form_label('Username :', 'username', array('class' => "control-label", 'style' => "float:left;padding-right:41px")); ?>
            <div class="controls">
                <input type="text" style="float: left" id="username" placeholder="User Name" name="username" required="Please Enter Username" onabort="check()">
                <div style =" color: red; display: none;" id="usererror"></div>
            </div>
        </div>
        <div style="clear: both"></div>
           <div class="control-group">
            <?php echo form_label('Password :', 'pass', array('class' => "control-label", 'style' => "float:left;padding-right:43px")); ?>
            <div class="controls">
                <input type="password" style="float: left" id="inputPassword" placeholder="******" name="password" required="password" >
                <div style =" color: red; display: none;" id="usererror"></div>
            </div>
        </div>
        
        <div class="control-group">    
            <?php echo form_label('access_level :', 'level', array('class' => "control-label", 'style' => "clear:both;float:left;padding-right:24px")); ?>
            <div class="controls" style="float: left">
                <select data-placeholder="Choose a access_level..." class="chosen-select" style="width:350px;" tabindex="4" id="access_level" name="access_level" onchange="call()" required="*">
                  <?php if(isset($session['access_level']) &&  $session['access_level']=='admin') {?>
                    <option value="partner">Partner</option>
                  <?php }?> 
                    <option value="client">client</option>
                </select>
            </div><div style =" color: red; display: none;" id="perror"> Select access level </div>
        </div><div style="height: 15px;clear: both"></div>
    
        <?php if(isset($session['access_level']) &&  $session['access_level']=='admin')
        {
            ?>
        <div id="domain_div" class="control-group" >    
            <?php echo form_label('Select Domain :', 'level', array('class' => "control-label", 'style' => "clear:both;float:left;padding-right:13px")); ?>
            <div  class="controls" style="float: left">
                <select data-placeholder="Choose a domain..." class="chosen-select" style="width:350px;" tabindex="4" id="domain" onchange="domain_new()">
                    <option></option>
                   
                    <?php
                    if(is_array($domain) && !is_null($domain))
                    {
                        foreach ($domain as $val)
                        {
                            ?>
                    <option value="<?=$val->id?>"><?=$val->name?></option>
                    <?php 
                        }
                    }
                    ?>
                </select>
                <div style =" color: red; display: none;" id="perror"> Select access level </div>
        </div><div style="height: 15px;clear: both"></div>
            </div>
        <?php
        }else{?>
            <input type="hidden" value="<?php echo $domain;?>" id="domain" name="domain_id">
        <?}?>
        
            <div id="partner_div" style="display: none" class="control-group">    
            <?php echo form_label('Select Partner :', 'level', array('class' => "control-label", 'style' => "clear:both;float:left;padding-right:13px")); ?>
            <div class="controls" style="float: left;">
                <select data-placeholder="Choose a partner..." class="chosen-select" style="width:350px;" tabindex="4" id="parent_user" onchange="change_partner()">
                    <option></option>
                   
                    <?php
                    if(is_array($partner) && !is_null($partner))
                    {
                        foreach ($partner as $val1)
                        {
                            ?>
                    <option value="<?=$val1->id?>"><?=$val1->name?></option>
                    <?php 
                        }
                    }
                    ?>
                </select>
            </div><div style =" color: red; display: none;" id="perror"> Select access level </div>
        </div><div style="height: 15px;clear: both"></div>
        
        
        
    </div>
    <div class="modal-footer">
        <div class="control-group">  
            <div class="div_wrapper" style="padding-left: 33%">

                <input type="submit" id="updatebtn" class="btn btn-primary footer_btn" value="Create User">
                <input type="button" id="closebtn" class="close btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close">
            </div>
        </div>
    </div>
    <input type="hidden" value="<?=  site_url();?>" id="url">
    
</div>
<div id="create_dom" >
 
    </div>