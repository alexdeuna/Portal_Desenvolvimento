<?php

//ini_set("display_errors", 0);
abstract class banco {

    private $servidor = "10.121.247.125";
    private $usuario = "portaloss";
    private $senha = "MatriX";
    private $nomedebanco = "Servidor";
    private $conexao = null;
    private $dataset = null;
    private $linhasafetadas = -1;
    private $idk = "portal_oss";

    public function __construct() {
        $this->conecta();
    }

    public function __destruct() {
        if ($this->conexao != NULL) {
            mysql_close($this->conexao);
        }
    }

    public function conecta() {
        $this->conexao = mysql_connect($this->servidor, $this->usuario, $this->senha, TRUE)
                or die($this->trataerro(__FILE__, __FUNCTION__, mysql_errno(), mysql_error(), TRUE));
        mysql_select_db($this->nomedebanco)
                or die($this->trataerro(__FILE__, __FUNCTION__, mysql_errno(), mysql_error(), TRUE));
        mysql_query("SET NAMES 'utf8'");
        mysql_query("SET character_set_connection=utf8");
        mysql_query("SET character_set_client=utf8");
        mysql_query("SET character_set_result=utf8");
    }

    public function cadastrar($objeto) {
        $sql = "INSERT INTO " . $objeto->tabela . " (";
        for ($i = 0; $i < count($objeto->campos_valores); $i++) {
            $sql.=key($objeto->campos_valores);
            if ($i < (count($objeto->campos_valores) - 1)) {
                $sql.=", ";
            } else {
                $sql.=") ";
            }
            next($objeto->campos_valores);
        }
        reset($objeto->campos_valores);
        $sql.="VALUES (";
        for ($i = 0; $i < count($objeto->campos_valores); $i++) {
            if ((key($objeto->campos_valores) != "senha")) {
                $sql.= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                        $objeto->campos_valores[key($objeto->campos_valores)] : "'" . $objeto->campos_valores[key($objeto->campos_valores)] . "'";
            } else {
                /* $sql.= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                  "MD5(" . $objeto->campos_valores[key($objeto->campos_valores)] . ")" :
                  "MD5('" . $objeto->campos_valores[key($objeto->campos_valores)] . "')";
                 */
                $sql.= "AES_ENCRYPT('" . $objeto->campos_valores[key($objeto->campos_valores)] . "', '" . $this->idk . "')";
            }

            if ($i < (count($objeto->campos_valores) - 1)) {
                $sql.=", ";
            } else {
                $sql.=");";
            }
            next($objeto->campos_valores);
        }
        //  echo $sql . '<br>';
        return $this->executaSQL($sql);
    }

    public function atualizar($objeto) {
        $sql = "UPDATE " . $objeto->tabela . " SET ";
        for ($i = 0; $i < count($objeto->campos_valores); $i++) {
            $sql.=key($objeto->campos_valores) . " = ";
            /* $sql.= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ? 
              $objeto->campos_valores[key($objeto->campos_valores)] :
              "'".$objeto->campos_valores[key($objeto->campos_valores)]."'"; */
            if ((key($objeto->campos_valores) != "senha")) {
                $sql.= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                        $objeto->campos_valores[key($objeto->campos_valores)] : "'" . $objeto->campos_valores[key($objeto->campos_valores)] . "'";
            } else {
                /* $sql.= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                  "MD5(" . $objeto->campos_valores[key($objeto->campos_valores)] . ")" :
                  "MD5('" . $objeto->campos_valores[key($objeto->campos_valores)] . "')";
                 */
                $sql.= "AES_ENCRYPT('" . $objeto->campos_valores[key($objeto->campos_valores)] . "', '" . $this->idk . "')";
            }

            if ($i < (count($objeto->campos_valores) - 1)) {
                $sql.=", ";
            } else {
                $sql.=" ";
            }
            next($objeto->campos_valores);
        }
        $sql.="WHERE " . $objeto->campo_pk . "=";
        $sql.= is_numeric($objeto->valor_pk) ? $objeto->valor_pk : "'" . $objeto->valor_pk . "'";
//echo "<br><br><br>" . $sql."<br><br>";
        return $this->executaSQL($sql);
    }

    public function deletar($objeto) {
        $sql = "DELETE FROM " . $objeto->tabela;
        $sql.=" WHERE " . $objeto->campo_pk . "=";
        $sql.= is_numeric($objeto->valor_pk) ? $objeto->valor_pk : "'" . $objeto->valor_pk . "'";
//echo $sql;
        return $this->executaSQL($sql);
    }

    public function selecionaTudo($objeto) {
        $sql = "SELECT * FROM " . $objeto->tabela;
        if ($objeto->extra_select != NULL) {
            $sql.=" " . $objeto->extra_select;
        }
//echo $sql;
        return $this->executaSQL($sql);
    }

    public function selecionaCampos($objeto) {
        $sql = "SELECT id, ";
        for ($i = 0; $i < count($objeto->campos_valores); $i++) {
            if ((key($objeto->campos_valores) != "senha")) {
                $sql.=key($objeto->campos_valores);
            } else {
                $sql.= "AES_DECRYPT(" . key($objeto->campos_valores) . ", '" . $this->idk . "') as " . key($objeto->campos_valores);
            }

            if ($i < (count($objeto->campos_valores) - 1)) {
                $sql.=", ";
            } else {
                $sql.=" ";
            }
            next($objeto->campos_valores);
        }
        $sql.= " FROM " . $objeto->tabela;
        if ($objeto->extra_select != NULL) {
            $sql.=" " . $objeto->extra_select;
        }
//echo $sql;
        return $this->executaSQL($sql);
    }

    public function selecionaLivre($objeto) {
        return $this->executaSQL($objeto);
    }

    public function validaSenha($u, $p) {
        $sql = "SELECT * FROM usuario " . $objeto->tabela . "where login = '" . $u . "' and senha = AES_ENCRYPT('" . $p . "', '" . $this->idk . "')";
//echo $sql;
        return $this->executaSQL($sql);
    }

    public function executaSQL($sql = NULL) {
//echo $sql."<br>";
        if ($sql != NULL) {
            $query = mysql_query($sql) or $this->trataerro(__FILE__, __FUNCTION__, NULL, NULL, $sql, FALSE);
            $this->linhasafetadas = mysql_affected_rows($this->conexao);
            if (substr(trim(strtolower($sql)), 0, 6) == 'select') {
                $this->dataset = $query;
                return $query;
            } else {
                return $this->linhasafetadas;
            }
        } else {
            $this->trataerro(__FILE__, __FUNCTION__, NULL, NULL, NULL, FALSE);
        }
    }

    public function retornaDados($tipo = NULL) {
        switch (strtolower($tipo)) {
            case "array":
                return mysql_fetch_array($this->dataset);
                break;
            case "assoc":
                return mysql_fetch_assoc($this->dataset);
                break;
            case "object":
                return mysql_fetch_object($this->dataset);
                break;
            default:
                return mysql_fetch_object($this->dataset);
                break;
        }
    }

    public function trataerro($arquivo = NULL, $rotina = NULL, $numerro = NULL, $msgerro = NULL, $sql = NULL, $geraexcept = FALSE) {
        if ($arquivo == NULL)
            $arquivo = "nao informado";
        if ($rotina == NULL)
            $rotina = "nao informada";
        if ($sql == NULL)
            $sql = "nao informada";
        if ($numerro == NULL)
            $numerro = mysql_errno($this->conexao);
        if ($msgerro == NULL)
            $msgerro = mysql_error($this->conexao);
        $resutado = 'Erros</br>
					<strong>Arquivo: </strong>' . $arquivo . '<br />
					<strong>Rotina: </strong>' . $rotina . '<br />
					<strong>Num ERRO: </strong>' . $numerro . '<br />
					<strong>Query: </strong>' . $sql . '<br />
					<strong>MSG: </strong>' . $msgerro;
        if ($geraexcept == FALSE) {
            if ($numerro == 1062) { //DUPLICATE
                if (strpos($msgerro, 'ip_')) {
                    echo "<script> alert('IP JÁ CADASTRADO!');</script>";
                }
                if (strpos($msgerro, 'nome_equipe')) {
                    echo "<script> alert('PLATAFORMA JÁ CADASTRADA!');</script>";
                }
            }
            if ($numerro == 1366) { //TRUNCATE
                echo "<script> alert('PREENCHA TODO O FORMULÁRIO!');</script>";
            }
            if ($numerro == 1451) { //ON UPDATE
                if (strpos($msgerro, 'ON UPDATE')) {
                    echo "<script> alert('O SERVIDOR PERTENCE A AUTOMAÇÃO E NÃO PODE SER EXCLUIDO! Entre em contato como Administrador');</script>";
                }
            }
            echo($resutado);
        } else {
            die($resutado);
        }
    }

    public function getLista($objeto) {
        $sql = "select 
                    u.id, u.id_servidor, u.id_tipo, so.id as id_so, s.hostname, s.ip, s.porta, so.nome as so, u.usuario, 
                    AES_DECRYPT(u.senha1, '" . $this->idk . "') as senha1, 
                    AES_DECRYPT(u.senha2, '" . $this->idk . "') as senha2, 
                    AES_DECRYPT(u.senha3, '" . $this->idk . "') as senha3, 
                    u.desc
                from 
                    usuario u, servidor s, sistemaOperacional so, tipoUsuario t
                where  
                    s.id_so = so.id and 
                    u.id_servidor = s.id and 
                    u.id_tipo = t.id and 
                    s.id = ".$objeto;
       //echo $sql;
        return $this->executaSQL($sql);
    }

}

?>
