<?php

header("Content-Type: text/plain; charset=UTF-8", true);
require_once("../classes/Fornecedor.class.php");
require_once("../classes/Plataforma.class.php");
require_once("../classes/Servidor.class.php");
require_once("../classes/SistemaOperacional.class.php");
require_once("../classes/Usuario.class.php");

extract($_POST);

if ($_POST['acao'] == 'listar') {
    $lista = new Usuario();
    $lista->getLista();
    while ($row = $lista->retornaDados('assoc')) {
        $listaArray[] = $row;
    }
   
    echo json_encode($listaArray);

//    $forn = new Fornecedor();
//    $forn->selecionaTudo($forn);
//    while ($f_row = $forn->retornaDados('assoc')) {
//        $fornecedor[] = $f_row;
//    }
//    $plat = new Plataforma();
//    $plat->selecionaTudo($plat);
//    while ($p_row = $plat->retornaDados('assoc')) {
//        $plataforma[] = $p_row;
//    }
//    $serv = new Servidor();
//    $serv->selecionaTudo($serv);
//    while ($s_row = $serv->retornaDados('assoc')) {
//        $servidor[] = $s_row;
//    }
//
//    $user = new Usuario();
//    $user->getLista();
//    while ($u_row = $user->retornaDados('assoc')) {
//        $usuario[] = $u_row;
//    }
//
//    foreach ($fornecedor as $f) {
//        foreach ($plataforma as $p) {
//            if ($f['id'] == $p['id_fornecedor']) {
//                foreach ($servidor as $s) {
//                    if ($p['id'] == $s['id_plataforma']) {
//                        echo $f['nome'], ' - ', $p['nome'], ' - ', $s['hostname'], "<br>";
//                        $lista[$f['nome']] = array($p['nome'], $s['hostname']);
//                    }
//                }
//            }
//        }
//    }
//    foreach ($lista as $l) {
//        
//    }
//
//
//
//    echo "<pre>";
//    print_r($lista);
//    print_r($plataforma);
//    print_r($servidor);
//    print_r($usuario);
//    foreach ($lista_array as $l) {
//        $fornecedor[] = array("nome_fornecedor" => $l["nome_fornecedor"],
//            "id_fornecedor" => $l["id_fornecedor"],
//            "plataforma" => array("nome_plataforma" => $l["nome_plataforma"],
//                "id_plataforma" => $l["id_plataforma"],
//                "servidor" => array("nome_servidor" => $l["hostname"],
//                    "id_servidor" => $l["id_servidor"],
//                    "ip" => $l["ip"],
//                    "porta" => $l["porta"],
//                    "so" => $l["nome_so"],
//                    "id_so" => $l["id_so"],
//                    "usuario" => $l["usuario"],
//                    "id_usuario" => $l["usuario"],
//                    "tipo" => $l["tipo"],
//                    "tipo" => $l["id_tipo"],
//                    "senha1" => $l["senha1"],
//                    "senha2" => $l["senha2"],
//                    "senha3" => $l["senha3"],
//                    "desc" => $l["desc"]
//                )
//            )
//        );
//    }
//    foreach ($lista_array as $l) {
//        $lista[] = array(
//            "nome_fornecedor" => $l["nome_fornecedor"],
//            "id_fornecedor" => $l["id_fornecedor"],
//            "nome_plataforma" => $l["nome_plataforma"],
//            "id_plataforma" => $l["id_plataforma"],
//            "nome_servidor" => $l["hostname"],
//            "id_servidor" => $l["id_servidor"],
//            "ip" => $l["ip"],
//            "porta" => $l["porta"],
//            "so" => $l["nome_so"],
//            "id_so" => $l["id_so"],
//            "usuario" => $l["usuario"],
//            "id_usuario" => $l["usuario"],
//            "tipo" => $l["tipo"],
//            "tipo" => $l["id_tipo"],
//            "senha1" => $l["senha1"],
//            "senha2" => $l["senha2"],
//            "senha3" => $l["senha3"],
//            "desc" => $l["desc"]
//        );
////        
//
////        $p_ant = '';
//        $f_ant = '';
////        $s_ant = '';
////        $u_ant = '';
////
//        foreach ($lista as $i) {
//            echo $i[0];
//            if ($i["nome_fornecedor"] != $f_ant) {
//                $f = $i["nome_fornecedor"];
//                $fornecedor[] = $f;
//          //  echo $f . " ";
//            }
//            $f_ant = $f;
//        }
//
//            if ($lista[$i]["nome_plataforma"] != $p_ant) {
//                $p = $lista[$i]["nome_plataforma"];
//                $plataforma[] = $p;
////            echo $p . " ";
//            }
//            $p_ant = $p;
//
//            if ($lista[$i]["nome_servidor"] != $s_ant) {
//                $s = $lista[$i]["nome_servidor"];
//                $servidor[] = $s;
////            echo $s . " ";
//            }
//            $s_ant = $s;
//
//            if ($lista[$i]["nome_usuario"] != $s_ant) {
//                $u = $lista[$i]["usuario"];
//                $usuario[] = $u;
////            echo $u . "<br> ";
//            }
//            $u_ant = $u;
//        }
//
//        foreach ($fornecedor as $f => $value) {
//            foreach ($lista as $l => $value) {
//                if ($fornecedor[$f] == $lista[$l]["nome_fornecedor"]) {
//                    $fornecedor[$f] = array($fornecedor[$f], array($lista[$l]["nome_plataforma"]));
//                }
//            }
//        }
//        foreach ($fornecedor as $l) {
//            echo $l;
//            foreach ($l as $f) {
//                echo $f . ' ';
//                foreach ($f as $p) {
//                    echo $p . '<br>';
//                }
//            }
//        }
//    echo "<pre>";
//    print_r($fornecedor);
//    echo "</pre>";
//    echo json_encode($fornecedor);
} else if ($_POST['acao'] == "editar") {
    echo $_POST['nome_plat'];
}
    