$(document).ready(function() {
    //EXIBE BALÃO
    $('[data-toggle="popover"]').popover();
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
});