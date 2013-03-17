fnCreateDataTable();

//To go in main
$("[rel='tooltip']").tooltip();

function fnShowLoader() {
	$(".loader").show();
}

function fnHideLoader() {
	$(".loader").hide();
}

function fnRefreshTable() {
	$.get("board_controller/get_board_table_html/true", function(response){
		fnHideLoader();
		$(".table-container").html(response);
	}, "json");
}

function fnInitTable(sTableName) {
	$("#" + sTableName).dataTable({
		"sPaginationType": "full_numbers"
	});
}

function fnCreateDataTable() {
	fnInitTable("board_table");

	var sAddBoardButton = "<button class='btn create-board'><i class='icon-plus'></i> Create New Board</button>";
	$(".dataTables_filter").after(sAddBoardButton);

	$(".table-container").undelegate(".html-modal-open", "click");
	$(".table-container").delegate(".html-modal-open", "click", function(){
		var oTableRow = $(this).parent("td").parent("tr");

		var sBoardHtml = $("#" + $(this).attr("board-name")).html();
		var sBoardName = oTableRow.find(".board-name-holder").text();
		var sBoardUrl = oTableRow.find(".board-url-holder").text();

		$(".html-modal .modal-body #preview").html(sBoardHtml);
		$(".html-modal .modal-body #edit .html-modal-name, .html-modal .modal-header h3 span").text(sBoardName);
		$(".html-modal .modal-body #edit .html-modal-url").val(sBoardUrl);
		$(".html-modal .modal-body #edit textarea").val(sBoardHtml);
		
		$(".html-modal").modal();
		$("#jobs").html("<span class='text-center'>Jobs will not appear until you preview the feed</span>")
	});

	$(".table-container").undelegate(".board-preview", "click");
	$(".table-container").delegate(".board-preview", "click", function(){
		var oTableRow = $(this).parent("td").parent("tr");
		var sBoardName = oTableRow.find(".board-name-holder").text();
		window.open("/1st-Social-Tool/index.php/board_controller/show_board/" + sBoardName, '_newtab');
	});

	$(".html-modal").undelegate(".save-board-html", "click");
	$(".html-modal").delegate(".save-board-html", "click", function(){
		$("#preview").html($("#edit textarea").val());
	});

	$(".html-modal").undelegate(".save-board", "click");
	$(".html-modal").delegate(".save-board", "click", function(){
		var oData = {
			"board_name": $(".html-modal .modal-body #edit .html-modal-name").text(),
			"board_url": $(".html-modal .modal-body #edit .html-modal-url").val(),
			"board_html": $(".html-modal .modal-body #edit textarea").val()
		};

		$.ajax({
			url: "board_controller/modify_board",
			data: oData,
			type: "POST",
			dataType: "json",
			beforeSend: function(){
				fnShowLoader();
			},
			success: function(response){
				fnRefreshTable();
				$(".html-modal").modal("hide");
			},
			error: function(error){
				fnHideLoader();
			}
		});
	});

}