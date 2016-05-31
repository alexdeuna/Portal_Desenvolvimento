<?php

require_once("base.class.php");

class Usuario extends base {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "usuario";
        if (sizeof($campos) <= 0) {
            $this->campos_valores = array(
                "login" => NULL,
                "senha" => NULL,
                "perfil" => NULL,
                "nome" => NULL,
                "email" => NULL,
                "telefone" => NULL,
                "obs" => NULL,
                "ativo" => NULL,
                "chave" => NULL,
                "dataInsert" => NULL,
                "ultimoLogin" => NULL
            );
        } else {
            $this->campos_valores = $campos;
        }
        $this->campo_pk = "id";
    }

}

?>