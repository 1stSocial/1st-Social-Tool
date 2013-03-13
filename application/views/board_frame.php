<div class="row-fluid">
	<?php foreach($boards as $board) { ?>
		<div class="row-fluid">
			<div class="span4"><input placeholder="Enter a board name" value="<?= $board->board_name; ?>"/></div>
			<div class="span4"><input placeholder="Enter a Feed URL" value="<?= $board->board_url; ?>" /></div>
			<div class="span4"><textarea><?= $board->board_html; ?></textarea</div>
		</div>
	<?php } ?>
</div>