<?php

require_once("base.class.php");

class Fornecedor extends base {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "fornecedor";
        if (sizeof($campos) <= 0) {
            $this->campos_valores = array(
                "nome" => NULL,
                "data_insert" => NULL,
                "data_update" => NULL,
                "log" => NULL

            );
        } else {
            $this->campos_valores = $campos;
        }
        $this->campo_pk = "id";
    }

}

?>