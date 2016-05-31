<?php

require_once("classes/Validacao.class.php");

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

?>
