<?php

header("Content-Type: text/plain; charset=UTF-8", true);
require_once("../classes/Validacao.class.php");
require_once("../classes/base.class.php");
require_once("../classes/Usuario.class.php");
require_once("../classes/Menu.class.php");
require_once("../classes/Aplicacao.class.php");

extract($_POST);
if ($_POST['acao'] == 'entrar') {
    $validar = new Validacao();
    $validar->validar(addslashes($_POST['login']), addslashes($_POST['senha']));
} else if ($_POST['acao'] == 'sair') {
    $logout = new Validacao();
    $logout->logout();
}
?>