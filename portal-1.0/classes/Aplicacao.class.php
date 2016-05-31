<?php

require_once("base.class.php");

class Aplicacao extends base {

    public function __construct($campos = array()) {
        parent::__construct();
        $this->tabela = "aplicacao";
        if (sizeof($campos) <= 0) {
            $this->campos_valores = array(
                "idPai" => NULL,
                "nome" => NULL,
                "desc" => NULL,
                "ativo" => NULL,
                "dataInsert" => NULL
            );
        } else {
            $this->campos_valores = $campos;
        }
        $this->campo_pk = "id";
    }

}

?>