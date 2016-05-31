$(document).ready(function() {
    $.ajax({
        type: "POST",
        url: "../../portalapp/lista/controle/controle_lista.php",
        data: {acao: "listar"},
        beforeSend: function() {

        },
        error: function(data) {
            $('<p>' + data + '</p>').appendTo('nav');
        },
        success: function(data, textStatus, jqXHR) {
            $("#container_pass").append(data);

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