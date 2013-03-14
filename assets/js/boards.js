fnCreateDataTable("board_table");

function fnCreateDataTable(sTableName) {
	$("#" + sTableName).dataTable({
		"sPaginationType": "full_numbers"
	});

	$(".entry-editable").hide();

	$(".table-container").undelegate(".edit-button", "click");
	$(".table-container").delegate(".edit-button", "click", function(){
		$(this).toggle();
		$(".entry-editable, .entry-static").toggle();
	});

	$(".table-container").undelegate(".html-modal-open", "click");
	$(".table-container").delegate(".html-modal-open", "click", function(){
		$(".html-modal").modal();
	});

	$(".html-modal").undelegate(".save-board-html", "click");
	$(".html-modal").delegate(".save-board-html", "click", function(){
		
	});
}