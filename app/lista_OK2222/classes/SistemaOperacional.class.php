<?php

require_once("base.class.php");

class SistemaOperacional extends base {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "sistemaOperacional";
        if (sizeof($campos) <= 0) {
            $this->campos_valores = array(
            "nome" => NULL
            );
        } else {
            $this->campos_valores = $campos;
        }
        $this->campo_pk = "id";
    }

}

?>