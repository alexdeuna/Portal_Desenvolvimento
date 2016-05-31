$(document).ready(function() {
    montaLista();
    function montaLista() {
        $.ajax({
            type: "POST",
            url: "../app/lista/controle/controle_lista.php",
            data: {acao: "listar"},
            beforeSend: function() {

            },
            error: function(data) {
                $('<p>' + data + '</p>').appendTo('nav');
            },
            success: function(data, textStatus, jqXHR) {
                $("#container_pass").append(data);
                $(function() {
//                $('#container_pass ul ul').css("display", "none");
                    $('#container_pass li').mouseover(function() {

                        $(this).not('#lista').addClass('list-group-item-info');
                    });
                    $('#container_pass li').mouseout(function() {

                        $(this).not('#lista').removeClass('list-group-item-info');
                    });
                    $('#container_pass li .abre').click(function(ev) {
                        nivel = $(this).parent().attr('nivel');
                        if (nivel == '1') {
                            $('ul ul').not($(this).parent().siblings('ul')).slideUp().removeClass('list-group-item-success');
                        }
                        if (nivel == '2') {
                            $('ul ul ul').not($(this).parent().siblings('ul')).slideUp().removeClass('list-group-item-success');
                        }
                        if (nivel == '3') {
                            $('ul ul ul ul').not($(this).parent().siblings('ul')).slideUp().removeClass('list-group-item-success');
                        }
                        $('#container_pass li').removeClass("list-group-item-success");
                        $(this).parent().siblings('ul').slideToggle();
                        $(this).parent().not('#lista').addClass("list-group-item-success");
                        ev.stopPropagation();
                    });
                });
//==================== EDITAR USUARIO
                $("#dialog-edita-usuario").dialog({
                    modal: true,
                    autoOpen: false,
                    open: function() {
                        //desabilita o topo, a barra da janela
                        $(".ui-widget-header").show();
                    },
                    height: 'auto',
                    width: 'auto',
                    show: {effect: "scale", duration: 300},
                    hide: {effect: "scale", duration: 300},
                    buttons: [
                        {
                            text: "Alterar",
                            click: function() {
                                $.ajax({
                                    type: "POST",
                                    url: "../app/lista/controle/controle_lista.php",
                                    data: {acao: "editar_usuario",
                                        UsuarioID: $("#SESSION_UsuarioID").val(),
                                        UsuarioLogin: $("#SESSION_UsuarioLogin").val(),
                                        UsuarioNome: $("#SESSION_UsuarioNome").val(),
                                        id_fornecedor: $("#nome_fornecedor").val(),
//                                    nome_fornecedor: $("#nome_fornecedor").text(),
                                        id_plataforma: $("#nome_plataforma").val(),
//                                    nome_plataforma: $("#nome_plataforma").text(),
                                        id_servidor: $("#id_servidor").val(),
                                        hostname: $("#hostname").val(),
                                        ip: $("#ip").val(),
                                        porta: $("#porta").val(),
                                        id_so: $("#nome_so").val(),
//                                    nome_so: $("#nome_so").text(),
                                        id_usuario: $("#id_usuario").val(),
                                        usuario: $("#usuario").val(),
                                        id_tipo: $("#nome_tipo").val(),
                                    tipo: $("#tipo").text(),
                                        senhaTMP: $("#senhaTMP").val(),
                                        senha1: $("#senha1").val(),
                                        senha2: $("#senha2").val(),
                                        senha3: $("#senha3").val(),
                                        descricao: $("#descricao").val()},
                                    beforeSend: function() {

                                    },
                                    error: function(data) {
                                        $('<p>' + data + '</p>').appendTo('nav');
                                    },
                                    success: function(data, textStatus, jqXHR) {
//                                    $("#container_pass").append(data);
                                        tr = $("#id_usuario" + $("#id_usuario").val());
                                        //  linha.css({"color": "red", "border": "2px solid red"});
                                        //alert(tr.children('td').attr('id'));
                                        alert ($("#tipo" + $("#id_usuario").select().attr("id")));
                                        $("#usuario" + $("#id_usuario").val()).text($("#usuario").val());
                                        $("#tipo" + $("#id_usuario").val()).text($("#tipo").text());
                                        $("#senha1" + $("#id_usuario").val()).text($("#senha1").val());
                                        $("#senha2" + $("#id_usuario").val()).text($("#senha1" + $("#id_usuario").text()));
                                        $("#senha3" + $("#id_usuario").val()).text($("#senha2" + $("#id_usuario").text()));
                                        //       $("#dialog-edita-usuario").dialog("close");
                                    }
                                });
                            }
                        },
                        {
                            text: "Fechar",
                            click: function() {
                                $(this).dialog("close");
                            }
                        }
                    ]
                }).on("dialogbeforeclose", function(e) {
                    $("#nome_fornecedor").children("option").remove("option");
                    $("#nome_plataforma").children("option").remove("option");
                    $("#nome_so").children("option").remove("option");
                    $("#nome_tipo").children("option").remove("option");
                });
                $("button[modal='btn_editar']").on("click", function() {
                    $("#dialog-edita-usuario").dialog("option", "position", {my: "right bottom", at: "right bottom", of: this});
                    $("#dialog-edita-usuario").dialog("open");
                    //$("#id_fornecedor").val($(this).attr('id_fornecedor'));
                    //$("#nome_fornecedor").append("<option></option>");
                    //$("#nome_fornecedor").children("option").text($(this).attr('nome_fornecedor')).val($(this).attr('id_fornecedor'));
                    $("#senhaTMP").val($(this).attr('senha1'));
//                alert($("#senhaTMP").val());
                    id_fornecedor = $(this).attr('id_fornecedor');
                    $.ajax({
                        type: "POST",
                        url: "../app/lista/controle/controle_lista.php",
                        data: {
                            acao: "select_fornecedor"
                        },
                        beforeSend: function() {

                        },
                        error: function(data) {
                            alert("ERRO SELECT FORNECEDOR");
                        },
                        success: function(data, textStatus, jqXHR) {
                            $("#nome_fornecedor").append(data);
                            $.each($("#nome_fornecedor").children("option"), function(key, value) {
                                //alert($(value).val()+"  "+$(this).attr('id_fornecedor'));
                                if ($(value).val() == id_fornecedor) {
                                    $(value).attr('selected', 'selected');
                                }
                            });
                        }
                    });
                    $("#nome_fornecedor").change(function() {
                        $("#nome_plataforma").children("option").remove("option");
                        PlataformaFornecedor(id_plataforma, $("#nome_fornecedor").val());
                    });
                    id_plataforma = $(this).attr('id_plataforma');
                    PlataformaFornecedor(id_plataforma, id_fornecedor);
                    function PlataformaFornecedor(id_plat, id_for) {
                        $.ajax({
                            type: "POST",
                            url: "../app/lista/controle/controle_lista.php",
                            data: {
                                acao: "select_fornecedor_plataforma", id: id_for
                            },
                            beforeSend: function() {

                            },
                            error: function(data) {
                                alert("ERRO SELECT PLATAFORMA");
                            },
                            success: function(data, textStatus, jqXHR) {
                                $("#nome_plataforma").append(data);
                                $.each($("#nome_plataforma").children("option"), function(key, value) {
                                    if ($(value).val() == id_plat) {
                                        $(value).attr('selected', 'selected');
                                    }
                                });
                            }
                        });
                    }
                    $("#id_servidor").val($(this).attr('id_servidor'));
                    $("#hostname").val($(this).attr('hostname'));
                    $("#ip").val($(this).attr('ip'));
                    $("#porta").val($(this).attr('porta'));
//                $("#id_so").val($(this).attr('id_so'));
//                $("#nome_so").append("<option></option>");
//                $("#nome_so").children("option").text($(this).attr('nome_so')).val($(this).attr('id_so'));
                    id_so = $(this).attr('id_so');
                    $.ajax({
                        type: "POST",
                        url: "../app/lista/controle/controle_lista.php",
                        data: {
                            acao: "select_so"
                        },
                        beforeSend: function() {

                        },
                        error: function(data) {
                            alert("ERRO SELECT SO");
                        },
                        success: function(data, textStatus, jqXHR) {
                            $("#nome_so").append(data);
                            $.each($("#nome_so").children("option"), function(key, value) {
                                if ($(value).val() == id_so) {
                                    $(value).attr('selected', 'selected');
                                }
                            });
                        }
                    });
                    $("#id_usuario").val($(this).attr('id_usuario'));
                    $("#usuario").val($(this).attr('usuario'));
//                $("#id_tipo").val($(this).attr('id_tipo'));
//                $("#tipo").append("<option></option>");
//                $("#tipo").children("option").text($(this).attr('tipo')).val($(this).attr('id_tipo'));
                    id_tipo = $(this).attr('id_tipo');
                    $.ajax({
                        type: "POST",
                        url: "../app/lista/controle/controle_lista.php",
                        data: {
                            acao: "select_tipo"
                        },
                        beforeSend: function() {

                        },
                        error: function(data) {
                            $('<p>' + data + '</p>').appendTo('nav');
                        },
                        success: function(data, textStatus, jqXHR) {
                            $("#nome_tipo").append(data);
                            $.each($("#nome_tipo").children("option"), function(key, value) {
                                if ($(value).val() == id_tipo) {
                                    $(value).attr('selected', 'selected');
                                }
                            });
                        }
                    });
                    $("#senha1").val($(this).attr('senha1'));
                    $("#senha2 ").val($(this).attr('senha2'));
                    $("#senha3").val($(this).attr('senha3'));
                    $("#descricao").val($(this).attr('descricao'));
                    $("#servidor_data_update").text($(this).attr('servidor_data_update'));
                    $("#servidor_log").text($(this).attr('servidor_log'));
                    $("#usuario_data_update").text($(this).attr('usuario_data_update'));
                    $("#usuario_log").text($(this).attr('usuario_log'));
                });

//==================== DETALHES USUARIO
                $("#dialog-detalhes-usuario").dialog({
                    modal: true,
                    autoOpen: false,
                    open: function() {
                        //desabilita o topo, a barra da janela
                        $(".ui-widget-header").show();
                    },
                    height: 'auto',
                    width: 'auto',
                    show: {effect: "scale", duration: 300},
                    hide: {effect: "scale", duration: 300},
                    buttons: [{text: "Fechar", click: function() {
                                $(this).dialog("close");
                            }}]
                });
                $("button[modal='btn_detalhes'").on("click", function() {
                    $("#dialog-detalhes-usuario").dialog("option", "position", {my: "right bottom", at: "right bottom", of: this});
                    $("#dialog-detalhes-usuario").dialog("open");
                    $("#d_nome_fornecedor").text($(this).attr('nome_fornecedor'));
                    $("#d_nome_plataforma").text($(this).attr('nome_plataforma'));
                    $("#d_hostname").text($(this).attr('hostname'));
                    $("#d_ip").text($(this).attr('ip'));
                    $("#d_porta").text($(this).attr('porta'));
                    $("#d_nome_so").text($(this).attr('nome_so'));
                    $("#d_usuario").text($(this).attr('usuario'));
                    $("#d_tipo").text($(this).attr('tipo'));
                    $("#d_descricao").text($(this).attr('descricao'));
                });
            }
        }
        );
    }
});