<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/edit_user.js"></script>
<?php echo form_open('admin/new_user/edit_user', array('name' => 'myform','id'=>'myform')); 
// var_dump($domain);
?>

<a href="#myModal" style="display: none" role="button" id="mod1"  class="btn" data-toggle="modal" value="add"></a>

<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
         <div id="load" class="loader"></div>
        <div id="fad">   
        <div class="modal-content"> 
    <div class="modal-header">
        <h3 id="myModalLabel" style="margin-left: 35%">Edit <?=$val['0']['access_level'];?></h3>
    </div>

    <div class="modal-body div_wrapper" style="height: 200px">
        
        <div class="control-group">
           <?php echo form_label('Name :', 'nametag', array('class' => "control-label label label-infocontrol-label label label-info", 'style' => " float: left;padding: 0.6em 0.7em 0.7em;margin-right: 15%;margin-top: 0.52%;width:19.0%")); ?>
             <div class="controls">
                <input type="text" class="form-control" style="float: left;width: 45%" id="name" placeholder="Name" name="name" value='<?=$val['0']['name'];?>' title="Please Enter Name" required="Please Enter Name">
                <input type="hidden" name="parent_user_id" value="<?=$parent_user_id?>" id="parent_user_id">
                <input type="hidden" name="id" value="<?=$val['0']['id']?>" id="id">
                 <input type="hidden" id ="default" value="<?=$val['0']['username']?>">
                <input type="hidden" name="type" value="" id="type">
            </div>
        </div>
        <div style="clear: both;margin : 9%!important"></div>
         <div class="control-group">
           <?php echo form_label('Username :', 'username', array('class' => "control-label label label-infocontrol-label label label-info", 'style' => " float: left;padding: 0.6em 0.7em 0.7em;margin-right: 15%;margin-top: 0.52%;width:19.0%")); ?>
             <div class="controls">
                <input type="text" class="form-control" style="float: left;width: 45%" id="username" value='<?=$val['0']['username'];?>' placeholder="User Name" name="username" required="Please Enter Username" onabort="check()">
                <div style =" color: red; display: none;" id="usererror"></div>
            </div>
        </div>
         <div style="clear: both;margin: 18%!important"></div>
           <div class="control-group">
            <?php echo form_label('Password :', 'pass', array('class' => "control-label label label-infocontrol-label label label-info", 'style' => " float: left;padding: 0.6em 0.7em 0.7em;margin-right: 15%;margin-top: 0.52%;width:19.0%")); ?>
            <div class="controls">
                <input type="password" class="form-control" style="float: left;width: 45%" id="inputPassword"  placeholder="******" name="password">
                <div style =" color: red; display: none;" id="passerror"></div>
            </div>
        </div>
         <div style="clear: both;margin: 27%!important"></div>
<!--        <div class="control-group">    
            <?php // echo form_label('access_level :', 'level', array('class' => "control-label", 'style' => "clear:both;float:left;padding-right:24px")); ?>
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
           <?php echo form_label('Select Domain :', 'level', array('class' => "control-label label label-infocontrol-label label label-info", 'style' => " float: left;padding: 0.6em 0.7em 0.7em;margin-right: 15%;margin-top: 0.52%;width:19.0%")); ?>
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
         <?php echo form_label('Select Partner :', 'level', array('class' => "control-label label label-infocontrol-label label label-info", 'style' => " float: left;padding: 0.6em 0.7em 0.7em;margin-right: 15%;margin-top: 0.52%;width:19.0%")); ?>
               <div class="controls" style="float: left;">
                <select data-placeholder="Choose a partner..." name="parent_user_id" style="width:350px;" tabindex="4" id="parent_user" onchange="change_partner()">
                    <option></option>
                   
                    <?php
                    if(is_array($partner) && !is_null($partner))
                    {
                        foreach ($partner as $val1)
                        {
                            ?>
                    <option value="<?php echo $val1->id;?>" <?php if($val1->id == $val['0']['parent_user_id']) echo 'selected';?>><?=$val1->name?></option>
                    <?php 
                        }
                    }
                    ?>
                </select>
            </div><div style =" color: red; display: none;" id="perror"> Select access level </div>
        </div> <div style="clear: both;margin: 27%!important"></div>
            
        <?php
        
        }
        ?>
        
        
    </div>
    <div class="modal-footer">
        <div class="control-group">  
            <div class="div_wrapper" style="padding-left: 33%">

                <input type="submit" id="updatebtn" class="btn btn-primary footer_btn" value="Update User">
                <input type="button" id="closebtn" class="btn btn-primary footer_btn" data-dismiss="modal" aria-hidden="true" value="Close">
            </div>
        </div>
    </div></div>
    <input type="hidden" value="<?=  site_url();?>" id="url">
</div>
        </div>
    </div>