<div class="row-fluid table-container">
	<?= $board_table_html; ?>
</div>

<div class="modal hide fade html-modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" style="color:white;" aria-hidden="true">&times;</button>
    <h3>Edit Board Data: <span></span></h3>
  </div>
  <div class="modal-body">
<ul class="nav nav-tabs">
	<li class="active"><a href="#edit" data-toggle="tab"><i class="icon-edit"></i> Edit</a></li>
  	<li><a href="#preview" class="save-board-html" data-toggle="tab"><i class="icon-eye-open"></i> Preview</a></li>
</ul>
<div class="tab-content">
	<div class="tab-pane active" id="edit">
		<div class="pull-left span4">
			<label for="modal-name">Board Name:</label>
			<span name="modal-name"  class="html-modal-name span12"></span>
		</div>
		<div class="pull-left span8">
	  	<label for="modal-name">Board URL:</label>
	  	<input name="modal-url" type="text" class="html-modal-url span12" placeholder="Enter a board name" value=""/>
	</div>
	<br/>
		<label for="modal-name">Board HTML:</label>
		<textarea name="modal-html" class="span12 modal-html">
		</textarea>
	</div>
	<div class="tab-pane" id="preview">
  	</div>
</div>
</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" ><i class="icon-remove"></i> Close</a>
		<a href="#" class="btn save-board"><i class="icon-file"></i> Save</a>
	</div>
</div>

<div class="modal hide fade create-board-modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" style="color:white;" aria-hidden="true">&times;</button>
    <h3>Create new board</h3>
  </div>
  <div class="modal-body">
	<ul class="nav nav-tabs">
		<li class="active"><a href="#settings" data-toggle="tab"><i class="icon-pen"></i> Edit</a></li>
	  	<li><a href="#html" data-toggle="tab"><i class="icon-eye-open"></i> Preview</a></li>
	</ul>
	<div class="tab-content">
		<div class="tab-pane active" id="settings">
			<form>
			  <fieldset>
			    <legend>Board Details</legend>
			    <label for="board-name">Board Name:</label>
			    <input type="text" name="board-name" class="span6" placeholder="Type board name...">
			    <span class="help-block">The name of your board.</span>
			    
			    <label for="board-url">Board URL:</label>
			    <input type="text" name="board-url" class="span12" placeholder="Type board URL...">
			    <span class="help-block">The URL of your board.</span>
			    
			    <label for="board-fb-id">Facebook application ID (optional): </label>
			    <input type="text" name="board-fb-id" class="span6" placeholder="Type Facebook application ID...">
			    <span class="help-block">The Facebook application the board will link to.</span>

			  </fieldset>
			</form>
		</div>

		<div class="tab-pane" id="html">
			<textarea placeholder="Enter your html code here..."></textarea>
		</div>
	</div>
</div>
	<div class="modal-footer">
		<a href="#" class="btn" data-dismiss="modal" ><i class="icon-remove"></i> Close</a>
		<a href="#" class="btn save-board"><i class="icon-file"></i> Save</a>
	</div>
</div>