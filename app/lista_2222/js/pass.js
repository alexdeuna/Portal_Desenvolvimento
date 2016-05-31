$(document).ready(function() {
    $layout = "<ul class='list-group' tipo='fornecedor'> \n\
        <li class='list-group-item'  nivel='1'>\n\
            <span></span>\n\
            <button type='button' class='btn btn-primary' tipo = 'fornecedor'>\n\
                <span class='glyphicon glyphicon-edit'></span>\n\
            </button>\n\
        </li>\n\
        <ul class='list-group-item' tipo='plataforma'>\n\
            <li class='list-group-item'  nivel='2' id='plataforma'>\n\
                <span></span>\n\
                <button type='button' class='btn btn-danger' tipo = 'btn_remove_plataforma'>\n\
                    <span class='glyphicon  glyphicon-remove'></span>\n\
                </button>\n\
                <button type='button' class='btn btn-primary' tipo = 'btn_altera_plataforma'>\n\
                    <span class='glyphicon glyphicon-pencil'></span>\n\
                </button>\n\
            </li>\n\
            <ul class='list-group-item' tipo='servidor'>\n\
                <li class='list-group-item' nivel='3' id='servidor'>\n\
                    <span></span>\n\
                    <button type='button' class='btn btn-danger' tipo = 'btn_remove_plataforma'>\n\
                        <span class='glyphicon  glyphicon-remove'></span>\n\
                    </button>\n\
                    <button type='button' class='btn btn-primary' tipo = 'btn_altera_plataforma'>\n\
                        <span class='glyphicon glyphicon-pencil'></span>\n\
                    </button>\n\
                </li>\n\
                <ul class='list-group-item' tipo='usuario'>\n\
                    <li class='list-group-item' id='lista'>\n\
                        <div>\n\
                            <table class='table table-hover'>\n\
                                <thead>\n\
                                    <tr>\n\
                                        <th>Usuário</th>\n\
                                        <th>Atual</th>\n\
                                        <th>Anterior</th>\n\
                                        <th>Antiga</th>\n\
                                        <th>Descrição</th>\n\
                                        <th></th>\n\
                                        <th></th>\n\
                                    </tr>\n\
                                </thead>\n\
                                <tbody>\n\
                                    <tr>\n\
                                        <td id='usuario'></td>\n\
                                        <td>$senha1</td>\n\
                                        <td>$senha2</td>\n\
                                        <td>$senha3</td>\n\
                                        <td>$desc</td>\n\
                                        <td>\n\
                                            <button type='button' class='btn btn-primary' tipo = 'btn_edita_usuario'>\n\
                                                <span class='glyphicon glyphicon-edit'>\n\
                                                </span>\n\
                                            </button>\n\
                                        </td>\n\
                                        <td>\n\
                                            <button type='button' class='btn btn-danger' tipo = 'btn_exclui_usuario'>\n\
                                                <span class='glyphicon glyphicon-trash'>\n\
                                                </span>\n\
                                            </button>\n\
                                        </td>\n\
                                    </tr>\n\
                                </tbody>\n\
                            </table>\n\
                        </div>\n\
                    </li>\n\
                </ul>\n\
            </ul>\n\
        </ul>\n\
    </ul>";
    $.ajax({
        type: "POST",
        url: "../../portalapp/lista/controle/controle_lista.php",
        dataType: "json",
        data: {acao: "listar"},
        beforeSend: function() {

        },
        error: function(data) {
            $('<p>' + data + '</p>').appendTo('nav');
        },
        success: function(data, textStatus, jqXHR) {
//            $("#container_pass").append(data);

            $forn = [];

            $.each(data, function(index, value) {
                if ($.inArray(value.nome_fornecedor, $forn) === -1) {
                    $forn.push(value.nome_fornecedor);
                }
            });
            $.each($forn, function(key, value) {
                $("#container_pass").append($layout);
                $("#container_pass > ul > li > span").last().append(value);
                
            });

//            $.each(data, function(key, value) {
//                $("#container_pass").append(
//                        value.nome_fornecedor + ' ' +
//                        value.id_fornecedor + ' ' +
//                        value.plataforma.nome_plataforma + ' ' +
//                        value.plataforma.id_plataforma + ' ' +
//                        value.plataforma.servidor.nome_servidor + ' ' +
//                        value.plataforma.servidor.ip + ' ' +
//                        value.plataforma.servidor.porta + ' ' +
//                        value.plataforma.servidor.so + ' ' +
//                        value.plataforma.servidor.id_so + ' ' +
//                        value.plataforma.servidor.usuario + ' ' +
//                        value.plataforma.servidor.id_usuario + ' ' +
//                        value.plataforma.servidor.tipo + ' ' +
//                        value.plataforma.servidor.id_tipo + ' ' +
//                        value.plataforma.servidor.senha1 + ' ' +
//                        value.plataforma.servidor.senha2 + ' ' +
//                        value.plataforma.servidor.senha3 + ' ' +
//                        value.plataforma.servidor.desc + '<br>');
//                $("#container_pass").append(layout);
            //      if ($("#container_pass ul").attr('tipo') == 'fornecedor') {
//                    alert($("#container_pass ul").before().text());
//                    if ($("#container_pass ul").children("li span").text() == '') {
//                    $("#container_pass ul").last().children("li").children("span").append(value.nome_fornecedor);
//                    }
            //    }
//                $("#container_pass ul").each(function() {
//                    if ($(this).attr('tipo') == 'fornecedor') {
//                        alert($(this).children("li").siblings().children("span").text());
//                        if ($(this).children("li").siblings().children("span").text() == value.nome_fornecedor) {
//                            $("#container_pass").append(layout);
//                            $(this).children("li").children("span").text(value.nome_fornecedor);
//                            $(this).parent().append("<ul class='list-group' tipo='fornecedor'> <li class='list-group-item'  nivel='1'>\n\
//                                                <span></span>\n\
//                                                <button type='button' class='btn btn-primary' tipo = 'fornecedor'>\n\
//                                                    <span class='glyphicon glyphicon-edit'></span>\n\
//                                                </button>\n\
//                                            </li></ul>");
//                        } else{
//                            alert($(this).children("li").children("span").text());
//                            $(this).children("li").children("span").append(value.nome_fornecedor);
//                        }
//                    } else if ($(this).attr('tipo') == 'plataforma') {
//                        if ($(this).children("li").children("span").text() == '') {
//                            $(this).children("li").children("span").text(value.plataforma.nome_plataforma);
//                            $(this).parent().append("<ul class='list-group-item' tipo='plataforma'> <li class='list-group-item'  nivel='2'>\n\
//                                                <span></span>\n\
//                                                <button type='button' class='btn btn-primary' tipo = 'plataforma'>\n\
//                                                    <span class='glyphicon glyphicon-edit'></span>\n\
//                                                </button>\n\
//                                            </li></ul>");
//                        }
//                    } else if ($(this).attr('tipo') == 'servidor') {
//                        $(this).children("li").append(value.plataforma.servidor.nome_servidor);
//                    } else if ($(this).attr('tipo') == 'usuario') {
//                        $("#usuario").append(value.plataforma.servidor.usuario);
//                    }
//                });
//            });

            $(function() {
                $('#container_pass ul ul').css("display", "none");
                $('#container_pass li').mouseover(function() {

                    $(this).not('#lista').addClass('list-group-item-info');
                });
                $('#container_pass li').mouseout(function() {

                    $(this).not('#lista').removeClass('list-group-item-info');
                });
                $('#container_pass li').click(function(ev) {
                    nivel = $(this).attr('nivel');
                    if (nivel == '1') {
                        $('ul ul').not($(this).siblings('ul')).slideUp().removeClass('list-group-item-success');
                    }
                    if (nivel == '2') {
                        $('ul ul ul').not($(this).siblings('ul')).slideUp().removeClass('list-group-item-success');
                    }
                    if (nivel == '3') {
                        $('ul ul ul ul').not($(this).siblings('ul')).slideUp().removeClass('list-group-item-success');
                    }
                    $('#container_pass li').removeClass("list-group-item-success");
                    $(this).siblings('ul').slideToggle();
                    $(this).not('#lista').addClass("list-group-item-success");
                    ev.stopPropagation();
                });
            });
            $('#container_pass button').css({"float": "right",
                //  'display': 'inline-block',
                // 'min-width': '15px',
                'padding': '3px 7px',
                'font-size': '12px',
                'line-height': '1',
                'text-align': 'center',
                'white-space': 'nowrap',
                'vertical-align': 'baseline',
                'border-radius': '5px'}
            ).click(function() {
                $plataforma = $(this).attr('plataforma');
                $fornecedor = $(this).attr('fornecedor');
                $id_usuario = $(this).attr('id_usuario');
                $id_plataforma = $(this).attr('id_plataforma');
                $id_servidor = $(this).attr('id_servidor');
                $id_tipo_usuario = $(this).attr('id_tipo_usuario');
                $hostname = $(this).attr('hostname');
                $ip = $(this).attr('ip');
                $porta = $(this).attr('porta');
                $so = $(this).attr('so');
                $usuario = $(this).attr('usuario');
                $senha1 = $(this).attr('senha1');
                $senha2 = $(this).attr('senha2');
                $senha3 = $(this).attr('senha3');
                $desc = $(this).attr('desc');
                $.ajax({
                    type: "POST",
                    url: "../../portalapp/lista/controle/controle_lista.php",
                    data: {acao: "editar", plataforma: $plataforma, fornecedor: $fornecedor, id_usuario: $id_usuario,
                        id_plataforma: $id_plataforma,
                        id_servidor: $id_servidor,
                        id_tipo_usuario: $id_tipo_usuario,
                        hostname: $hostname,
                        ip: $ip,
                        porta: $porta,
                        so: $so,
                        usuario: $usuario,
                        senha1: $senha1,
                        senha2: $senha2,
                        senha3: $senha3,
                        desc: $desc},
                    beforeSend: function() {

                    },
                    error: function(data) {
                        $('<p>' + data + '</p>').appendTo('nav');
                    },
                    success: function(data, textStatus, jqXHR) {

                    }
                });
            });
        }
    });
});