
$("#box-confirm-account").submit(function(event) {
    event.preventDefault();
    var datas = $(this).serialize();
    $("#box-confirm-account :input").prop("disabled", true);
    $("#box-confirm-account-icon").attr("class", "fa fa-spinner fa-spin");
    $.ajax({
        url: "/admin/ajax/user/confirm",
        type: "post",
        data: datas,
        dataType: "json",
        success: function(json, statut){
            if(json.result.success){
                $("#box-confirm-account-result").html("<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.success + "</div><br>");
            }else{
                $("#box-confirm-account-result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.error + "</div><br>");
            }
            $("#box-confirm-account :input").prop("disabled", false);
            $("#box-confirm-account-icon").attr("class", "fa fa-edit");
            $("#box-confirm-account").trigger("reset");
        },
        error: function(json, statut, error){
            $("#box-confirm-account-result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + ERROR_MSG  + "</div><br>");
            $("#box-confirm-account :input").prop("disabled", false);
            $("#bbox-confirm-account-icon").attr("class", "fa fa-edit");
        }
    });
});


$("#box-hwid").submit(function(event) {
    event.preventDefault();
    var datas = $(this).serialize();
    $("#box-confirm-account :input").prop("disabled", true);
    $("#box-confirm-account-icon").attr("class", "fa fa-spinner fa-spin");
    $.ajax({
        url: "/admin/ajax/user/hwid/change",
        type: "post",
        data: datas,
        dataType: "json",
        success: function(json, statut){
            if(json.result.success){
                $("#box-hwid-result").html("<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.success + "</div><br>");
                $("#hwid").val($("#new_hwid").val());
                setTimeout(function(){
                    $("#panel-hwid").hide();
                }, 500);
            }else{
                $("#box-hwid-result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.error + "</div><br>");
            }
            $("#box-hwid :input").prop("disabled", false);
            $("#box-hwid-icon").attr("class", "fa fa-edit");
        },
        error: function(json, statut, error){
            $("#box-hwid-result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + ERROR_MSG  + "</div><br>");
            $("#box-hwid :input").prop("disabled", false);
            $("#bbox-hwid-icon").attr("class", "fa fa-edit");
        }
    });
});

function editHWID(){
    $("#panel-hwid").show();
}