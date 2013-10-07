<table class="table table-bordered" cellpadding="10" id="board_table" style="text-align:center">
	<thead>
		<tr>
                    <th style="text-align: center">Board Name</th>
			<th>Board URL</th>
			<th class="small-col">Board Preview</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($boards as $board) { ?>
		<tr style="max-height:100px;">
			<td class="odd">
				<span class="entry-static board-name-holder"><?= $board->board_name; ?></span>
			</td>
			<td class="even">
				<span class="entry-static board-url-holder"><?= $board->board_url; ?></span>
			</td>
			<td class="odd">
				<button class="btn btn-mini board-preview" title="Opens in new Tab/Window" rel="tooltip"><i class="icon-eye-open"></i> Preview</button>

				<span id="<?= $board->board_name; ?>_html" style="display:none;"><!--<?= $board->board_html; ?>--></span>
				<span id="<?= $board->board_name; ?>_fb_id" style="display:none;"><?= $board->fb_app_id; ?></span>
				<span id="<?= $board->board_name; ?>_css" style="display:none;"><?= $board->board_css; ?></span>
				<span id="<?= $board->board_name; ?>_background" style="display:none;"><?= $board->board_background; ?></span>
			</td>
			<td class="even">
				<button class="btn btn-mini html-modal-open" board-name="<?= $board->board_name; ?>"><i class="icon-edit"></i> Edit</button>
				<button class="btn btn-mini btn-danger delete-board"><i class="icon-trash icon-white"></i> Delete</button>
			</td>
		</tr>
<?php } ?>
	</tbody>
</table>