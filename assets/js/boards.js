fnCreateDataTable("board_table");

function fnCreateDataTable(sTableName) {
	$("#" + sTableName).dataTable({
		"sPaginationType": "full_numbers"
	});

	var sAddBoardButton = "<button class='btn create-board'><i class='icon-plus'></i> Create New Board</button>";
	$(".dataTables_filter").after(sAddBoardButton);

	$(".entry-editable").hide();

	$(".table-container").undelegate(".board-edit", "click");
	$(".table-container").delegate(".board-edit", "click", function(){
		$(this).toggle();
		var oTableRow = $(this).parent("td").parent("tr");
		oTableRow.find(".entry-editable, .entry-static").toggle();
		$(oTableRow).addClass("editable");
	});

	$(".table-container").undelegate(".html-modal-open", "click");
	$(".table-container").delegate(".html-modal-open", "click", function(){
		var oTableRow = $(this).parent("td").parent("tr");

		var sBoardHtml = $("#" + $(this).attr("board-name")).html();
		var sBoardName = oTableRow.find(".board-name-holder").text();
		var sBoardUrl = oTableRow.find(".board-url-holder").text();

		$(".html-modal .modal-body #preview").html(sBoardHtml);
		$(".html-modal .modal-body #edit .html-modal-name").val(sBoardName);
		$(".html-modal .modal-body #edit .html-modal-url").val(sBoardUrl);
		$(".html-modal .modal-body #edit textarea").val(sBoardHtml);
		
		$(".html-modal").modal();
		$("#jobs").html("<span class='text-center'>Jobs will not appear until you preview the feed</span>")
	});

	$(".html-modal").undelegate(".save-board-html", "click");
	$(".html-modal").delegate(".save-board-html", "click", function(){
		$("#preview").html($("#edit textarea").val());
	});

}