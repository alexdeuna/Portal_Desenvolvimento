$(document).ready(function() {
    $(":button").click(function(evt) {
        //$(".msg").text($(":input").val()+" - "+$(":password").val());
        evt.preventDefault();
        $.ajax({
            type: "POST",
            url: "login.php",
            //data: "u=" + $(":text").val() + "&p=" + $(":password").val(),
            data: {u:$(":text").val(),p:$(":password").val()},
            
            beforeSend: function() {

            },
            success: function(data, textStatus, jqXHR) {
                $(".msg").html(data);
            }
        });
    });
    $(":button").click(function(evt) {
        
    });
});