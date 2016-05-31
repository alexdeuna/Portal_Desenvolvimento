$pedido = new Pedido();
$pedido->setValor('idusuario',$_SESSION['UsuarioID']);
$servidor->delCampo('tipoDB');
$pedido->cadastrar($pedido);

$servidor = new Servidor();
$servidor->extra_select = "WHERE idServidor = $id";
$servidor->selecionaCampos($servidor);

while ($s = $servidor->retornaDados()) { 
    echo $s->nome_do_campo
}
  


$servidor = new Servidor();
$servidor->valor_pk = $_POST['id'];
$servidor->setValor('ip',$_POST['ip']);
$servidor->delCampo('senhaDB');
$servidor->atualizar($servidor);

$lista = new Lista();
$lista->valor_pk = $_POST['indice'];
$lista->deletar($lista)


<?php
//header("Content-Type: text/plain; charset=UTF-8", true);

extract($_POST);

//variaveis de sessão
$indicesServer = array('PHP_SELF',
    'argv',
    'argc',
    'GATEWAY_INTERFACE',
    'SERVER_ADDR',
    'SERVER_NAME',
    'SERVER_SOFTWARE',
    'SERVER_PROTOCOL',
    'REQUEST_METHOD',
    'REQUEST_TIME',
    'REQUEST_TIME_FLOAT',
    'QUERY_STRING',
    'DOCUMENT_ROOT',
    'HTTP_ACCEPT',
    'HTTP_ACCEPT_CHARSET',
    'HTTP_ACCEPT_ENCODING',
    'HTTP_ACCEPT_LANGUAGE',
    'HTTP_CONNECTION',
    'HTTP_HOST',
    'HTTP_REFERER',
    'HTTP_USER_AGENT',
    'HTTPS',
    'REMOTE_ADDR',
    'REMOTE_HOST',
    'REMOTE_PORT',
    'REMOTE_USER',
    'REDIRECT_REMOTE_USER',
    'SCRIPT_FILENAME',
    'SERVER_ADMIN',
    'SERVER_PORT',
    'SERVER_SIGNATURE',
    'PATH_TRANSLATED',
    'SCRIPT_NAME',
    'REQUEST_URI',
    'PHP_AUTH_DIGEST',
    'PHP_AUTH_USER',
    'PHP_AUTH_PW',
    'AUTH_TYPE',
    'PATH_INFO',
    'ORIG_PATH_INFO');

echo '<table cellpadding="10" border=1>';
foreach ($indicesServer as $arg) {
    if (isset($_SERVER[$arg])) {
        echo '<tr><td>' . $arg . '</td><td>' . $_SERVER[$arg] . '</td></tr>';
    } else {
        echo '<tr><td>' . $arg . '</td><td>-</td></tr>';
    }
}
echo '</table>';

$dados = array();
$dados['clientes'][] = array(
    'nome' => 'Fulano',
    'idade' => '30'
);
$dados['clientes'][] = array(
    'nome' => 'Ciclano',
    'idade' => '40'
);
$dados['clientes'][] = array(
    'nome' => 'Beltrano',
    'idade' => '50'
);
echo json_encode($dados);
?>
<html>
    <head>

        <title>jQuery.map demo</title>
        <style>
            div {
                color: blue;
            }
            p {
                color: green;
                margin: 0;
            }
            span {
                color: red;
            }
        </style>
        <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    </head>
    <body>

        <div> </div>
        <p> </p>
        <span> </span>

        <script>
            var arr = ["a", "b", "c", "d", "e"];
            $("div").text(arr.join("- "));

            arr = jQuery.map(arr, function(n, i) {
                return (n.toUpperCase() + i);
            });
            $("p").text(arr.join("-- "));

            arr = jQuery.map(arr, function(a) {
                return a + a;
            });
            $("span").text(arr.join("--- "));

            $.ajax({
                type: "POST",
                url: "exemplo2.php",
                dataType: "json",
                success: function(json) {
                    //Laço de repetição para iterar no array
                    $.each(json.clientes, function(key, value) {
                        alert(value.nome + " - " + value.idade);
                    });
                }
            });
        </script>

    </body>
</html>