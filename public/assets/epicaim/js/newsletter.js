$(document).ready(function() {
  $('#newsContent').summernote();
});

var countTrad = $("#trads > div").size();

function addTrad(){
    $("#trads").append("<div id=\"trad-" + countTrad + "\">\
        <div class=\"row\">\
            <div class=\"col-sm-12\">\
                <div class=\"form-group\">\
                    <label>Nom de la variable (doit commencer et terminer par %)</label>\
                    <span class=\"pull-right\"><a onclick=\"delTrad(" + countTrad + ");\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i>&nbsp;</a></span>\
                    <input class=\"form-control\" name=\"trad_title[]\" type=\"text\" required>\
                </div>\
            </div>\
        </div>\
        <div class=\"row\">\
            <div class=\"col-sm-6\">\
                <div class=\"form-group\">\
                    <label>Version française</label>\
                    <input class=\"form-control\" type=\"text\" name=\"trad_fr[]\" required>\
                </div>\
            </div>\
            <div class=\"col-sm-6\">\
                <div class=\"form-group\">\
                    <label>Version anglaise</label>\
                    <input class=\"form-control\" type=\"text\" name=\"trad_en[]\" required>\
                </div>\
            </div>\
        </div>\
        <hr>\
    </div>"); 
    countTrad++;   
}

function delTrad(i){
    $("#trad-" + i).remove();
    countTrad--;
}

var forms = ["box-edit", "box-content", "box-trad"];

$.each(forms, function(index, value){
    $("#" + value).submit(function(event) {
        event.preventDefault();
        var datas = $(this).serialize();
        $("#" + value + " :input").prop("disabled", true);
        $("#" + value + "-icon").attr("class", "fa fa-spinner fa-spin");
        $.ajax({
            url: "/admin/ajax/newsletter/update",
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
            },
            error: function(json, statut, error){
                $("#" + value + "-result").html("<div class=\"alert alert-danger\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>" + ERROR_MSG  + "</div><br>");
                $("#" + value + " :input").prop("disabled", false);
                $("#" + value + "-icon").attr("class", "fa fa-edit");
            }
        });
    });
});