$(document).ready(function() {
    setInterval(readLogFile, 1000);
    function readLogFile() {
        $.get($("#log").attr('arquivo'), {getLog: "false"}, function(data) {
            data = data.replace(new RegExp("\n", "g"), "<br />");
            $("#log").html(data);
        });
    }
});