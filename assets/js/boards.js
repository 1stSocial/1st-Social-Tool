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
		console.debug(response)
		$(".table-container table").html(response);
	}, "json");
	
	oDataTable.fnDraw(); 
}

function fnInitTable(sTableName, bDestroyInstance) {
	oDataTable = $(sTableName).dataTable({
		"sPaginationType": "full_numbers",
		"bPaginate": true
	});

	var sAddBoardButton = "<button class='btn create-board'><i class='icon-plus'></i> Create New Board</button>";
	$(".dataTables_filter").after(sAddBoardButton);
}

function fnCreateDataTable() {
	fnInitTable(".table-container table");

	$(".table-container").undelegate(".html-modal-open", "click");
	$(".table-container").delegate(".html-modal-open", "click", function(){
		var oTableRow = $(this).parent("td").parent("tr");

		var sBoardHtml = $("#" + $(this).attr("board-name") + "_html").html();
		var sBoardName = oTableRow.find(".board-name-holder").text();
		var sBoardUrl = oTableRow.find(".board-url-holder").text();
		var sBoardFbId = $("#" + $(this).attr("board-name") + "_fb_id").text();

		$(".html-modal .modal-body #preview .preview-box").html(sBoardHtml);
		$(".html-modal .modal-body #edit .html-modal-name, .html-modal .modal-header h3 span").text(sBoardName);
		$(".html-modal .modal-body #edit .html-modal-url").val(sBoardUrl);
		$(".html-modal .modal-body #edit .html-modal-fb-id").val(sBoardFbId);
		$(".html-modal .modal-body #html textarea").val(sBoardHtml);
		
		$(".html-modal").modal();
	});

	$(".table-container").undelegate(".board-preview", "click");
	$(".table-container").delegate(".board-preview", "click", function(){
		var oTableRow = $(this).parent("td").parent("tr");
		var sBoardName = oTableRow.find(".board-name-holder").text();
		window.open("/1st-Social-Tool/index.php/board_controller/show_board/" + sBoardName, '_newtab');
	});

	$(".html-modal").undelegate(".save-board-html", "click");
	$(".html-modal").delegate(".save-board-html", "click", function(){
		$(".html-modal #preview .preview-box").html($("#html textarea").val());
	});

	$(".html-modal").undelegate(".save-board", "click");
	$(".html-modal").delegate(".save-board", "click", function(){
		var oData = {
			"board_name": $(".html-modal .modal-body #edit .html-modal-name").text(),
			"board_url": $(".html-modal .modal-body #edit .html-modal-url").val(),
			"fb_app_id": $(".html-modal .modal-body #edit .html-modal-fb-id").val(),
			"board_html": $(".html-modal .modal-body #html textarea").val()
		};

		fnModifyBoard(oData);
	});

	$(".table-container").undelegate(".delete-board", "click");
	$(".table-container").delegate(".delete-board", "click", function(){
		var oTableRow = $(this).parent("td").parent("tr");
		var sBoardName = oTableRow.find(".board-name-holder").text();

		fnDeleteBoard(sBoardName);
	});

	$(".table-container").undelegate(".create-board", "click");
	$(".table-container").delegate(".create-board", "click", function(){
		fnCreateBoard();
	});

}

function fnModifyBoard(oData) {
	$.ajax({
		url: "board_controller/modify_board",
		data: oData,
		type: "POST",
		dataType: "json",
		beforeSend: function(){
			$(".save-board").button('loading');
		},
		success: function(response){
			fnRefreshTable();
			$(".save-board").button('reset');
			$(".html-modal").modal("hide");
		},
		error: function(error){
			fnHideLoader();
		}
	});
}

function fnCreateBoard() {

	$(".create-board-modal").modal();

}

function fnDeleteBoard(sBoardName) {

	var sAlertHtml = '<div class="alert alert-block alert-error alert-delete-board fade in">'
	+ '<button type="button" class="close" data-dismiss="alert">&times;</button>'
	+ '<h4 class="alert-heading">Are you sure you want to delete the board: <span>'+sBoardName+'</span></h4><br/>'
  	+ '<a class="btn btn-danger board-delete-confirm" data-loading-text="Deleting..." href="#"><i class="icon-trash icon-white"></i> Delete</a> <a class="btn" data-dismiss="alert" href="#"><i class="icon-remove"></i> Cancel</a>'
	+ '</p>'
	+ '</div>'

	fnCreateAlert(sAlertHtml);

	$("body").undelegate(".board-delete-confirm", "click");
	$("body").delegate(".board-delete-confirm", "click", function(){
		$.ajax({
			url: "board_controller/delete_board",
			data: {"board_name": sBoardName},
			type: "POST",
			dataType: "json",
			beforeSend: function(){
				$(".board-delete-confirm").button('loading');
			},
			success: function(response){
				console.debug(response);
				$(".board-delete-confirm").button('reset');
				if (response) {
					fnRefreshTable();
					// $(".new-alert").alert("close");
				}
			},
			error: function(reponse){

			}
		});
	});
}

function fnCreateAlert(sAlertHtml) {
	$("body").append("<div class='new-alert'>" + sAlertHtml + "</div>");
	$(".new-alert").alert();
}