<?php

header("Content-Type: text/plain; charset=UTF-8", true);
require_once("../classes/Fornecedor.class.php");
require_once("../classes/Plataforma.class.php");
require_once("../classes/Servidor.class.php");
require_once("../classes/SistemaOperacional.class.php");
require_once("../classes/Usuario.class.php");

extract($_POST);

if ($_POST['acao'] == 'listar') {
    $forn = new Fornecedor();
    $forn->extra_select = "order by id limit 2";
    $forn->selecionaTudo($forn);
    $resp = "";

    while ($f = $forn->retornaDados()) {
        $resp.="<ul class='list-group'> <li class='list-group-item'  nivel='1'>"
                . "<button type='button' class='btn btn-primary' tipo = 'fornecedor' id_for='$f->id' nome_for='$f->nome'>"
                . "<span class='glyphicon glyphicon-edit'></span></button>$f->id - $f->nome</li>";
        $plat = new Plataforma();
        $plat->extra_select = "where id_fornecedor = $f->id";
        $plat->selecionaTudo($plat);

        while ($p = $plat->retornaDados()) {
            $resp .= "<ul class='list-group-item' tipo='plat'><li class='list-group-item'  nivel='2'>"
                    . "<button type='button' class='btn btn-danger' tipo = 'plataforma'>"
                    . "<span class='glyphicon  glyphicon-remove'></span></button>"
                    . "<button type='button' class='btn btn-primary' tipo = 'plataforma' id_pla='$p->id' >"
                    . "<span class='glyphicon glyphicon-pencil'></span></button>"
                    . "$p->id - $p->nome</li>";
            $serv = new Servidor();
            $serv->extra_select = "where id_plataforma = $p->id order by hostname";
            $serv->selecionaTudo($serv);

            while ($s = $serv->retornaDados()) {
                $resp .= "<ul class='list-group-item'><li class='list-group-item' nivel='3' id_ser='$s->id'>$s->id - $s->hostname - $s->ip </li>";
//                $sql = "select s.hostname, s.ip, so.nome as so, p.id as id_plataforma,u.id_servidor, 
//                        id_tipo, u.usuario, u.senha1, u.senha2, u.senha3,u.desc
//                     from usuario u, servidor s, plataforma p, sistemaOperacional so
//                    where p.id = s.id_plataforma and s.id_plataforma = p.id and s.id_so = so.id and u.id_servidor = s.id and s.id = $s->id";
                $user = new Usuario();
//                $user->selecionaLivre($sql);
                $user->getLista($s->id);
                $resp .= "<ul class='list-group-item'><li class='list-group-item' id='lista'>
                    <div><table class='table table-hover'>
                            <thead>
                                <tr>
                                   <th>Usuário</th>
                                   <th>Atual</th>
                                   <th>Anterior</th>
                                   <th>Antiga</th>
                                   <th>Descrição</th>
                                   <th></th>
                                   <th></th>
                                 </tr>
                            </thead>
                            <tbody>";
                while ($lista = $user->retornaDados()) {
                    $id_usuario = $lista->id;
                    $id_plataforma = $lista->id_plataforma;
                    $id_servidor = $lista->id_servidor;
                    $id_tipo_usuario = $lista->id_tipo;
                    $hostname = $lista->hostname;
                    $ip = $lista->ip;
                    $porta = $lista->porta;
                    $so = $lista->so;
                    $usuario = $lista->usuario;
                    $senha1 = $lista->senha1;
                    $senha2 = $lista->senha2;
                    $senha3 = $lista->senha3;
                    $desc = $lista->desc;
                    $resp .= "<tr>
                                <td>$id_usuario - $usuario</td>
                                <td>$senha1</td>
                                <td>$senha2</td>
                                <td>$senha3</td>
                                <td>$desc</td>
                                <td>
                                    <button type='button' class='btn btn-primary' 
                                        acao = 'editar' 
                                        tipo = 'usuario' 
                                        plataforma='$p->nome' 
                                        fornecedor='$f->nome' 
                                        id_usuario = $id_usuario 
                                        id_plataforma = $id_plataforma 
                                        id_servidor = $id_servidor 
                                        id_tipo_usuario = $id_tipo_usuario
                                        hostname = $hostname
                                        ip = $ip
                                        porta = $porta 
                                        so = $so
                                        usuario = $usuario
                                        senha1 = $senha1 
                                        senha2 = $senha2
                                        senha3 = $senha3
                                        desc = $desc>
                                        <span class='glyphicon glyphicon-edit'></span>
                                    </button>
                                </td>
                                <td>
                                    <button type='button' class='btn btn-danger' 
                                        acao = 'excluir' 
                                        tipo = 'usuario' 
                                        plataforma='$p->nome' 
                                        fornecedor='$f->nome' 
                                        id_usuario = $id_usuario 
                                        id_plataforma = $id_plataforma 
                                        id_servidor = $id_servidor 
                                        id_tipo_usuario = $id_tipo_usuario
                                        hostname = $hostname
                                        ip = $ip
                                        porta = $porta 
                                        so = $so
                                        usuario = $usuario
                                        senha1 = $senha1 
                                        senha2 = $senha2
                                        senha3 = $senha3
                                        desc = $desc>
                                        <span class='glyphicon glyphicon-trash'></span>
                                    </button>
                                </td>
                              </tr>
                            ";
                }
                $resp .= "</tbody>
                            </table></div></li></ul>";
                $resp .= "</ul>";
            }
            $resp .= "</ul>";
        }
        $resp .= "</ul>";
    }
    echo $resp;
} else if ($_POST['acao'] == "editar") {
    echo $_POST['nome_plat'];
}
   