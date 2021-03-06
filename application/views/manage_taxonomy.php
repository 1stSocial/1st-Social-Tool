<script type="text/javascript" src="<?= base_url(); ?>assets/js/custom/manage_taxonomy.js"></script>
<?php
if (isset($option))
    switch ($option) {
        case 'addtaxonomy': { 
                echo "<script>
                        $(document).ready(function() {   
                        setTimeout(function(){
                            $('#mod1').click();
                           },100);
                        });</script>";
            }
            break;

        default:
            break;
    }
?>
<table id="tab_id" class="table table-striped ">
    <thead>
        <tr>
            <th>Taxonomy Name</th>
            <th>Type</th>
            <th>Parent Tag</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if (is_array($taxonomy) && !empty($taxonomy)):
            foreach ($taxonomy as $val):
                ?>
                <tr>
                    <td><?= $val->name ?></td>
                    <td><?= $val->type ?></td>
                    <td><?= $val->parenttag ?></td>

                    <td><div class="btn-group"><a onclick="edit(<?= $val->id ?>)" class="btn btn-primary fui-new"><i class="icon-edit icon-white"></i> Edit</a>
                            <a href="javascript:deletbox('<?php echo site_url('taxonomy/delete_taxonomy/' . $val->id) ?>')" class="btn btn-danger fui-trash"><i class="icon-trash icon-white"></i> Delete</a> </div></td>
                </tr>
                <?php
            endforeach;
        endif;
        ?>
    </tbody>
</table>
<div id="edit" style="position: absolute;left:-500px;top:-1000px;"></div>

<a href="#myModal1" role="button" id="mod1" style="display: none" class="btn" data-toggle="modal"></a>

<div id="myModal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <?php echo form_open_multipart(site_url("/admin/home/logo_image/")); ?>
    <div class="modal-dialog">
           <div id="load" class="loader"></div>
        <div id="fad">
        <div class="modal-content"> 
    <div class="modal-header">
        <h3 style="margin-left:33%;">Create Taxonomy</h3>
        <p> <? if (isset($success)) echo $success; ?> </p>
    </div>
    <div id="con" class="modal-body div_wrapper"><!-- Password input-->
        <div class="control-group" >
            <?php echo form_label('Name:', 'name', array("class"=>"control-label label label-info", 'style' => " float: left;padding: 0.6em 0.7em 0.7em;margin-right: 5%;margin-top: 0.52%")); ?> 
            <div class="controls" style="float:left;">
                <input  type="text" class="form-control" style="margin-left: 55px;width: 92%"  class = "control-label" placeholder="Taxonomy Name" id="name" name="name" />
            </div><div style =" color: red; display: none;padding-left:43%;clear: both;" id="taxoname"> Enter Taxonomy Name </div>
        </div> 
        <div id="error" style ="color:red; display: none; ">Enter Taxonomy Name</div> 
        <div style="clear: both;margin: 9%"></div>
        <div class="control-group">
            <?php echo form_label('Type:', 'type', array("class"=>"control-label label label-info", 'style' => "float: left;padding: 0.6em 0.7em 0.7em;margin-right: 4%;margin-top: 0.52%")); ?>
            <div class="controls">
                <select data-placeholder="Choose a Type..." class="chosen-select"  style="width:350px;" tabindex="4" id="type" name="type" style="margin-left: 60px;">
                    <option value="select">Select</option>
                    <option value="string">String</option>
                    <option value="Integer">Integer</option>
                    <option value="html">html</option>
                    <option value="Status">Status</option>
                </select><div style =" color: red; display: none;padding-left:43%" id="type_error"> Select Taxonomy Type </div>
            </div>
        </div>
        <div style="clear: both;margin: 8px"></div>
         
        <div class="control-group">
            <?php echo form_label('Parent Tag:', 'parent_tag',  array("class"=>"control-label label label-info", 'style' => "float: left;padding: 0.6em 0.7em 0.7em;margin-right: 8.7%;margin-top: 0.52%")); ?>
            <div style="margin-left: 100px">
                <select multiple="" data-placeholder="Choose a Type..." class="chosen-select"  style="width:350px;" tabindex="4" id="parentTag" name="parentTag">
                    <option value="0">Select</option>
                    <? if (!empty($parenTag)): foreach ($parenTag as $key => $Tag): ?>
                            <option value="<?= $key ?>"><?= $Tag ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </div><div style =" color: red; display: none;padding-left:43%" id="tag_error"> Select Parent Tag </div>
        </div>    
        
        <div style="clear: both;margin: 2%"></div>
        <div class="control-group" id="link" style="display: none">
            <?php echo form_label('Status Image:', 'value', array("class"=>"control-label label label-info", 'style' => " float: left;padding: 0.6em 0.7em 0.7em;margin-right: 5%;margin-top: 0.52%")); ?> 
<!--            <div class="controls" style="float:left;">
                <input  type="text" class="form-control" style="margin-left: 60px;width: 92%"  class = "control-label" placeholder="Link" id="link_val" name="link_val" />
            </div><div style =" color: red; display: none;padding-left:43%;clear: both;" id="linkname"> Enter Link </div>-->
            <div>
                     <div style="margin-left: 26%" class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 50px; height: 50px;"><img id="imgsrc" src="" /></div>
                                <div id="imgdiv" class="fileupload-preview fileupload-exists thumbnail" style="width: 50px; height: 50px;"></div>
                                <span class="btn btn-file" style="margin-left: 0%!important;"><span id="btn select_btn" class="fileupload-new" style="margin-left: 0%!important;">Select image</span><span class="fileupload-exists">Change</span><input id="img" name="img" type="file" accept="image/jpg,image/jpeg,image/png,image/gif,image/bmp,image/tiff" onchange =""/></span>
                                <a style="margin-left: 0%!important;" href="#" class="btn fileupload-exists" id="clo" data-dismiss="fileupload">Remove</a>
                            </div><div id="img_msg" name="img_msg" style = "display:none">Warning : Please Select jpg image.</div>
                        </div>

            </div> 
        
        <div style="clear: both;margin: 8%"></div>
    </div>            
    <div class="modal-footer ">      
        <div class="control-group"> 
            <div class="controls">
                <input type="submit" style="float: left; margin-left:170px; " name="save" class="btn btn-primary footer_btn" value="Create Taxonomy"  />
                <input type="button" id="close" style="float: left;" class="btn btn-primary footer_btn  " data-dismiss="modal" aria-hidden="true" value="Close" onclick="c()">      
            </div>
        </div> 
    </div><?php echo form_close(); ?>
<script>
    $('#type').change(function(){
      
        if(this.value == "Status")
            {
                $('#link').show();
            }
        else
            {
                $('#link').hide();
            }
    })
</script>
</div>
</div>
    </div></div>
