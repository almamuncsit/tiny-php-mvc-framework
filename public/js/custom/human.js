$(document).ready(function(){
    $("#human_ajax_loader").hide();
    $("#type").change(function (){
        var type = $("#type").val();
        var url = $("#url").val();
        $.ajax({
            type: "POST",
            url: url,
            data: {type: type},
            dataType: "html",
            beforeSend: function() {
                $("div.box-header").addClass("auto-loder");
                $("#human_ajax_loader").show();
            },
            success: function (data){
                $("div.box-header").removeClass("auto-loder");
                $("#human_ajax_loader").hide();
                $("#human_postions").html(data);
            }
            
        });
    });
    
});


