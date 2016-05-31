$(document).ready(function() {
    window.setInterval(function() {
        var num = Math.ceil(Math.random() * 276);
        $("#img_logo_oi").remove();
        $("#logo_oi").append("<img class='img-responsive center-block' id='img_logo_oi' src='../bootstrap/img/logo/logo_oi_"+num+".png'/>");
    }, 10000);

    $("[data-toggle='popover']").popover();
    $('#sair-dialog-link-btn').popover({content: 'Fechar sessão',
        trigger: "hover",
        placement: "left",
    });

    //DESABILITA A TECLA ENTER DE TODOS OS FORMS
    $('form').bind("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
    //FAZ LOGOUT DO PORTAL
    function sair() {
        $.ajax({
            type: "POST",
            url: "./controle/login.php",
            data: {acao: "sair"},
            beforeSend: function() {

            },
            success: function(data, textStatus, jqXHR) {
                //DIRECIONA PARA A PAGINA INDEX
                alert("Sessão Encerrada!");
                $(location).attr('href', 'index.html');
                $(".msg").html("abc");
            }
        });
    }
    //CONTADOR REGRESSIVO PARA LOGOUT AUTOAMTICO
    $('#time').chrony({
        minute: 59,
        //second: 5,
        displayHours: false,
        alert: {color: '#f00', minute: 1},
        finish: function() {
            sair();
        }
    });
    //ABRE JANELA PARA CONFIRMAÇÃO DE SAIDA
    $("#sair-dialog").dialog({
        autoOpen: false,
        modal: true,
        show: {
            effect: "scale",
            duration: 300
        },
        hide: {
            effect: "scale",
            duration: 300
        },
        width: 400,
        buttons: [
            {
                text: "Sim",
                click: function() {
                    sair();
                }
            },
            {
                text: "Cancel",
                click: function() {
                    $(this).dialog("close");
                }
            }
        ]
    });
    $("#sair-dialog-link, #sair-dialog-link-btn").click(function(event) {
        $("#sair-dialog").dialog("open");
        $(".ui-widget-header").show();
        //desabilita o botao de fechar na barra da janela
        $(".ui-dialog-titlebar-close").hide();
        event.preventDefault();
    });
    $("#sair_link, #sair_btn").click(function(evt) {
        $(".ui-widget-header").show();
        //desabilita o botao de fechar na barra da janela
        $(".ui-dialog-titlebar-close").hide();
        evt.preventDefault();
        $.ajax({
            type: "POST",
            url: "./controle/login.php",
            data: {acao: "sair"},
            beforeSend: function() {

            },
            success: function(data, textStatus, jqXHR) {
                $(location).attr('href', 'index.html');
                $(".msg").html("abc");
            }
        });
    });
    //ABRE JANELA PARA AJUDA
    $("#ajuda-dialog").dialog({
        autoOpen: false,
        position: {my: "left bottom", at: "left bottom", of: $("#ajuda-dialog-btn")},
        open: function() {
            $(".ui-widget-header").show();
            $(".ui-dialog-titlebar-close").hide();
        },
        modal: true,
        show: {
            effect: "scale",
            duration: 300
        }
        ,
        hide: {
            effect: "scale",
            duration: 300
        },
        width: 400,
        height: 'auto',
        buttons: [
            {
                text: "Enviar",
                id: "btn_enviar_mail",
                click: function() {
                    $.ajax({
                        type: "POST",
                        url: "./controle/controle.php",
                        data: {acao: "ajuda", login: $("#envia-login").val(), email: $("#envia-email").val()},
                        beforeSend: function() {
                            $("#envia-email, #envia-login").css({"background": "url('./img/load_p.gif') right center no-repeat"})
                                    .prop("disabled", true);
                            $("#btn_enviar_mail, .btn_fechar_mail").prop("disabled", true);
                        },
                        error: function() {
                            alert("ERRO!");
                        },
                        success: function(data) {
                            $(".btn_fechar_mail").prop("disabled", false);
                            $("#btn_enviar_mail").hide();
                            if (data == 'enviado') {
                                $("#ajuda-dialog form").after("<DIV class='espaco'></DIV><div id='ok' class='oi-alert oi-alert-success'><span class='glyphicon glyphicon-thumbs-up'></span> Email Enviado, verifique sua caixa!</div>").hide();
                            } else if (data == 'nao_existe') {
                                $("#ajuda-dialog form").after("<DIV class='espaco'></DIV><div id='ok' class='oi-alert oi-alert-warning'><span class='glyphicon glyphicon-warning-sign'></span> Email Não Existe!</div>").hide();
                            } else {
                                $("#ajuda-dialog form").after("<DIV class='espaco'></DIV><div id='ok' class='oi-alert oi-alert-danger'><span class='glyphicon glyphicon-thumbs-down'></span> Email Não Enviado!</div>").hide();
                            }
                        }
                    }).done(function(e) {// MOSTRA O RETORNO DA PAGINA IGUAL ACIMA NO SUCCESS $(".msg").text(data);
                        //$('.msg').text(e);
                    });
                }
            },
            {
                text: "Fechar",
                class: "btn_fechar_mail",
                click: function() {
                    $("#ajuda-dialog form, #btn_enviar_mail").show().prop("disabled", false);
                    $("#ajuda-dialog #ok").hide();
                    $("#envia-email, #envia-login").css({"background": "white"}).prop("disabled", false);

                    $(this).dialog("close");
                }
            }
        ]
    });
    $("#ajuda-dialog-btn").click(function(event) {
        $("#ajuda-dialog").dialog("open");
        $(".ui-widget-header").show();
        //desabilita o botao de fechar na barra da janela
        $(".ui-dialog-titlebar-close").hide();
        event.preventDefault();
    });

});