function divNone() {
    document.getElementById('carregando').style.display = 'inline';
    document.getElementById('conteudo').style.display = 'none';
}

function divShow() {
    document.getElementById('carregando').style.display = 'none';
    document.getElementById('conteudo').style.display = 'inline';
}
function formatatempo(segs) {
    min = 0;
    hr = 0;
    while (segs >= 60) {
        if (segs >= 60) {
            segs = segs - 60;
            min = min + 1;
        }
    }
    while (min >= 60) {
        if (min >= 60) {
            min = min - 60;
            hr = hr + 1;
        }
    }
    if (hr < 10)
        hr = "0" + hr
    if (min < 10)
        min = "0" + min
    if (segs < 10)
        segs = "0" + segs
    fin = hr + ":" + min + ":" + segs
    if (min == 0 && segs == 0) {
        alert('Sessão Expirou!');
        location.reload();
    } else {
        return fin;
    }
}
var segundos = 1200; //inicio do cronometro
function conta() {
    segundos--;
    document.getElementById("sessao").innerHTML = formatatempo(segundos);
}
function inicia() {
    interval = setInterval("conta();", 1000);
}

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