fnCreateDataTable();

//Globals are BAD! mAKE THIS OO ASAP
var sBoardName = "";

//To go in main
$("[rel='tooltip']").tooltip();

function fnShowLoader() {
	$(".loader").show();
}

function fnHideLoader() {
	$(".loader").hide();
}

function fnRefreshTable() {
	fnShowLoader();
	$.get("board_controller/get_board_table_html/true", function(response){
		fnHideLoader();
		$(".table-container table").html(response);
	}, "json");
	
	oDataTable.fnDraw(); 
}

function fnInitTable(sTableName, bDestroyInstance) {
	oDataTable = $(sTableName).dataTable({
		"sPaginationType": "full_numbers",
		"bPaginate": true,
		"aoColumnDefs": [ 
         { "bSortable": false, "aTargets": [2, 3] }
       ]
	});

	var sAddBoardButton = "<button class='btn create-board'><i class='icon-plus'></i> Create New Board</button>";
	$(".dataTables_filter").after(sAddBoardButton);
}

function fnCreateDataTable() {
	fnInitTable(".table-container table");

	$(".table-container").undelegate(".html-modal-open", "click");
	$(".table-container").delegate(".html-modal-open", "click", function(){
		var oTableRow = $(this).parent("td").parent("tr");

		sBoardName = oTableRow.find(".board-name-holder").text();

		var sBoardHtml = $("#" + $(this).attr("board-name") + "_html").html();
		var sBoardUrl = oTableRow.find(".board-url-holder").text();
		var sBoardFbId = $("#" + $(this).attr("board-name") + "_fb_id").text();
		var sBoardCss = $("#" + $(this).attr("board-name") + "_css").html();
		var sBoardBackground = $("#" + $(this).attr("board-name") + "_background").html();

		$(".html-modal .modal-body #preview .preview-box").html(sBoardHtml);
		$(".html-modal .modal-body #edit .html-modal-name, .html-modal .modal-header h3 span").text(sBoardName);
		$(".html-modal .modal-body #edit .html-modal-url").val(sBoardUrl);
		$(".html-modal .modal-body #edit .html-modal-fb-id").val(sBoardFbId);
		$(".html-modal .modal-body #html textarea").val(sBoardHtml);
		$(".html-modal .modal-body #css textarea").val(sBoardCss);
		$(".html-modal .modal-body #css .file-name").html(sBoardBackground);
		
		$('#edit_fileupload').fileupload({
		    dataType: 'json',
		    formData: {"board_name": sBoardName},
		    change: function(e, data) {
		    	fnShowLoader();
		    },
		    done: function (e, data) {
		    	fnHideLoader();
		    	var sChangedFileName = sBoardName + "." + data.result.extension;
		    	$(".html-modal .file-name").html("<span class='actual-file-name'>" + data.result.file_name + "</span>" + " uploaded as <span class='changed-file-name'>"+sChangedFileName+"</span>!");
		    }
		});

		$(".file-name").html();
		$(".html-modal").modal();
	});

	$(".table-container").undelegate(".board-preview", "click");
	$(".table-container").delegate(".board-preview", "click", function(){
		var oTableRow = $(this).parent("td").parent("tr");
		sBoardName = oTableRow.find(".board-name-holder").text();
		
//Below needs to change depending on environment
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
			"board_html": $(".html-modal .modal-body #html textarea").val(),
			"board_css": $(".html-modal .modal-body #css textarea").val(),
			"board_background": $(".html-modal .modal-body #css .file-name .changed-file-name").html()
		};
		
		fnModifyBoard(oData);
	});

	$(".table-container").undelegate(".delete-board", "click");
	$(".table-container").delegate(".delete-board", "click", function(){
		var oTableRow = $(this).parent("td").parent("tr");
		sBoardName = oTableRow.find(".board-name-holder").text();

		fnDeleteBoard(sBoardName);
	});

	$(".table-container").undelegate(".create-board", "click");
	$(".table-container").delegate(".create-board", "click", function(){
		var oTableRow = $(this).parent("td").parent("tr");
		sBoardName = oTableRow.find(".board-name-holder").text();
		
		$('#create_fileupload').fileupload({
		    dataType: 'json',
		    // formData: {"board_name": sBoardName},
		    change: function(e, data) {
		    	fnShowLoader();
		    },
		    done: function (e, data) {
		    	fnHideLoader();
		    	var sChangedFileName = sBoardName + "." + data.result.extension;
		    	$(".create-board-modal .file-name").html("<span class='actual-file-name'>" + data.result.file_name + "</span> uploaded!");
		    }
		})

		$(".file-name").html();
		$(".create-board-modal").modal();
	});

	$(".create-board-modal").undelegate(".create-board", "click");
	$(".create-board-modal").delegate(".create-board", "click", function(){
		var oData = {
			"board_name": $(".create-board-modal .modal-body #create_settings .create-modal-name").val(),
			"board_url": $(".create-board-modal .modal-body #create_settings .create-modal-url").val(),
			"fb_app_id": $(".create-board-modal .modal-body #create_settings .create-modal-fb-id").val(),
			"board_html": $(".create-board-modal .modal-body #create_html textarea").val(),
			"board_css": $(".create-board-modal .modal-body #create_css textarea").val(),
			"board_background": $(".create-board-modal .modal-body #create_css .file-name .changed-file-name").html()
		};

		fnCreateBoard(oData);
	});

	//Use buttons in place of file input
	$(".html-modal").undelegate(".edit-upload", "click");
	$(".html-modal").delegate(".edit-upload", "click", function(){
		console.debug('here', $(".html-modal .css #edit_fileupload")	)
		$(".html-modal #css #edit_fileupload").trigger("click");
	});

	$(".create-board-modal").undelegate(".create-upload", "click");
	$(".create-board-modal").delegate(".create-upload", "click", function(){
		$(".create-board-modal #create_css #create_fileupload").trigger("click");
	});

}

function fnGetFileName(oTargetInput) {
	var aFiles = $(oTargetInput).prop("files");
	var aNames = $.map(aFiles, function(val) { return val.name; });
	return aNames;
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

function fnCreateBoard(oData) {
		$.ajax({
			url: "board_controller/create_board",
			data: oData,
			type: "POST",
			dataType: "json",
			beforeSend: function(){
				$(".create-board").button('loading');
			},
			success: function(response){
				fnRefreshTable();
				$(".create-board").button('reset');
				$(".create-board-modal").modal("hide");
			},
			error: function(error){
			}
		});

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
				$(".board-delete-confirm").button('reset');
				if (response) {
					fnRefreshTable();
					$(".alert").alert('close');
				}
			},
			error: function(response){

			}
		});
	});
}

//Move to main.js
function fnCreateAlert(sAlertHtml) {
	$("body").append("<div class='new-alert'>" + sAlertHtml + "</div>");
	$(".new-alert").alert();
}

