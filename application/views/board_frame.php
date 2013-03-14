<div class="row-fluid table-container">
	<table class="span12" cellpadding="10" id="board_table">
		<thead>
			<tr>
				<th>Board Name</th>
				<th>Board URL</th>
				<th>Board HTML</th>
				<th>Actions</th>
			</tr>
		</thead>
		<tbody>
	<?php foreach($boards as $board) { ?>
			<tr>
				<td class="odd">
					<span><?= $board->board_name; ?></span>
					<input class="entry-editable" type="text" size="50" class="span12" placeholder="Enter a board name" value="<?= $board->board_name; ?>"/></td>
				<td class="even">
					<span><?= $board->board_url; ?></span>
					<input class="entry-editable" type="text" size="1000" class="span12" placeholder="Enter a Feed URL" value="<?= $board->board_url; ?>" /></td>
				<td class="odd">
					<span><?= $board->board_html; ?></span>
					<textarea class="entry-editable"><?= $board->board_html; ?></textarea></td>
				<td class="even">
					<button class="btn btn-mini"><i class="icon-eye-open"></i> Preview</button>
					<button class="btn btn-mini"><i class="icon-edit"></i> Edit</button>
					<button class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete</button>
				</td>
			</tr>
	<?php } ?>
		</tbody>
	</table>
</div>