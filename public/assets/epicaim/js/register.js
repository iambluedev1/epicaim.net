$("#register-form").submit(function(event) {
	event.preventDefault();
	var datas = $(this).serialize();
	$("#resultlf").css("display", "inline");
	$("#resultlf").html("<div class=\"alert alert-warning\">Envoi du formulaire ...</div><br>");
	$.ajax({
		url: "/ajax/account/create",
		type: "post",
		data: datas,
		dataType: "json",
		success: function(json, statut){
			if(json.result.success){
				$("#resultlf").html("<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.success + "</div><br>");
			}else{
				$("#resultlf").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.error + "</div><br>");
			}
		},
		error: function(json, statut, error){
			$("#resultlf").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + ERROR_MSG  + "</div><br>");
		}
	});
	$('html, body').animate({
		scrollTop: 0
	}, 500);
});