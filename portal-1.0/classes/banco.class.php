<?php

//ini_set("display_errors", 0);

abstract class banco {

    private $servidor = "10.121.247.125";
    private $usuario = "portaloss";
    private $senha = "MatriX";
    private $nomedebanco = "portalossweb";
    private $conexao = null;
    private $dataset = null;
    private $linhasafetadas = -1;
    private $idk = "@1&xDeUn@";

    public function __construct() {
        $this->conecta();
    }

//construct

    public function __destruct() {
        if ($this->conexao != NULL) {
            mysql_close($this->conexao);
        }
    }

//destruct

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

//conecta

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
                $sql.= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                        "AES_ENCRYPT(" . $objeto->campos_valores[key($objeto->campos_valores)] . ", '" . $this->idk . "')" :
                        "AES_ENCRYPT('" . $objeto->campos_valores[key($objeto->campos_valores)] . "', '" . $this->idk . "')";
            }

            if ($i < (count($objeto->campos_valores) - 1)) {
                $sql.=", ";
            } else {
                $sql.=");";
            }
            next($objeto->campos_valores);
        }
        echo $sql . '<br>';
        return $this->executaSQL($sql);
    }

//cadastrar

    public function atualizar($objeto) {
        $sql = "UPDATE " . $objeto->tabela . " SET ";
        for ($i = 0; $i < count($objeto->campos_valores); $i++) {
            $sql.=key($objeto->campos_valores) . "=";

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
                $sql.= is_numeric($objeto->campos_valores[key($objeto->campos_valores)]) ?
                        "AES_ENCRYPT(" . $objeto->campos_valores[key($objeto->campos_valores)] . ", '" . $this->idk . "')" :
                        "AES_ENCRYPT('" . $objeto->campos_valores[key($objeto->campos_valores)] . "', '" . $this->idk . "')";
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
 //       echo "<br><br><br>" . $sql;
        return $this->executaSQL($sql);
    }

//atualizar

    public function deletar($objeto) {
        $sql = "DELETE FROM " . $objeto->tabela;
        $sql.=" WHERE " . $objeto->campo_pk . "=";
        $sql.= is_numeric($objeto->valor_pk) ? $objeto->valor_pk : "'" . $objeto->valor_pk . "'";
//echo $sql;
        return $this->executaSQL($sql);
    }

//deletar

    public function selecionaTudo($objeto) {
        $sql = "SELECT * FROM " . $objeto->tabela;
        if ($objeto->extra_select != NULL) {
            $sql.=" " . $objeto->extra_select;
        }
//echo $sql;
        return $this->executaSQL($sql);
    }

//selecionaTudo

    public function selecionaCampos($objeto) {
        $sql = "SELECT ";
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
        echo $sql;
        return $this->executaSQL($sql);
    }

//selecionaCampos

    public function selecionaLivre($objeto) {
        return $this->executaSQL($objeto);
    }

    public function validaSenha($u, $p) {
        $sql = "SELECT * FROM usuario " . $objeto->tabela . "where login = '" . $u . "' and senha = AES_ENCRYPT('" . $p . "', '" . $this->idk . "')";
      //  echo $sql;
        return $this->executaSQL($sql);
    }

//selecionaCampos

    public function executaSQL($sql = NULL) {
//echo $sql;
        if ($sql != NULL) {
            $query = mysql_query($sql) or $this->trataerro(__FILE__, __FUNCTION__);
            $this->linhasafetadas = mysql_affected_rows($this->conexao);
            if (substr(trim(strtolower($sql)), 0, 6) == 'select') {
                $this->dataset = $query;
                return $query;
            } else {
                return $this->linhasafetadas;
            }
        } else {
            $this->trataerro(__FILE__, __FUNCTION__, NULL, 'SQL nao informado', FALSE);
        }
    }

//executaSQL

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

//retornaDados

    public function trataerro($arquivo = NULL, $rotina = NULL, $numerro = NULL, $msgerro = NULL, $geraexcept = FALSE) {
        if ($arquivo == NULL)
            $arquivo = "nao informado";
        if ($rotina == NULL)
            $rotina = "nao informada";
        if ($numerro == NULL)
            $numerro = mysql_errno($this->conexao);
        if ($msgerro == NULL)
            $msgerro = mysql_error($this->conexao);
        $resutado = 'Erros</br>
					<strong>Arquivo: </strong>' . $arquivo . '<br />
					<strong>Rotina: </strong>' . $rotina . '<br />
					<strong>Num ERRO: </strong>' . $numerro . '<br />
					<strong>MSG: </strong>' . $msgerro;
        if ($geraexcept == FALSE) {
            if ($numerro == 1062) { //DUPLICATE
                if (strpos($msgerro, 'ip_')) {
                    echo "<script> alert('IP JÃ� CADASTRADO!');</script>";
                }
                if (strpos($msgerro, 'nome_equipe')) {
                    echo "<script> alert('PLATAFORMA JÃ� CADASTRADA!');</script>";
                }
            }
            if ($numerro == 1366) { //TRUNCATE
                echo "<script> alert('PREENCHA TODO O FORMULÃ�RIO!');</script>";
            }
            if ($numerro == 1451) { //ON UPDATE
                if (strpos($msgerro, 'ON UPDATE')) {
                    echo "<script> alert('O SERVIDOR PERTENCE A AUTOMAÃ‡ÃƒO E NÃƒO PODE SER EXCLUIDO! Entre em contato como Administrador');</script>";
                }
            }
            echo($resutado);
        } else {
            die($resutado);
        }
    }

//trataerro
}

//fim
?>
