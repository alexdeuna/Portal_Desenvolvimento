$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
    $("#msg").hide();
    var popoverTemplate = ['<div class="popover">',
        '<div class="arrow"></div>',
        '<div class="popover-content">',
        'Fechar sessão',
        '</div>',
        '</div>'].join('');
    $('#sair-dialog-link-btn').popover({content: content,
        trigger: "hover",
        placement: "left",
        template: popoverTemplate,
        html: true});
    // $("#sair-btn").trigger("click");
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
        event.preventDefault();
    });

    //ABRE JANELA PARA AJUDA
    $("#ajuda-dialog").dialog({
        autoOpen: false,
        open: function() {
            //desabilita o botao de fechar na barra da janela
            $(".ui-dialog-titlebar-close").hide();
            //$("#ajuda-dialog").parent().find(".ui-dialog-titlebar-close").hide();
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
        event.preventDefault();
    });
//FAZ O LOGIN DO PORTAL
    $("#acessar").click(function(evt) {
        //$(".msg").text($(":input").val()+" - "+$(":password").val());
        evt.preventDefault();
        $.ajax({
            type: "POST",
            url: "./controle/controle.php",
            //data: "u=" + $(":text").val() + "&p=" + $(":password").val(),
            data: {acao: "entrar", login: $(":text").val(), senha: $(":password").val()},
            beforeSend: function() {
                $(".loader").fadeIn();
                $(".container").hide();
                $("#ajuda-dialog-btn, #acessar").prop("disabled", true);
            },
            error: function() {
                $(".loader").hide();
                $(".container").show();
                $("#msg").show();
                //$('<p>teste</p>').appendTo('nav');
                $("#ajuda-dialog-btn, #acessar").prop("disabled", false);
                alert("Usuário ou Senha Inválidos");
            },
            success: function(data, textStatus, jqXHR) {
                $(location).attr('href', 'default.php');
                //$(".msg").html(data);
            }
        });
    });
    $("#sair_link, #sair_btn").click(function(evt) {
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
});