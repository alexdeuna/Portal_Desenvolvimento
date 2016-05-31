$(document).ready(function() {
    $("#apps").html("<img class='img-responsive center-block oi-logooss' src='../bootstrap/img/logo_oss_cor_150.gif'/><div class = 'text-center oi-texto' > Operacao Plataformas De Suporte </div> <div class = 'text-center oi-texto'> Diretoria CGR </div>");
    $("#nome_app, #desc_app").text("Home");
    $("#carregando").hide();
    $.ajax({
        type: "POST",
        url: "./controle/controle.php",
        data: {acao: "menu"},
        beforeSend: function() {

        },
        error: function(data) {
            $('<p>' + data + '</p>').appendTo('nav');
        },
        success: function(data, textStatus, jqXHR) {
            $("#menu_user").append(data);
            $("#nav_nome").text($("#usuarionome").attr('value'));
        }
    });
    //USAMOS ESSA CHAMADA PARA ELA LER O CODIGO APENDADO E APLICAR AS FUNÇÕES
    $('#menu_user').on('click', 'a', function() {
        $separador = $(this).attr('tipo');
        $pasta = $(this).attr('value');
        $nomeapp = $(this).text();
        $desc = $(this).attr('desc');
        $efeito = "slide";
        if ($pasta != 'home') {
            $.ajax({
                url: '../app/' + $(this).attr('value') + '/index.php',
                error: function(data) {
                    $("#painel").toggle($efeito, 1000, function() {
                        $("#apps").show();
                        $("#apps").html("<h1> Sistema em construção!</h1>");
                        $("#nome_app").text($nomeapp);
                        $("#desc_app").text($desc);
                        $("#carregando").dialog("close");
                    });
                },
                beforeSend: function() {
                    if ($separador != 's') {
                        $(document).scrollTop(125);
                        $("#carregando").dialog("open");
                        $("#painel").toggle($efeito, 1000, function() {
                            $("#apps").show();
                            $("#apps").html("...");
                            $("#nome_app").text($nomeapp);
                            $("#desc_app").text($desc);

                        });
                    } else {
                        exit;
                    }
                },
                success: function(html) {
                    $("#painel").toggle($efeito, 1000, function() {
                        $("#carregando").dialog("close");
                        $("#apps").html(html);
                    });
                }
            });
        } else {
            $("#painel").hide($efeito, 1000, function() {
                $("#carregando").dialog("close");
                $("#apps").html("<img class='img-responsive center-block oi-logooss' src='../bootstrap/img/logo_oss_cor_150.gif'/><div class = 'text-center oi-texto' > Operacao Plataformas De Suporte </div> <div class = 'text-center oi-texto'> Diretoria CGR </div>");
                $("#nome_app, #desc_app").text("Home");
            });
            $("#painel").show($efeito, 1000);
        }
    });
    //ABRE JANELA PARA AJUDA
    $("#carregando").dialog({
        autoOpen: false,
        dialogClass: "alert",
        open: function() {
            //desabilita o topo, a barra da janela
            $(".ui-widget-header").hide();
        },
        modal: true,
        show: {
            effect: "fade",
            duration: 500
        }
        ,
        hide: {
            effect: "fade",
            duration: 100
        },
        width: 'auto',
        height: 'auto'
    });
});