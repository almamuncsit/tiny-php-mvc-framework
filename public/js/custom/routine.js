$(document).ready(function(){

    $("#exam").hide();

    /*
     * ****************************************
     * Get Batch on input select list
     * onchange of Sections
     * ****************************************
     */
    $("#section").change(function (){
        var section = $("#section").val();
        var ajax_url = $("#base_url").val() + 'routine/batch';
        $.ajax({
            type: "POST",
            url: ajax_url,
            data: {section: section},
            dataType: "html",
            beforeSend: function() {
                $("div.box-header").addClass("auto-loder");
            },
            success: function (data){
                $("div.box-header").removeClass("auto-loder");
                $("#batch").html(data);
            }
        });
    });


    $("#type").change(function (){
        var type = $("#type").val();
        if (type == 'Exam') {
            $("#exam").show();
        }else {
            $("#exam").hide();
        }
    });
});


