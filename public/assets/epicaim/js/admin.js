function toggleFreeMode(){
    $.ajax({
        url: "/admin/ajax/toggle/free-mode",
        type: "get",
        dataType: "json",
        success: function(json, statut){
            if(json.result.success){
                $("#free_mode_result").html("<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.success + "</div><br>");
            }else{
                $("#free_mode_result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.error + "</div><br>");
            }
        },
        error: function(json, statut, error){
            $("#free_mode_result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + ERROR_MSG  + "</div><br>");
        }
    });
}