<?php

require_once("base.class.php");

class Log extends base {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "log";
        if (sizeof($campos) <= 0) {
            $this->campos_valores = array(
                "idUsuario" => NULL,
                "idAplicacao" => NULL,
                "dataInsert" => NULL
            );
        } else {
            $this->campos_valores = $campos;
        }
        $this->campo_pk = "id";
    }

}

?>