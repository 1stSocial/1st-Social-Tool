<table class="span12 board-table" cellpadding="10" id="board_table">
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
			<td class="even">
				<span class="entry-static board-url-holder"><?= $board->board_url; ?></span>
			<td class="odd small-col">
				<button class="btn btn-mini board-preview" title="Opens in new Tab/Window" rel="tooltip"><i class="icon-eye-open"></i> Preview</button>
				<span id="<?= $board->board_name; ?>_html" style="display:none;"><?= $board->board_html; ?></span>
				<span id="<?= $board->board_name; ?>_fb_id" style="display:none;"><?= $board->fb_app_id; ?></span>
			<td class="even">
				<button class="btn btn-mini html-modal-open" board-name="<?= $board->board_name; ?>"><i class="icon-edit"></i> Edit</button>
				<button class="btn btn-mini btn-danger delete-board"><i class="icon-trash icon-white"></i> Delete</button>
			</td>
		</tr>
<?php } ?>
	</tbody>
</table>