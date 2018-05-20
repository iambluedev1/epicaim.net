
$("#box-token-add").submit(function(event) {
    event.preventDefault();
    var datas = $(this).serialize();
    $("#box-token-add :input").prop("disabled", true);
    $("#box-token-add-icon").attr("class", "fa fa-spinner fa-spin");
    $.ajax({
        url: "/admin/ajax/token/add",
        type: "post",
        data: datas,
        dataType: "json",
        success: function(json, statut){
            if(json.result.success){
                $("#box-token-add-result").html("<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.success + "</div><br>");
                setTimeout(redirect("/admin/list/tokens"), 2000);
            }else{
                $("#box-token-add-result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.error + "</div><br>");
            }
            $("#box-token-add :input").prop("disabled", false);
            $("#box-token-add-icon").attr("class", "fa fa-edit");
            $("#box-token-add").trigger("reset");
        },
        error: function(json, statut, error){
            $("#box-token-add-result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + ERROR_MSG  + "</div><br>");
            $("#box-token-add :input").prop("disabled", false);
            $("#box-token-add-icon").attr("class", "fa fa-edit");
        }
    });
});