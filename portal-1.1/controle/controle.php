<?php

header("Content-Type: text/plain; charset=UTF-8", true);
require_once("../classes/Validacao.class.php");
require_once("../classes/base.class.php");
require_once("../classes/Usuario.class.php");
require_once("../classes/Menu.class.php");
require_once("../classes/Aplicacao.class.php");

extract($_POST);

if ($_POST['acao'] == 'entrar') {
    sleep(2);
    $validar = new Validacao();
    $validar->validar(addslashes($_POST['login']), addslashes($_POST['senha']));
} else if ($_POST['acao'] == 'sair') {
    $logout = new Validacao();
    $logout->logout();
} else if ($_POST['acao'] == 'ajuda') {
    sleep(2);
    $u = new Usuario();
    $u->extra_select = "WHERE login = '" . $_POST['login'] . "' and email = '" . $_POST['email'] . "'";
    $u->selecionaTudo($u);
    $rd = $u->retornaDados();
    if ($rd) {
        $id = $rd->id;
        $nome = $rd->login;
        $email = $rd->email;
        $data_envio = date('d/m/Y');
        $hora_envio = date('H:i:s');

        $resp = shell_exec("/var/local/PortalOSS/portalweb/reset.pl -i '$id' -m '$email'");
        echo $resp;
    } else {
        echo "nao_existe";
    }
} else if ($_POST['acao'] == 'mudasenha') {
    sleep(2);
    $t = (explode(",", $_POST['t']));
    $atualizar = new Usuario();
    $atualizar->valor_pk = $_POST['id'];
    $atualizar->setValor('senha', $_POST['senha']);
    $atualizar->delCampo('login');
    $atualizar->delCampo('nome');
    $atualizar->delCampo('email');
    $atualizar->delCampo('ativo');
    $atualizar->delCampo('chave');
    $atualizar->delCampo('dataInsert');
    $ret = $atualizar->atualizar($atualizar);
    echo $ret;
}
?>
