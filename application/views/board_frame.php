<div class="row-fluid table-container">
	<?= $board_table_html; ?>
</div>

<div class="modal hide fade html-modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" style="color:white;" aria-hidden="true">&times;</button>
    <h3>Edit Board: <span></span></h3>
  </div>
  <div class="modal-body">
<ul class="nav nav-tabs">
	<li class="active"><a href="#edit" data-toggle="tab"><i class="icon-edit"></i> Board Settings</a></li>
  	<li><a href="#html" data-toggle="tab"><i class="icon-eye-open"></i> Board HTML</a></li>
  	<li><a href="#css" data-toggle="tab"><i class="icon-eye-open"></i> Board CSS</a></li>
  	<li><a href="#preview" class="save-board-html" data-toggle="tab"><i class="icon-eye-open"></i> Board Preview</a></li>

</ul>
<div class="tab-content">
	<div class="tab-pane active" id="edit">

		<label >Board Name:</label>
		<span class="html-modal-name span12" placeholder="Type board name..."></span>

		<label for="board-url">Board URL:</label>
		<input type="text" name="board-url" class="span12 html-modal-url" placeholder="Type board URL...">

		<label for="board-fb-id">Facebook application ID (optional): </label>
		<input type="text" name="board-fb-id" class="span6 html-modal-fb-id" placeholder="Type Facebook application ID...">

	</div>
	<div class="tab-pane" id="html">
			<textarea class="span12 modal-html" placeholder="Enter your HTML code here..."></textarea>
	</div>
	<div class="tab-pane" id="css">
		    <input class="fileupload" type="file" name="files[]" data-url="upload_controller/upload_image/" multiple>
			<textarea class="span12 modal-css" placeholder="Enter your CSS code here..."></textarea>
	</div>
	<div class="tab-pane" id="preview">
		<div class="alert text-center text-info">RSS contents will not appear until you "Save and Preview" the board.</div>
  		<div class="preview-box"></div>
  	</div>
</div>
</div>
	<div class="modal-footer">
		<a href="#" class="btn save-board" data-loading-text="Saving..."><i class="icon-file"></i> Save</a>
		<a href="#" class="btn" data-dismiss="modal" ><i class="icon-remove"></i> Cancel</a>
	</div>
</div>

<div class="modal hide fade create-board-modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" style="color:white;" aria-hidden="true">&times;</button>
    <h3>Create new board</h3>
  </div>
  <div class="modal-body">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#create_settings" data-toggle="tab"><i class="icon-wrench"></i> Board Settings</a></li>
	  	<li><a href="#create_html" data-toggle="tab"><i class="icon-eye-open"></i> Board HTML</a></li>
	  	<li><a href="#create_css" data-toggle="tab"><i class="icon-eye-open"></i> Board CSS</a></li>
  		<li><a href="#create_preview" class="save-board-html" data-toggle="tab"><i class="icon-eye-open"></i> Board Preview</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="create_settings">

		    <label for="board-name">Board Name:</label>
		    <input type="text" name="board-name" class="span6 create-modal-name" placeholder="Type board name...">
		    <span class="help-block">The name of your board.</span>
		    
		    <label for="board-url">Board URL:</label>
		    <input type="text" name="board-url" class="span12 create-modal-url" placeholder="Type board URL...">
		    <span class="help-block">The URL of your board.</span>
		    
		    <label for="board-fb-id">Facebook application ID (optional): </label>
		    <input type="text" name="board-fb-id" class="span6 create-modal-fb-id" placeholder="Type Facebook application ID...">
		    <span class="help-block">The Facebook application the board will link to.</span>
		</div>

		<div class="tab-pane" id="create_html">
			<textarea class="span12" placeholder="Enter your HTML code here..."></textarea>
		</div>

		<div class="tab-pane" id="create_css">
		    <input class="fileupload" type="file" name="files[]" data-url="upload_controller/upload_image/" multiple>
    		<textarea class="span12" placeholder="Enter your CSS code here..."></textarea>
		</div>
		
		<div class="tab-pane" id="create_preview">
			<div class="alert text-center text-info">RSS contents will not appear until you Save and "Preview" the board.</div>
			<div class="preview-box"></div>
  		</div>
	</div>
</div>
	<div class="modal-footer">
		<a href="#" class="btn create-board" data-loading-text="Creating board..."><i class="icon-plus"></i> Create Board</a>
		<a href="#" class="btn" data-dismiss="modal" ><i class="icon-remove"></i> Cancel</a>
	</div>
</div>