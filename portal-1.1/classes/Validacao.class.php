<?php

require_once("base.class.php");
require_once("Usuario.class.php");
require_once("Menu.class.php");
require_once("Aplicacao.class.php");

class Validacao {

    public function verifica($t) {
        $this->iniciar($t);
        if (!isset($_SESSION['UsuarioID'])) {
            header("Location: index.html");
            exit;
        }
    }

    public function iniciar($t) {
        session_cache_expire($t);
        // A sessão precisa ser iniciada em cada página diferente
        if (!isset($_SESSION))
            session_start();
        $inactive = session_cache_expire();
        if (isset($_SESSION['start'])) {
            $session_life = time() - $_SESSION['start'];
            if ($session_life > $inactive) {
                session_unset();
                //header("Location: index.php?msg=Sessao Expirou");
            }
        }
        $_SESSION['start'] = time();
    }

    public function validar($u, $s) {
        $usuario = new Usuario();
        $usuario->validaSenha($u, $s);
        while ($ret = $usuario->retornaDados()) {
            $id = $ret->id;
            $login = $ret->login;
            $perfil = $ret->idperfil;
            $nome = $ret->nome;
        }
        $aplicacao = new Aplicacao();
        if ($u == 'admin') {
            $aplicacao->executaSQL("SELECT id, idPai, nome , separador, pasta, descricao FROM aplicacao ORDER BY nome");
        } else {
            $aplicacao->executaSQL("SELECT a.id, a.idPai, a.nome , a.separador, a.pasta, a.descricao FROM aplicacao a, menu m, usuario u
                                WHERE a.id = m.idAplicacao
                                AND m.IdUsuario = u.id
                                AND a.ativo = 'S'
                                AND u.login='" . $u . "'
                                UNION
                                SELECT id, idPai, nome, separador, pasta, descricao FROM aplicacao WHERE idPai IN(SELECT a.id FROM aplicacao a, menu m, usuario u
                                WHERE a.id = m.idAplicacao
                                AND m.IdUsuario = u.id
                                AND u.login='" . $u . "') AND ativo = 'S' ORDER BY idPai");
        }
        while ($row = $aplicacao->retornaDados()) {
            $menu[] = $row;
            
        }

        if ($id) {
            $this->iniciar();
            // Salva os dados encontrados na sessão
            $_SESSION['UsuarioID'] = $id;
            $_SESSION['UsuarioLogin'] = $login;
            $_SESSION['UsuarioPerfil'] = $perfil;
            $_SESSION['UsuarioNome'] = $nome;
            $_SESSION['Menu'] = $menu;

            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $_SESSION['IP'] = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {

                $_SESSION['IP'] = $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                $_SESSION['IP'] = $_SERVER['REMOTE_ADDR'];
            }

            // Redireciona o visitante
            //header("Location: home.php");
            exit;
        } else {
            // Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado
            header("Location: erro");
            exit;
        }
    }

    public function logout() {
        session_start(); // Inicia a sessão
        session_destroy(); // Destrói a sessão limpando todos os valores salvos
        //header("Location: index.php?msg=Sessao Encerrada!");
        exit; // Redireciona o visitante
    }

}

?>