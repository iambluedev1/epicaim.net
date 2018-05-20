$("input[type='checkbox']").change(function(checked) {
    if(this.checked) {
        $("input[type='checkbox']").each(function(i, el) {
            if($(el).is(':checked')){
                $(el).prop('checked', false);
            }
        });
        $(this).prop('checked', true);
    }
});

var forms = ["box-type", "box-send"];
var table = $('#admin_table').DataTable();

$.each(forms, function(index, value){
    $("#" + value).submit(function(event) {
        event.preventDefault();
        var datas = $(this).serialize();
        $("#" + value + " :input").prop("disabled", true);
        $("#" + value + "-icon").attr("class", "fa fa-spinner fa-spin");

        var url = "";

        if(value == "box-type"){
            url = "/admin/ajax/newsletter/type";
        }else{
            url = "/admin/ajax/newsletter/send";
        }

        $.ajax({
            url: url,
            type: "post",
            data: datas,
            dataType: "json",
            success: function(json, statut){
                if(json.result.success){
                    $("#" + value + "-result").html("<div class=\"alert alert-success\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.success + "</div><br>");
                    if(value == "box-type"){
                        $("#type_step").hide();
                        $("#final_step").show();
                        $("#type_input").val(json.result.type);
                        $.each(json.result.users, function(i, el){
                            table.row.add([
                                el.userId,
                                el.userName,
                                el.userEmail,
                                "<a href=\"/admin/view/user/" + el.userId + "\" class=\"btn btn-primary\">Voir</a>"
                            ]).draw(false);
                        });
                        $('html, body').animate({
                            scrollTop: $("#final_step").offset().top
                        }, 500);
                    }
                }else{
                    $("#" + value + "-result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + json.result.error + "</div><br>");
                }
                $("#" + value + " :input").prop("disabled", false);
                $("#" + value + "-icon").attr("class", "fa fa-edit");
            },
            error: function(json, statut, error){
                $("#" + value + "-result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + ERROR_MSG  + "</div><br>");
                $("#" + value + " :input").prop("disabled", false);
                $("#" + value + "-icon").attr("class", "fa fa-edit");
            }
        });
        if(value == "box-send"){
            $('html, body').animate({
                scrollTop: $("#box-edit").offset().top
            }, 500);
        }
    });
});

function back(){
    $("#type_step").show();
    $("#final_step").hide();
    table.rows().remove().draw();
}