<?php

header("Content-Type: text/plain; charset=UTF-8", true);

require_once("../classes/Fornecedor.class.php");
require_once("../classes/Plataforma.class.php");
require_once("../classes/Servidor.class.php");
require_once("../classes/SistemaOperacional.class.php");
require_once("../classes/Usuario.class.php");
require_once("../classes/TipoUsuario.class.php");

extract($_POST);

if ($_POST['acao'] == 'listar') {
    $extra = "in (SELECT p.id_fornecedor FROM fornecedor f, plataforma p, servidor s, usuario u  WHERE f.id = p.id_fornecedor and  p.id = s.id_plataforma and s.id = u.id_servidor)";
    $forn = new Fornecedor();
    $forn->extra_select = "where id " . $extra;
    $forn->selecionaTudo($forn);
    $resp = "";

    while ($f = $forn->retornaDados()) {
        $resp.="<ul class='list-group'> <li class='list-group-item'  nivel='1'><span class='glyphicon glyphicon-chevron-down abre'></span>&nbsp;&nbsp;&nbsp;$f->id - $f->nome"
                . "<button type='button' style='float: right' class='btn btn-primary' tipo = 'fornecedor' id_for='$f->id' nome_for='$f->nome'>"
                . "<span class='glyphicon glyphicon-edit'></span></button></li>";
        $plat = new Plataforma();
        $plat->extra_select = "where id_fornecedor = $f->id";
        $plat->selecionaTudo($plat);

        while ($p = $plat->retornaDados()) {
            $resp .= "<ul class='list-group-item' tipo='plat'><li class='list-group-item'  nivel='2'><span class='glyphicon glyphicon-chevron-down abre'></span>&nbsp;&nbsp;&nbsp;$p->id - $p->nome"
                    . "<button type='button' style='float: right; margin-left :5px' class='btn btn-danger' tipo = 'plataforma'>"
                    . "<span class='glyphicon  glyphicon-remove'></span></button>"
                    . "<button type='button' style='float: right'class='btn btn-primary' tipo = 'plataforma' id_pla='$p->id' >"
                    . "<span class='glyphicon glyphicon-pencil'></span></button>"
                    . "</li>";
            $serv = new Servidor();
            $serv->extra_select = "where id_plataforma = $p->id order by hostname";
            $serv->selecionaTudo($serv);

            while ($s = $serv->retornaDados()) {
                $resp .= "<ul class='list-group-item'><li class='list-group-item' nivel='3' id_ser='$s->id'><span class='glyphicon glyphicon-chevron-down abre'></span>&nbsp;&nbsp;&nbsp;$s->id - $s->hostname - $s->ip </li>";
                $user = new Usuario();
                $user->getLista($s->id);
                $resp .= "<ul class='list-group-item'><li class='list-group-item' id='lista'>
                    <div><table class='table table-hover'>
                            <thead>
                                <tr>
                                   <th>Usuário</th>
                                   <th>Tipo</th>
                                   <th>Atual</th>
                                   <th>Anterior</th>
                                   <th>Antiga</th>
                                   <th>Detalhes</th>
                                   <th></th>
                                   <th></th>
                                 </tr>
                            </thead>
                            <tbody>";
                while ($lista = $user->retornaDados()) {
                    $id_fornecedor = $lista->id_fornecedor;
                    $nome_fornecedor = $lista->nome_fornecedor;
                    $id_plataforma = $lista->id_plataforma;
                    $nome_plataforma = $lista->nome_plataforma;
                    $id_servidor = $lista->id_servidor;
                    $hostname = $lista->hostname;
                    $ip = $lista->ip;
                    $porta = $lista->porta;
                    $id_so = $lista->id_so;
                    $nome_so = $lista->nome_so;
                    $id_usuario = $lista->id_usuario;
                    $usuario = $lista->usuario;
                    $id_tipo = $lista->id_tipo;
                    $tipo = $lista->tipo;
                    $senha1 = $lista->senha1;
                    $senha2 = $lista->senha2;
                    $senha3 = $lista->senha3;
                    $descricao = $lista->descricao;
                    $servidor_log = $lista->servidor_log;
                    $servidor_data_update = $lista->servidor_data_update;
                    $usuario_log = $lista->usuario_log;
                    $usuario_data_update = $lista->usuario_data_update;
                    $resp .= "<tr id='id_usuario$id_usuario'>
                                <td id='usuario$id_usuario'>$id_usuario - $usuario</td>
                                <td id='tipo$id_usuario'>$tipo</td>
                                <td id='senha1$id_usuario'>$senha1</td>
                                <td id='senha12$id_usuario'>$senha2</td>
                                <td>$senha3</td>
                                
                                <td>
                                    <button type='button' class='btn btn-success' modal='btn_detalhes'
                                       nome_fornecedor = '$nome_fornecedor' 
                                       nome_plataforma = '$nome_plataforma'
                                       hostname = '$hostname'
                                       ip = '$ip'
                                       porta = '$porta'
                                       nome_so = '$nome_so'
                                       usuario = '$usuario'
                                       tipo = '$tipo'
                                       descricao = '$descricao' 
                                       servidor_log = '$servidor_log'
                                       servidor_data_update = '$servidor_data_update'
                                       usuario_log = '$usuario_log'
                                       usuario_data_update = '$usuario_data_update'>Mais
                                       <span class='glyphicon glyphicon-plus'></span>
                                    </button>
                                </td>
                                <td>
                                    <button type='button' class='btn btn-primary' modal='btn_editar'
                                        acao = 'editar_usuario' 
                                        id_fornecedor = '$id_fornecedor' 
                                        nome_fornecedor = '$nome_fornecedor' 
                                        id_plataforma = '$id_plataforma'
                                        nome_plataforma = '$nome_plataforma'
                                        id_servidor = '$id_servidor'
                                        hostname = '$hostname'
                                        ip = '$ip'
                                        porta = '$porta'
                                        id_so = '$id_so'
                                        nome_so = '$nome_so'
                                        id_usuario = '$id_usuario'
                                        usuario = '$usuario'
                                        id_tipo = '$id_tipo'
                                        tipo = '$tipo'
                                        senhaTMP = '$senhaTMP' 
                                        senha1 = '$senha1' 
                                        senha2 = '$senha2'
                                        senha3 = '$senha3'
                                        descricao = '$descricao'
                                       servidor_log = '$servidor_log'
                                       servidor_data_update = '$servidor_data_update'
                                       usuario_log = '$usuario_log'
                                       usuario_data_update = '$usuario_data_update'>Alterar
                                        <span class='glyphicon glyphicon-edit'></span>
                                       
                                    </button>
                                </td>
                                <td>
                                    <button type='button' class='btn btn-danger' 
                                        acao = 'excluir_usuario' 
                                        id_fornecedor = '$id_fornecedor' 
                                        nome_fornecedor = '$nome_fornecedor' 
                                        id_plataforma = '$id_plataforma'
                                        nome_plataforma = '$nome_plataforma'
                                        id_servidor = '$id_servidor'
                                        hostname = '$hostname'
                                        ip = '$ip'
                                        porta = '$porta'
                                        id_so = '$id_so'
                                        nome_so = '$nome_so'
                                        id_usuario = '$id_usuario'
                                        usuario = '$usuario'
                                        id_tipo = '$id_tipo'
                                        tipo = '$nome_tipo'
                                        senha1 = '$senha1' 
                                        senha2 = '$senha2'
                                        senha3 = '$senha3'
                                        descricao = '$descricao'
                                        servidor_log = '$servidor_log'
                                        servidor_data_update = '$servidor_data_update'
                                        usuario_log = '$usuario_log'
                                        usuario_data_update = '$usuario_data_update'>Exluir
                                        <span class='glyphicon glyphicon-trash'></span>
                                    </button>
                                </td>
                              </tr>";
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
} else if ($_POST['acao'] == "editar_usuario") {
    $servidor = new Servidor();
    $servidor->valor_pk = $_POST['id_servidor'];
    $servidor->setValor('id_plataforma', $_POST['id_plataforma']);
    $servidor->setValor('id_so', $_POST['id_so']);
    $servidor->setValor('hostname', $_POST['hostname']);
    $servidor->setValor('ip', $_POST['ip']);
    $servidor->setValor('porta', $_POST['porta']);
    $servidor->setValor('log', $_POST['UsuarioID'] . " - " . $_POST['UsuarioLogin'] . " - " . $_POST['UsuarioNome']);
    $servidor->delCampo('data_insert');
    $servidor->delCampo('data_update');
    $servidor->atualizar($servidor);
    $usuario = new Usuario();
    $usuario->valor_pk = $_POST['id_usuario'];
    $usuario->setValor('id_servidor', $_POST['id_servidor']);
    $usuario->setValor('id_tipo', $_POST['id_tipo']);
    $usuario->setValor('usuario', $_POST['usuario']);
    $usuario->setValor('senha1', $_POST['senha1']);
    $usuario->setValor('senha2', $_POST['senhaTMP']);
    $usuario->setValor('senha3', $_POST['senha2']);
    $usuario->setValor('descricao', $_POST['descricao']);
    $usuario->setValor('log', $_POST['UsuarioID'] . " - " . $_POST['UsuarioLogin'] . " - " . $_POST['UsuarioNome']);
    $usuario->delCampo('data_insert');
    $usuario->delCampo('data_update');
    $usuario->atualizar($usuario);


    echo "id_fornecedor: " . $_POST['id_fornecedor'] . "<br>";
    echo "nome_fornecedor: " . $_POST['nome_fornecedor'] . "<br>";
    echo "id_plataforma: " . $_POST['id_plataforma'] . "<br>";
    echo "nome_plataforma: " . $_POST['nome_plataforma'] . "<br>";
    echo "id_servidor: " . $_POST['id_servidor'] . "<br>";
    echo "hostname: " . $_POST['hostname'] . "<br>";
    echo "ip: " . $_POST['ip'] . "<br>";
    echo "porta: " . $_POST['porta'] . "<br>";
    echo "id_so: " . $_POST['id_so'] . "<br>";
    echo "nome_so: " . $_POST['nome_so'] . "<br>";
    echo "id_usuario: " . $_POST['id_usuario'] . "<br>";
    echo "usuario: " . $_POST['usuario'] . "<br>";
    echo "id_tipo: " . $_POST['id_tipo'] . "<br>";
    echo "tipo: " . $_POST['nome_tipo'] . "<br>";
    echo "senhaTMP: " . $_POST['senhaTMP'] . "<br>";
    echo "senha1: " . $_POST['senha1'] . "<br>";
    echo "senha2: " . $_POST['senha2'] . "<br>";
    echo "senha3: " . $_POST['senha3'] . "<br>";
    echo "descricao: " . $_POST['descricao'] . "<br>";
    echo $_POST['UsuarioID'] . "<br>";
    echo $_POST['UsuarioLogin'] . "<br>";
    echo $_POST['UsuarioNome'] . "<br>";
} else if ($_POST['acao'] == "select_fornecedor") {
    $forn = new Fornecedor();
    $forn->extra_select = "order by nome";
    $forn->selecionaTudo($forn);
    while ($f = $forn->retornaDados()) {
        echo "<option value='$f->id'>$f->nome</option>";
    }
} else if ($_POST['acao'] == "select_so") {
    $so = new SistemaOperacional();
    $so->extra_select = "order by nome";
    $so->selecionaTudo($so);
    while ($s = $so->retornaDados()) {
        echo "<option value='$s->id'>$s->nome</option>";
    }
} else if ($_POST['acao'] == "select_tipo") {
    $tipo = new TipoUsuario();
    $tipo->extra_select = "order by tipo";
    $tipo->selecionaTudo($tipo);
    while ($t = $tipo->retornaDados()) {
        echo "<option value='$t->id'>$t->tipo</option>";
    }
} else if ($_POST['acao'] == "select_fornecedor_plataforma") {
    $forn = new Plataforma();
    $forn->extra_select = "where id_fornecedor = " . $_POST['id'];
    $forn->selecionaTudo($forn);
    while ($f = $forn->retornaDados()) {
        echo "<option value='$f->id'>$f->nome</option>";
    }
}
   