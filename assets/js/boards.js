fnCreateDataTable("board_table");

function fnCreateDataTable(sTableName) {
	$("#" + sTableName).dataTable({
		"sPaginationType": "full_numbers"
	});
}