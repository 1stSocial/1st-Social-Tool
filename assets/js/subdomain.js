fnGetSubdomains();

function fnGetSubdomains() {
$.ajax({
		url: "/cpanel/get_subdomains",
		type: "GET",
		dataType: "json",
		beforeSend: function(){
		},
		success: function(response){
$(".subdomain-table").html(response.subdomains[0]);
		},
		error: function(error){
		}
	});


}