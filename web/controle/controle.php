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
} else if ($_POST['acao'] == 'menu') {
    //  header("Content-Type: text/html; charset=UTF-8", true);
    //  require_once("./classes/Validacao.class.php");
    $s = new Validacao();
    $s->verifica(12000);
    $m = "<input type='hidden' id='userid' value='" . $_SESSION['UsuarioID'] . "'>";
    $m .= "<input type='hidden' id='usuariologin' value='" . $_SESSION['UsuarioLogin'] . "'>";
    $m .= "<input type='hidden' id='usuarionome' value='" . $_SESSION['UsuarioNome'] . "'>";
    foreach ($_SESSION['Menu'] as $v1) {
        if ($v1->idPai == 0) {
            if ($v1->separador == 'n') {
                $m .= "<li role='presentation'><a desc='" . $v1->descricao . "' value = '" . $v1->pasta . "' onclick='divNone()'>" . $v1->nome . "</a></li>";
            } else {
                $m .= "<li role='presentation' class='dropdown'>"
                        . "<a class='dropdown-toggle' data-toggle='dropdown' role='button' aria-expanded='false' tipo='" . $v1->separador . "'  value = '" . $v1->pasta . "' >"
                        . $v1->nome . "<span class='caret'>"
                        . "</span>"
                        . "</a> <ul class='dropdown-menu' role='menu'>";
                foreach ($_SESSION['Menu'] as $v2) {
                    if ($v2->idPai == $v1->id) {
                        //echo "<li role = 'presentation'><a href = '#'>" . $v1->id . $v1->idPai . $v1->nome . "</a></li >";
                        $m .= "<li><a desc='" . $v2->descricao . "' value = '" . $v2->pasta . "' onclick='divNone()'>" . $v2->nome . "</a></li>";
                    }
                }
                $m .= "</ul>";
            }
        }
    }
    echo $m;
} else if ($_POST['acao'] == "app") {
    
}
