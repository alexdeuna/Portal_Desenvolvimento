$(document).ready(function() {
    $('form').bind("keypress", function(e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            return false;
        }
    });
    $("#tabs").tabs();
    $("#usuario_cad, #usuario_permissao").click(function() {
        $("#limpar_user").trigger('click');
    });
    $("#accordion_user, #accordion_app").accordion({
        heightStyle: "content"
    });
    $(".column").sortable({
        connectWith: ".column",
        handle: ".portlet-header",
        cancel: ".portlet-toggle",
        placeholder: "portlet-placeholder ui-corner-all"
    });
    $(".portlet")
            .addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
            .find(".portlet-header")
            .addClass("ui-widget-header ui-corner-all")
            .prepend("<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");
    $(".portlet-toggle").click(function() {
        var icon = $(this);
        icon.toggleClass("ui-icon-minusthick ui-icon-plusthick");
        icon.closest(".portlet").find(".portlet-content").toggle();
    });
// ------ LISTA TODOS OS SISTEMAS ------
    $.ajax({
        type: "POST",
        url: "./controle_adm.php",
        data: {acao: "listar_sistemas"},
        beforeSend: function() {

        },
        error: function(data) {
            alert("erro na geracao da lista de sistemas");
        },
        success: function(data, textStatus, jqXHR) {
            $("#sistemas").append(data);
            $("#sistemas :button").removeClass("btn-success").addClass("btn-danger").attr("disabled", "disabled");
        }
    });

// ------ INCLUIR USUARIO ------
    $("#cadastrar_user").click(function(evt) { 
        evt.preventDefault();  
        $.ajax({
            type: "POST",
            url: "./controle_adm.php",
            data: {acao: "cadastrar_usuario", autorizado: $("#login_manter").val(), perfil: $("#perfil").val(), email: $("#email").val(), nome: $("#nome").val(), tel: $("#tel").val(), obs: $("#obs").val()},
            beforeSend: function() {
            },
            error: function(data) {
                alert("erro ao criar usuário!");
            },
            success: function(data, textStatus, jqXHR) {
                if (data == 1) {
                    alert("Usuário criada!");
                    $("#limpar_user").trigger('click');
                } else {
                    alert("Preencha todo formulário!");
//                    $("#fadduser :input").map(function() {
//                        if (!$(this).val()) {
//                           $(this).after('<span class="input-group-addon danger" ><span class="glyphicon glyphicon-remove-circle"></span></span>');
//                        }
//                    });
                }
            }
        });
    });
// ------ ALTERAR USUARIO ------
    $("#atualizar_user").click(function(evt) {
        evt.preventDefault();
        $.ajax({
            type: "POST",
            url: "./controle_adm.php",
            data: {acao: "atualizar_usuario", id: $("#id_usuario").val(), autorizado: $("#login_manter").val(), perfil: $("#perfil").val(), email: $("#email").val(), nome: $("#nome").val(), tel: $("#tel").val(), obs: $("#obs").val()},
            beforeSend: function() {
            },
            error: function(data) {
                alert("erro ao atualizar os dados do usuário!");
            },
            success: function(data, textStatus, jqXHR) {
                if (data == 1) {
                    alert("Usuário atualizado!");
                    $("#limpar_user").trigger('click');
                } else {
                    alert("Preencha todo formulário!");
                }
            }
        });
    });
// ------ AUTOCOMPLETE CADASTRO USUARIO ------
    /*    var esportes = ["Natação","Futebol","Vôlei","Basquete"];
     $("#login1").autocomplete({source: esportes});
     */
    $('#login_manter, #login_permissao').autocomplete({
        source: function(request, response) {
            $.ajax({
                type: "POST",
                url: './controle_adm.php',
                dataType: "json",
                data: {
                    name_startsWith: request.term,
                    acao: 'login_complete',
                    row_num: 1
                },
                success: function(data) {
                    $("#sistemas :button").removeClass("btn-success").addClass("btn-danger").prop("disabled", true);
                    response($.map(data, function(item) {
                        var code = item.split("|");
                        return {
                            label: code[0],
                            value: code[0],
                            data: item
                        };
                    }));
                }
            });
        },
        autoFocus: true,
        minLength: 0,
        select: function(event, ui) {
            var names = ui.item.data.split("|");
            $('#nome').val(names[1]);
            $('#email').val(names[2]);
            $('#tel').val(names[3]);
            $('#obs').val(names[4]);
            $('#id_usuario').val(names[5]);
            $('#perfil').val(names[6]);
            $('#cadastrar_user').attr("disabled", "disabled");
            $('#atualizar_user').removeAttr("disabled");
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "./controle_adm.php",
                data: {acao: "login_complete_permissao", id_usuario: $('#id_usuario').val()},
                beforeSend: function() {
                },
                error: function(data) {
                    alert("erro na busca de acesso do usuario");
                },
                success: function(e, textStatus, jqXHR) {
                    //  alert(data + " - " + textStatus + " - " + " - " + jqXHR);
                    $("#sistemas :button").removeClass("btn-success").addClass("btn-danger").prop("disabled", false);
                    $.map(e, function(item) {
                        var code = item.split("|");
                        $id_menu = code[0];
                        $id_user = code[1];
                        $id_app = code[2];
                        //alert("ID: " + $id + " ID user: " + $id_user + "ID app: " + $id_app)
                        $("#sistemas :button[id=" + $id_app + "]")
                                .removeClass("btn-danger")
                                .addClass("btn-success");
                    });
                }
            });
        }
    });
    $('#atualizar_user').attr("disabled", "disabled");
    $("#limpar_user").click(function(evt) {
        $("#sistemas :button").removeClass("btn-success").addClass("btn-danger").attr("disabled", "disabled");
        $('#atualizar_user').attr("disabled", "disabled");
        $('#cadastrar_user').removeAttr("disabled");
        $("input").val("");
    });

// ------ PERMISSAO DO USUARIO ------
    $("#sistemas").on('click', 'button', function() {
        $class = $(this).attr('class');
        $btn = $(this);
        if ($class == 'btn btn-danger') {
            $.ajax({
                type: "POST",
                url: "./controle_adm.php",
                data: {acao: "inclui_acesso", idApp: $btn.attr("id"), idUsuario: $("#id_usuario").val()},
                beforeSend: function() {
                },
                error: function(data) {
                    alert("erro no processo de acesso!");
                },
                success: function(data, textStatus, jqXHR) {
                    if (data == 1) {
                        $btn.removeClass("btn-danger").addClass("btn-success");
                    } else {
                        alert("ERRO ao incluir acesso!");
                    }
                }
            });
        } else {
            $.ajax({
                type: "POST",
                url: "./controle_adm.php",
                data: {acao: "tira_acesso", idApp: $btn.attr("id"), idUsuario: $("#id_usuario").val()},
                beforeSend: function() {
                },
                error: function(data) {
                    alert("erro no processo de acesso!");
                },
                success: function(data, textStatus, jqXHR) {
                    if (data == 1) {
                        $btn.removeClass("btn-success").addClass("btn-danger");
                    } else {
                        alert("ERRO ao incluir acesso!");
                    }
                }
            });
        }
    });
});