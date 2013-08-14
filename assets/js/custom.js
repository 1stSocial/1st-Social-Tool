$(document).ready(function(){
var path='';						   
var pathname = window.location.pathname;
 var tempPath= pathname.split('home');
  path=tempPath[0];
$("#parentTag").on('change',function(){
	var parnetTag=$(this).val();
	var dataString='parentTag='+parnetTag;
	$.ajax({
		url: path+"home/getChildTags",
		type: "POST",
		data: dataString,		
		success: function(response){
                 //alert(response);
				 $("#childTagsId").html(response);
		},
		error: function(error){
		}
	});
 });					   

 });