$(document).ready(function() {
    $login = $("#SESSION_UsuarioLogin").val();
    $operador = $("#SESSION_UsuarioNome").val();
    $perfil = $("#SESSION_UsuarioPerfil").val();
    $ip = $("#SESSION_UsuarioIP").val();
    var SPMaskBehavior = function(val) {
        return val.replace(/\D/g, '').length === 11 ? '(00)0000-0000' : '(00)0000-00009';
    },
            spOptions = {onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };
    $("#terminal").mask(SPMaskBehavior, spOptions);
    $("#obs").on("input", function() {
        var limite = 500;
        var caracteresDigitados = $(this).val().length;
        var caracteresRestantes = limite - caracteresDigitados;
        $("#caracteres").text(caracteresRestantes);
    });
    function getSelect(val, perfil) {
        $.ajax({
            type: "POST",
            url: "../app/contax/controle/controle.php",
            data: {acao: val, perfil: perfil},
            beforeSend: function() {
            },
            error: function(data) {
                alert("Erro ao carregar " + val);
            },
            success: function(data, textStatus, jqXHR) {
                $("#" + val).append(data);
            }
        });
    }

    function disabledTrue(campo) {
        $("input[name=" + campo + "]").attr("disabled", true).prop('checked', false);
    }
    function disabledFalse(campo) {
        $("input[name=" + campo + "]").attr("disabled", false).filter("[value='s']").prop("checked", true);
    }

    function disabled(campo, valor) {
        if (valor) {
            ($perfil == "piloto") ? valor = "Troca do DNS" : valor = "Wizard Oi";
            (campo != "como_resolvido") ? valor = 1 : valor;
            $("#" + campo).removeAttr("disabled").val(valor);
        } else {
            $("#" + campo).attr("disabled", "disabled").val("");
        }
    }

    function inicio() {

        $.ajax({
            type: "POST",
            url: "../app/contax/controle/controle.php",
            data: {acao: "total_preenchido", login: $login, },
            beforeSend: function() {
            },
            error: function(data) {
                alert("Erro ao carregar Valor Preenchido");
            },
            success: function(data, textStatus, jqXHR) {
                alert(data);
                $(".total_preenchido").text("Total de formulários: " + data);
            }
        });

        $("#terminal").val('').focus();
        $("#cadastrar, .reclamacao, .evento_reparo, .obs, .alinhado_cci, \n\
            .foi_resolvido, .parametro_cci, .como_resolvido, .csc_funcionando, \n\
            .listado_csc, .alinhado_csc, \n\
            .modelo_diferente, .dispositivos_conectados, \n\
            .dispositivos_conectados, .ping").hide();
        if ($perfil == "controle") {
            $(".csc_funcionando, .listado_csc, .alinhado_csc, \n\
                .modelo_diferente, .dispositivos_conectados, \n\
                .dispositivos_conectados, .ping").remove();
        }
    }

    getSelect("reclamacao");
    getSelect("ping");
    getSelect("como_resolvido", $perfil);
    getSelect("foi_resolvido");
    inicio();

    $("#terminal").on("keyup", function() {
        if ($("#terminal").val().length < '13') {
            $("#cadastrar, .reclamacao, .evento_reparo, .obs, .alinhado_cci, .foi_resolvido, .parametro_cci, .como_resolvido").hide();
            if ($perfil == "piloto") {
                $(".csc_funcionando, .listado_csc, .alinhado_csc, \n\
                .modelo_diferente, .dispositivos_conectados, \n\
                .dispositivos_conectados, .ping").hide();
            }
        } else {
            $("#cadastrar, .reclamacao, .evento_reparo, .obs, .alinhado_cci, .foi_resolvido, .parametro_cci, .como_resolvido, .csc_funcionando, .listado_csc, .alinhado_csc, \n\
                .modelo_diferente, .dispositivos_conectados, \n\
                .dispositivos_conectados, .ping").show();
            disabledTrue("alinhado_cci");
            disabledTrue("parametro_cci");
            if ($perfil == "piloto") {
                disabledTrue("csc_funcionando");
                disabledTrue("listado_csc");
                disabledTrue("alinhado_csc");
                disabledTrue("modelo_diferente");
                disabledTrue("dispositivos_conectados");
                disabled("ping");
            }
            disabled("como_resolvido");
            disabled("foi_resolvido");
        }
    })
    $("#evento_reparo").on("change", function() {
        if ($(this).val() == "n") {
            disabledFalse("alinhado_cci");
            disabledFalse("parametro_cci");
            if ($perfil == "piloto") {
                disabledFalse("csc_funcionando");
                disabledFalse("listado_csc");
                disabledFalse("alinhado_csc");
                disabledFalse("modelo_diferente");
                disabledFalse("dispositivos_conectados");
                disabled("ping", 1);
            }
            disabled("como_resolvido", 1);
            disabled("foi_resolvido", 1);
        } else {
            disabledTrue("alinhado_cci");
            disabledTrue("parametro_cci");
            if ($perfil == "piloto") {
                disabledTrue("csc_funcionando");
                disabledTrue("listado_csc");
                disabledTrue("alinhado_csc");
                disabledTrue("modelo_diferente");
                disabledTrue("dispositivos_conectados");
                disabled("ping");
            }
            disabled("como_resolvido");
            disabled("foi_resolvido");
        }
    });
    $("#alinhado_cci_Nao").click(function() {
        disabledTrue("parametro_cci");
        if ($perfil == "piloto") {
            disabledTrue("csc_funcionando");
            disabledTrue("listado_csc");
            disabledTrue("alinhado_csc");
            disabledTrue("modelo_diferente");
            disabledTrue("dispositivos_conectados");
            disabled("ping");
        }
        disabled("como_resolvido");
    })
    $("#alinhado_cci_Sim").click(function() {
        disabledFalse("parametro_cci");
        if ($perfil == "piloto") {
            disabledFalse("csc_funcionando");
            disabledFalse("listado_csc");
            disabledFalse("alinhado_csc");
            disabledFalse("modelo_diferente");
            disabledFalse("dispositivos_conectados");
            disabled("ping", 1);
        }
        disabled("como_resolvido", 1);
    })

    $("#parametro_cci_Nao").click(function() {
        if ($perfil == "piloto") {
            disabledTrue("csc_funcionando");
            disabledTrue("listado_csc");
            disabledTrue("alinhado_csc");
            disabledTrue("modelo_diferente");
            disabledTrue("dispositivos_conectados");
            disabled("ping");
        }
        disabled("como_resolvido");
    })
    $("#parametro_cci_Sim").click(function() {
        if ($perfil == "piloto") {
            disabledFalse("csc_funcionando");
            disabledFalse("listado_csc");
            disabledFalse("alinhado_csc");
            disabledFalse("modelo_diferente");
            disabledFalse("dispositivos_conectados");
            disabled("ping", 1);
        }
        disabled("como_resolvido", 1);
    })

    $("#csc_funcionando_Nao").click(function() {
        disabledTrue("listado_csc");
        disabledTrue("alinhado_csc");
        disabledTrue("modelo_diferente");
        disabledTrue("dispositivos_conectados");
        disabled("ping");
        disabled("como_resolvido");
    })
    $("#csc_funcionando_Sim").click(function() {
        disabledFalse("listado_csc");
        disabledFalse("alinhado_csc");
        disabledFalse("modelo_diferente");
        disabledFalse("dispositivos_conectados");
        disabled("ping", 1);
        disabled("como_resolvido", 1);
    })


    $("#listado_csc_Nao").click(function() {
        disabledTrue("alinhado_csc");
        disabledTrue("modelo_diferente");
        disabledTrue("dispositivos_conectados");
        disabled("ping");
        disabled("como_resolvido");
    })
    $("#listado_csc_Sim").click(function() {
        disabledFalse("alinhado_csc");
        disabledFalse("modelo_diferente");
        disabledFalse("dispositivos_conectados");
        disabled("ping", 1);
        disabled("como_resolvido", 1);
    })

    $("#alinhado_csc_Nao").click(function() {
        disabledTrue("dispositivos_conectados");
        disabled("ping");
        disabled("como_resolvido");
    })
    $("#alinhado_csc_Sim").click(function() {
        disabledFalse("dispositivos_conectados");
        disabled("ping", 1);
        disabled("como_resolvido", 1);
    })

    $("#cadastrar").click(function() {
//        alert($("input[name=alinhado_cci]:checked", "#f").val());
        $como_resolvido = '';
        if ($("#como_resolvido").val()) {
            $.each($("#como_resolvido").val(), function(index, val) {
                $como_resolvido = val + ', ' + $como_resolvido;
            });
        }
        $.ajax({
            type: "POST",
            url: "../app/contax/controle/controle.php",
            data: {acao: "cadastrar",
                perfil: $perfil,
                operador: $operador,
                login: $login,
                ip: $ip,
                terminal: $("#terminal").val(),
                id_reclamacao: $("#reclamacao").val(),
                evento_reparo: $("#evento_reparo").val(),
                alinhado_cci: $("input[name=alinhado_cci]:checked", "#f").val(),
                parametro_cci: $("input[name=parametro_cci]:checked", "#f").val(),
                csc_funcionando: $("input[name=csc_funcionando]:checked", "#f").val(),
                listado_csc: $("input[name=listado_csc]:checked", "#f").val(),
                alinhado_csc: $("input[name=alinhado_csc]:checked", "#f").val(),
                modelo_diferente: $("input[name=modelo_diferente]:checked", "#f").val(),
                dispositivos_conectados: $("input[name=dispositivos_conectados]:checked", "#f").val(),
                ping: $("#ping").val(),
                foi_resolvido: $("#foi_resolvido").val(),
                como_resolvido: $como_resolvido,
                obs: $("#obs").val()
            },
            beforeSend: function() {
            },
            error: function(data) {
                alert("Erro ao carregar " + data);
            },
            success: function(data, textStatus, jqXHR) {
                alert(data);
                inicio();
            }
        });
    });
});