<?php

require_once("base.class.php");

class Usuario extends base {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "usuario";
        if (sizeof($campos) <= 0) {
            $this->campos_valores = array(
                "id_servidor" => NULL,
                "id_tipo" => NULL,
                "usuario" => NULL,
                "senha1" => NULL,
                "senha2" => NULL,
                "senha3" => NULL,
                "desc" => NULL,
                "data_insert" => NULL,
                "data_update" => NULL
            );
        } else {
            $this->campos_valores = $campos;
        }
        $this->campo_pk = "id";
    }

}

?>