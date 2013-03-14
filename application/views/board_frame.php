<div class="row-fluid table-container">
	<table class="span12" cellpadding="10" id="board_table">
		<thead>
			<tr>
				<th>Board Name</th>
				<th>Board URL</th>
				<th class="small-col">Board HTML</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($boards as $board) { ?>
			<tr style="max-height:100px;">
				<td class="odd">
					<span class="entry-static board-name-holder"><?= $board->board_name; ?></span>
					<input type="text" size="50" class="span12 entry-editable" placeholder="Enter a board name" value="<?= $board->board_name; ?>"/></td>
				<td class="even">
					<span class="entry-static board-url-holder"><?= $board->board_url; ?></span>
					<input type="text" size="1000" class="span12 entry-editable" placeholder="Enter a Feed URL" value="<?= $board->board_url; ?>" /></td>
				<td class="odd small-col">
					<button class="btn btn-mini html-modal-open" board-name="<?= $board->board_name; ?>"><i class="icon-eye-open"></i> View/Edit</button>
					<span id="<?= $board->board_name; ?>" style="display:none;"><?= $board->board_html; ?></span>
				<td class="even">
					<button class="btn btn-mini board-edit"><i class="icon-edit "></i> Edit</button>
					<button class="btn btn-mini entry-editable board-save"><i class="icon-file"></i> Save</button>
					<button class="btn btn-mini board-preview"><i class="icon-eye-open"></i> Preview Board</button>
					<button class="btn btn-mini btn-danger board-delete"><i class="icon-trash icon-white"></i> Delete</button>
				</td>
			</tr>
	<?php } ?>
		</tbody>
	</table>
</div>

<div class="modal hide fade html-modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" style="color:white;" aria-hidden="true">&times;</button>
    <h3>Board HTML</h3>
  </div>
  <div class="modal-body">
<ul class="nav nav-tabs">
  <li class="active"><a href="#preview" class="save-board-html" data-toggle="tab">Preview</a></li>
  <li><a href="#edit" data-toggle="tab">Edit</a></li>
</ul>
<div class="tab-content">
  <div class="tab-pane active" id="preview">
  	
  </div>
  <div class="tab-pane" id="edit">
  	<textarea class="span12">
  		
  	</textarea>
  </div>
</div>
</div>
  <div class="modal-footer">
    <a href="#" class="btn"><i class="icon-remove"></i> Close</a>
    <a href="#" class="btn"><i class="icon-file"></i> Save</a>
  </div>
</div>