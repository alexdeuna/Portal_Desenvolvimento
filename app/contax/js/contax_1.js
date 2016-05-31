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
    getSelect("reclamacao");
    getSelect("ping");
    getSelect("como_resolvido", $perfil);
    getSelect("foi_resolvido");

    $("#cadastrar, .reclamacao, .evento_reparo, .obs, .alinhado_cci, .foi_resolvido, .parametro_cci, .como_resolvido, .csc_funcionando, .listado_csc, .alinhado_csc, \n\
                .modelo_diferente, .dispositivos_conectados, \n\
                .dispositivos_conectados, .ping").hide();
    if ($perfil == "controle") {
        $(".csc_funcionando, .listado_csc, .alinhado_csc, \n\
                .modelo_diferente, .dispositivos_conectados, \n\
                .dispositivos_conectados, .ping").remove();
    }

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
            $("input[name=alinhado_cci]").attr("disabled", true).prop('checked', false);
            $("input[name=parametro_cci]").attr("disabled", true).prop('checked', false);
            if ($perfil == "piloto") {
                $("input[name=csc_funcionando]").attr("disabled", true).prop('checked', false);
                $("input[name=listado_csc]").attr("disabled", true).prop('checked', false);
                $("input[name=alinhado_csc]").attr("disabled", true).prop('checked', false);
                $("input[name=modelo_diferente]").attr("disabled", true).prop('checked', false);
                $("input[name=dispositivos_conectados]").attr("disabled", true).prop('checked', false);
                $("#ping").attr("disabled", "disabled").val("0");
            }
            $("#como_resolvido").attr("disabled", "disabled").val("0");
            $("#foi_resolvido").attr("disabled", "disabled").val("0");
        }
    })


    $("#evento_reparo").on("change", function() {
        if ($(this).val() == "n") {
            $("input[name=alinhado_cci]").attr("disabled", false).filter("[value='s']").prop("checked", true);
            $("input[name=parametro_cci]").attr("disabled", false).filter("[value='s']").prop("checked", true);
            if ($perfil == "piloto") {
                $("input[name=csc_funcionando]").attr("disabled", false).filter("[value='s']").prop("checked", true);
                $("input[name=listado_csc]").attr("disabled", false).filter("[value='s']").prop("checked", true);
                $("input[name=alinhado_csc]").attr("disabled", false).filter("[value='s']").prop("checked", true);
                $("input[name=modelo_diferente]").attr("disabled", false).filter("[value='s']").prop("checked", true);
                $("input[name=dispositivos_conectados]").attr("disabled", false).filter("[value='s']").prop("checked", true);
                $("#ping").removeAttr("disabled").val(1);
            }
            $("#como_resolvido").removeAttr("disabled").val(1);
            $("#foi_resolvido").removeAttr("disabled").val(1);
        } else {
            $("input[name=alinhado_cci]").attr("disabled", true).prop('checked', false);
            $("input[name=parametro_cci]").attr("disabled", true).prop('checked', false);
            if ($perfil == "piloto") {
                $("input[name=csc_funcionando]").attr("disabled", true).prop('checked', false);
                $("input[name=listado_csc]").attr("disabled", true).prop('checked', false);
                $("input[name=alinhado_csc]").attr("disabled", true).prop('checked', false);
                $("input[name=modelo_diferente]").attr("disabled", true).prop('checked', false);
                $("input[name=dispositivos_conectados]").attr("disabled", true).prop('checked', false);
                $("#ping").attr("disabled", "disabled").val('');
            }
            $("#como_resolvido").attr("disabled", "disabled").val('');
            $("#foi_resolvido").attr("disabled", "disabled").val('');
        }
    });
    $("#alinhado_cci_Nao").click(function() {
        $("input[name=parametro_cci]").attr("disabled", true).prop('checked', false);
        if ($perfil == "piloto") {
            $("input[name=csc_funcionando]").attr("disabled", true).prop('checked', false);
            $("input[name=listado_csc]").attr("disabled", true).prop('checked', false);
            $("input[name=alinhado_csc]").attr("disabled", true).prop('checked', false);
            $("input[name=modelo_diferente]").attr("disabled", true).prop('checked', false);
            $("input[name=dispositivos_conectados]").attr("disabled", true).prop('checked', false);
            $("#ping").attr("disabled", "disabled").val("null");
        }
        $("#como_resolvido").attr("disabled", "disabled").val("null");
    })
    $("#alinhado_cci_Sim").click(function() {
        $("input[name=parametro_cci]").attr("disabled", false).filter("[value='s']").prop("checked", true);
        if ($perfil == "piloto") {
            $("input[name=csc_funcionando]").attr("disabled", false).filter("[value='s']").prop("checked", true);
            $("input[name=listado_csc]").attr("disabled", false).filter("[value='s']").prop("checked", true);
            $("input[name=alinhado_csc]").attr("disabled", false).filter("[value='s']").prop("checked", true);
            $("input[name=modelo_diferente]").attr("disabled", false).filter("[value='s']").prop("checked", true);
            $("input[name=dispositivos_conectados]").attr("disabled", false).filter("[value='s']").prop("checked", true);
            $("#ping").removeAttr("disabled").val(1);
        }
        $("#como_resolvido").removeAttr("disabled").val(1);
    })


    $("#parametro_cci_Nao").click(function() {
        if ($perfil == "piloto") {
            $("input[name=csc_funcionando]").attr("disabled", true).prop('checked', false);
            $("input[name=listado_csc]").attr("disabled", true).prop('checked', false);
            $("input[name=alinhado_csc]").attr("disabled", true).prop('checked', false);
            $("input[name=modelo_diferente]").attr("disabled", true).prop('checked', false);
            $("input[name=dispositivos_conectados]").attr("disabled", true).prop('checked', false);
            $("#ping").attr("disabled", "disabled").val("null");
        }
        $("#como_resolvido").attr("disabled", "disabled").val("null");
    })
    $("#parametro_cci_Sim").click(function() {
        if ($perfil == "piloto") {
            $("input[name=csc_funcionando]").attr("disabled", false).filter("[value='s']").prop("checked", true);
            $("input[name=listado_csc").attr("disabled", false).filter("[value='s']").prop("checked", true);
            $("input[name=alinhado_csc]").attr("disabled", false).filter("[value='s']").prop("checked", true);
            $("input[name=modelo_diferente]").attr("disabled", false).filter("[value='s']").prop("checked", true);
            $("input[name=dispositivos_conectados]").attr("disabled", false).filter("[value='s']").prop("checked", true);
            $("#ping").removeAttr("disabled").val(1);
        }
        $("#como_resolvido").removeAttr("disabled").val(1);
    })

    $("#csc_funcionando_Nao").click(function() {
        $("input[name=listado_csc").attr("disabled", true).prop('checked', false);
        $("input[name=alinhado_csc").attr("disabled", true).prop('checked', false);
        $("input[name=modelo_diferente").attr("disabled", true).prop('checked', false);
        $("input[name=dispositivos_conectados").attr("disabled", true).prop('checked', false);
        $("#ping").attr("disabled", "disabled").val("null");
        $("#como_resolvido").attr("disabled", "disabled").val("null");
    })
    $("#csc_funcionando_Sim").click(function() {
        $("input[name=listado_csc").attr("disabled", false).filter("[value='s']").prop("checked", true);
        $("input[name=alinhado_csc").attr("disabled", false).filter("[value='s']").prop("checked", true);
        $("input[name=modelo_diferente").attr("disabled", false).filter("[value='s']").prop("checked", true);
        $("input[name=dispositivos_conectados").attr("disabled", false).filter("[value='s']").prop("checked", true);
        $("#ping").removeAttr("disabled").val(1);
        $("#como_resolvido").removeAttr("disabled").val(1);
    })


    $("#listado_csc_Nao").click(function() {
        $("input[name=alinhado_csc]").attr("disabled", true).prop('checked', false);
        $("input[name=modelo_diferente]").attr("disabled", true).prop('checked', false);
        $("input[name=dispositivos_conectados]").attr("disabled", true).prop('checked', false);
        $("#ping").attr("disabled", "disabled]").val("null");
        $("#como_resolvido").attr("disabled", "disabled").val("null");
    })
    $("#listado_csc_Sim").click(function() {
        $("input[name=alinhado_csc]").attr("disabled", false).filter("[value='s']").prop("checked", true);
        $("input[name=modelo_diferente]").attr("disabled", false).filter("[value='s']").prop("checked", true);
        $("input[name=dispositivos_conectados]").attr("disabled", false).filter("[value='s']").prop("checked", true);
        $("#ping").removeAttr("disabled").val(1);
        $("#como_resolvido").removeAttr("disabled").val(1);
    })

    $("#alinhado_csc_Nao").click(function() {
        $("input[name=dispositivos_conectados]").attr("disabled", true).prop('checked', false);
        $("#ping").attr("disabled", "disabled").val("null");
        $("#como_resolvido").attr("disabled", "disabled").val("null");
    })
    $("#alinhado_csc_Sim").click(function() {
        $("input[name=dispositivos_conectados]").attr("disabled", false).filter("[value='s']").prop("checked", true);
        $("#ping").removeAttr("disabled").val(1);
        $("#como_resolvido").removeAttr("disabled").val(1);
    })

    $("#cadastrar").click(function() {
        alert($("#ping").val());
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
                alert("OK");
            }
        });
    });
});