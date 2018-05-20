var forms = ["box-change-password", "box-newsletter"];

$.each(forms, function(index, value){
    $("#" + value).submit(function(event) {
        event.preventDefault();
        var datas = $(this).serialize();
        $("#" + value + " :input").prop("disabled", true);
        $("#" + value + "-icon").attr("class", "fa fa-spinner fa-spin");
        $.ajax({
            url: "/ajax/account/update",
            type: "post",
            data: datas,
            dataType: "json",
            success: function(json, statut){
                if(json.result.success){
                    $("#" + value + "-result").html("<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.success + "</div><br>");
                }else{
                    $("#" + value + "-result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.error + "</div><br>");
                }
                $("#" + value + " :input").prop("disabled", false);
                $("#" + value + "-icon").attr("class", "fa fa-edit");
                if(value != "box-newsletter"){
                    $("#" + value).trigger("reset");
                }
            },
            error: function(json, statut, error){
                $("#" + value + "-result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + ERROR_MSG  + "</div><br>");
                $("#" + value + " :input").prop("disabled", false);
                $("#" + value + "-icon").attr("class", "fa fa-edit");
            }
        });
    });
});