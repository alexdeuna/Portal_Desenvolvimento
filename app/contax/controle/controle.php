<?php

header("Content-Type: text/plain; charset=UTF-8", true);

require_once("../classes/Acao.class.php");
require_once("../classes/Formulario.class.php");
require_once("../classes/Ping.class.php");
require_once("../classes/Reclamacao.class.php");
require_once("../classes/Resolvido.class.php");
require_once("../classes/banco.class.php");
require_once("../classes/base.class.php");

extract($_POST);

if ($_POST['acao'] == 'reclamacao') {
    $rec = new Reclamacao();
    $rec->selecionaTudo($rec);
    while ($r = $rec->retornaDados()) {
        $resp.="<option value=$r->id>$r->tipo</option>";
    }
    echo $resp;
} else if ($_POST['acao'] == 'foi_resolvido') {
    $res = new Resolvido();
    $res->selecionaTudo($res);
    while ($r = $res->retornaDados()) {
        $resp.="<option value=$r->id>$r->texto</option>";
    }
    echo $resp;
} else if ($_POST['acao'] == "ping") {
    $ping = new Ping();
    $ping->selecionaTudo($ping);
    while ($p = $ping->retornaDados()) {
        $resp.="<option value=$p->id>$p->texto</option>";
    }
    echo $resp;
} else if ($_POST['acao'] == "como_resolvido") {
    $como = new Acao();
    $como->extra_select = "where perfil = '" . $_POST['perfil'] . "'";
    $como->selecionaTudo($como);
    while ($c = $como->retornaDados()) {
        $resp.="<option value='" . $c->tipo . "'>$c->tipo</option>";
    }
    echo $resp;
} else if ($_POST['acao'] == "cadastrar") {
    $f = new Formulario();
    $f->setValor('perfil', $_POST['perfil']);
    $f->setValor('operador', $_POST['operador']);
    $f->setValor('login', $_POST['login']);
    $f->setValor('ip', $_POST['ip']);
    $f->setValor('terminal', $_POST['terminal']);
    $f->setValor('id_reclamacao', $_POST['id_reclamacao']);
    $f->setValor('evento_reparo', $_POST['evento_reparo']);
    $f->setValor('alinhado_cci', $_POST['alinhado_cci']);
    $f->setValor('parametro_cci', $_POST['parametro_cci']);
    $f->setValor('csc_funcionando', $_POST['csc_funcionando']);
    $f->setValor('listado_csc', $_POST['listado_csc']);
    $f->setValor('alinhado_csc', $_POST['alinhado_csc']);
    $f->setValor('modelo_diferente', $_POST['modelo_diferente']);
    $f->setValor('dispositivos_conectados', $_POST['dispositivos_conectados']);
    $f->setValor('id_ping', $_POST['ping']);
    $f->setValor('acao', $_POST['como_resolvido']);
    $f->setValor('id_resolvido', $_POST['foi_resolvido']);
    $f->setValor('obs', $_POST['obs']);
    $f->delCampo('datahora');
    $f->cadastrar($f);
    echo "Cadsatrado!";
} else if ($_POST['acao'] == "total_preenchido") {
    $sql = "select count(*) as qts from formulario where SUBSTR(datahora,1,10) = SUBSTR(now(),1,10) and login = '" . $_POST['login'] . "'";
    $f = new Formulario();
    $f->executaSQL($sql);
    while ($c = $f->retornaDados()) {
        echo $c->qts;
    }
}
   