fnCreateDataTable("board_table");

function fnCreateDataTable(sTableName) {
	$("#" + sTableName).dataTable({
		"sPaginationType": "full_numbers"
	});

	$(".entry-editable").hide();

	$(".table-container").undelegate(".edit-button");
	$(".table-container").delegate(".edit-button", "click", function(){
		$(this).toggle();
		$(".entry-editable, .entry-static").toggle();
	});

	$(".table-container").undelegate(".html-modal-open");
	$(".table-container").delegate(".html-modal-open", "click", function(){
		$(".html-modal").modal();
	});
}