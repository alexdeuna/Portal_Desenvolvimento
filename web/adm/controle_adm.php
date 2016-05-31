<?php

header("Content-Type: text/plain; charset=UTF-8", true);
require_once("../classes/Validacao.class.php");
require_once("../classes/base.class.php");
require_once("../classes/Usuario.class.php");
require_once("../classes/Menu.class.php");
require_once("../classes/Aplicacao.class.php");

extract($_POST);


if ($_POST['acao'] == 'cadastrar_usuario') {
    if (($_POST['autorizado']) && ($_POST['nome']) && ($_POST['email'])) {
        $c = new Usuario();
        $c->setValor('login', $_POST['autorizado']);
        $c->setValor('perfil', $_POST['perfil']);
        $c->setValor('email', $_POST['email']);
        $c->setValor('nome', $_POST['nome']);
        $c->setValor('telefone', $_POST['tel']);
        $c->setValor('obs', $_POST['obs']);
        $c->setValor('senha', '123');
        $c->delCampo('ativo');
        $c->delCampo('ativo');
        $c->delCampo('chave');
        $c->delCampo('dataInsert');
        $c->delCampo('ultimoLogin');
        $r = $c->cadastrar($c);
        if ($r == 1) {
            $u = new Usuario();
            $u->extra_select = "WHERE login = '" . $_POST['autorizado'] . "' and email = '" . $_POST['email'] . "'";
            $u->selecionaTudo($u);
            $rd = $u->retornaDados();
            if ($rd) {
                $id = $rd->id;
                $nome = $rd->login;
                $email = $rd->email;
                $data_envio = date('d/m/Y');
                $hora_envio = date('H:i:s');
                $resp = shell_exec("/var/local/PortalOSS/portalweb/reset.pl -i '$id' -m '$email'");
            }
        }
    } else {
        echo "Preencha o formulário corretamente!";
    }
    echo $r;
} else if ($_POST['acao'] == 'selecionar') {
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
} else if ($_POST['acao'] == 'atualizar_usuario') {
    sleep(2);
    $t = (explode(",", $_POST['t']));
    $atualizar = new Usuario();
    $atualizar->valor_pk = $_POST['id'];
    $atualizar->setValor('login', $_POST['autorizado']);
    $atualizar->setValor('perfil', $_POST['perfil']);
    $atualizar->setValor('nome', $_POST['nome']);
    $atualizar->setValor('email', $_POST['email']);
    $atualizar->setValor('obs', $_POST['obs']);
    $atualizar->setValor('telefone', $_POST['tel']);
    $atualizar->delCampo('senha', $_POST['senha']);
    $atualizar->delCampo('chave');
    $atualizar->delCampo('dataInsert');
    $atualizar->delCampo('ultimoLogin');
    $ret = $atualizar->atualizar($atualizar);
    echo $ret;
} else if ($_POST['acao'] == 'login_complete') {
    $l = new Usuario();
    $l->delCampo('senha');
    $l->extra_select = "WHERE login LIKE '" . strtoupper($_POST['name_startsWith']) . "%'";
    $l->selecionaCampos($l);
    $dados = array();
    while ($resTipo = $l->retornaDados()) {
        $name = $resTipo->login . '|' . $resTipo->nome . '|' . $resTipo->email . '|' . $resTipo->telefone . '|' . $resTipo->obs . '|' . $resTipo->id . '|' . $resTipo->perfil;
        array_push($dados, $name);
    }
    echo json_encode($dados);
} else if ($_POST['acao'] == 'listar_sistemas') {
    $sis = new Aplicacao();
    $sis->extra_select = "WHERE idPai = 0 order by nome";
    $sis->selecionaCampos($sis);
    $i = 1;
    $s = '';
    while ($listaSis = $sis->retornaDados()) {
//         $s.='<input type="checkbox" id="check'.$i.'"><label for="check'.$i.'">'.$listaSis->nome.'</label><br>';
        $s.='<button type="button" class="btn btn-danger" style="margin: 10" id=' . $listaSis->id . '>' . $listaSis->id . ' - ' . $listaSis->nome . '</butoon>';
        $i++;
    }
    echo $s;
} else if ($_POST['acao'] == 'login_complete_permissao') {
    $menu = new Menu();
    $menu->extra_select = "WHERE idUsuario = " . $_POST['id_usuario'];
    $menu->selecionaCampos($menu);
    $lsita = array();
    while ($menuLista = $menu->retornaDados()) {
        $listaMenu = $menuLista->id . '|' . $menuLista->idUsuario . '|' . $menuLista->idAplicacao . '|' . $menuLista->dataInsert;
        array_push($lsita, $listaMenu);
    }
    echo json_encode($lsita);
} else if ($_POST['acao'] == 'inclui_acesso') {
    $menu_inc = new Menu();
    $menu_inc->setValor('idAplicacao', $_POST['idApp']);
    $menu_inc->setValor('idUsuario', $_POST['idUsuario']);
    $menu_inc->delCampo('dataInsert');
    $r_inc = $menu_inc->cadastrar($menu_inc);
    echo $r_inc;
} else if ($_POST['acao'] == 'tira_acesso') {
    $menu_tira = new Menu();
    $r_tira = $menu_tira->selecionaLivre("DELETE FROM menu WHERE idUsuario= '" . $_POST['idUsuario'] . "' and idAplicacao = '" . $_POST['idApp'] . "'");
    echo $r_tira;
}